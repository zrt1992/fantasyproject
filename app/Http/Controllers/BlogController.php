<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller {

    public function index() {
        $data['blogTitle'] = 'Gossips';
        $data['posts'] = \App\BlogPost::where('post_type', 'post')->orderBy('created_at','DESC')->paginate('8');;
        return view('user.blog.blog', $data);
    }

    function showBlogPostDetail($postid) {
        $data['news'] = \App\BlogPost::where('post_type', 'post')->take(3)->get()->toArray();
//        dd( $data['news']);
        $data['postdetail'] = \App\BlogPost::where('slug', $postid)->firstOrFail()->toArray();
        return view('user.blog.blog-inner', $data);
    }

    function addcommentajax(Request $request) {
        $comment = new Comment;
        $comment->content_id = $request->content_id;
        $comment->comment = $request->comment;
        $comment->user_id = \Auth::id();
        $comment->save();
        //joined_from_match_date -- I guess update team here
        $objResponse['success'] = true;
        $objResponse['comment'] = $request->comment;
        $objResponse['user_id'] = \Auth::id();
        $profile_pic = \App\User::where('id', \Auth::id())->firstOrFail()->toArray();
        $objResponse['name'] = $profile_pic['name'];
        $objResponse['profile_pic'] = getUploadsPath($profile_pic['profile_pic']);
        return response()->json($objResponse);
    }

    public function getNews() {
        $data['blogTitle'] = 'News';
        $data['posts'] = \App\BlogPost::where('post_type', 'news')->orderBy('id', 'DESC')->paginate('8');
        return view('user.news.news', $data);
    }

}
