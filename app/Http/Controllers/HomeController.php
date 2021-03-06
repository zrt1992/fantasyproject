<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;


use App\GameAction;
use App\Http\Requests;
use App\Mail\MyMail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailer;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\App;
use Validator;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{


    public function index()
    {



        $data['match_scores'] = \App\Match::where('cricapi_match_id', '!=', 0)
            ->with('match_scores')->take(4)->orderBy('start_date','DESC')->get()->toArray();
       // dd( $data['match_scores']);

        $objTourmament = \App\Tournament::orderBy("start_date",
            'asc')->
        Where('end_date', '>=', getGmtTime())->get();
        $data['tournaments_list'] = $objTourmament->where('is_active', 1)->toArray(); //list of active
        $tournaments_data = [];
        foreach ($data['tournaments_list'] as $key => $tournament) {
            $data['tournaments_list'][$key] = $tournament;
            $data['tournaments_list'][$key]['leaderboard'] = \App\Leaderboard::where('tournament_id', $tournament['id'])->where('score', '>', 0)->with('user', 'user_team')->take(3)->orderBy('score', 'DESC')->get()->toArray();
            $data['tournaments_list'][$key]['nextmatch'] = \App\Match::getNextMatch($tournament['id']);
        }


        $upcommingTour = \App\Tournament::all()->sortBy("start_date")->where('start_date', '>=', getGmtTime());

        $data['upcomming_tournaments_list'] = $upcommingTour->toArray(); //upcomming tournament of active
        $data['news'] = \App\BlogPost::where('post_type', 'news')->take(6)->orderBy('id', 'DESC')->get()->toArray();

        return view('home', $data);
    }

    public function __construct()
    {
        return;
        $t = \App\Player::where('id', 1)->with(
            'playing_category.playing_formats')->get()->unique('id')->toArray();

        $bowl = 0;
        $bat = 0;
        debugArr($t);

        foreach ($t['playing_category'] as $key => &$val) {


            if ($val['name'] == "bowling") {
                if ($bowl == 0) {
                    $bowl++;
                } else {
                    unset($t['playing_category'][$key]);
                }
            }


            if ($val['name'] == "batting") {
                if ($bat == 0) {
                    $bat++;
                } else {
                    unset($t['playing_category'][$key]);
                }
            }


        }
//return view('pages.player_stat');


    }


    public function sendUserEmail(Request $request)
    {
        $email = $request->user_email;
        $refferal_key = URL::to('/') . "/signup/?referral_key=" . \Auth::user()->referral_key;
        Mail::to($email)->send(new \App\Mail\SendRefferalEmailToUser($refferal_key));
        return response()->json([
            'success' => true
        ]);
    }


    public function scorecard(Request $request, $id, $tournament_id)
    {
        $data['tournament_id'] = $tournament_id;
        $data['match'] = \App\Match::where('id', $id)->with(
            ['match_players.player_gameTerm_score' => function ($q) use ($id) {
                return $q->where('match_id', $id)->where('player_term_count', '!=', 0);
            },

                'match_players.player_gameTerm_score.game_terms' => function ($q) {
                    $q->orderBy('id', 'ASC');
                },
                'match_players.player_match_stats' => function ($q) use ($id) {
                    $q->where('match_id', $id);
                }, 'match_players.player_actual_teams' => function ($query) use ($tournament_id) {
                $query->where('tournament_id', $tournament_id);
            }, 'match_players.player_roles' => function ($role) {
                $role->orderBy('game_role_id', 'ASC');
            }
            ])
            ->first()->toArray();
        $team_name = $data['match']['team_one'];
        if (!empty($request->team_name)) {
            $team_name = $request->team_name;
        }
        $data['team_name'] = strtoupper($team_name);
        // dd($team_name);
        // dd($data['match']['match_players'][0]);
        return view('pages.scorecard', $data);

    }

    public function squad($match_id, $tournament_id)
    {
        $squad = \App\Match::where('id', $match_id)->with(['match_players.player_actual_teams' => function ($q) use ($tournament_id) {
            $q->where('tournament_id', $tournament_id)->first();
        }])->get();
        if (empty($squad)) {
            $data['squad'] = [];
        } else {
            $data['squad'] = $squad->toArray();
        }
        return view('pages.squad', $data);

    }

    public function scorecardPopup(Request $request, $id, $tournament_id)
    {
        $data['tournament_id'] = $tournament_id;
        $data['match'] = \App\Match::where('id', $id)->with(
            ['match_players.player_gameTerm_score' => function ($q) use ($id) {
                return $q->where('match_id', $id)->where('player_term_count', '!=', 0);
            },

                'match_players.player_gameTerm_score.game_terms' => function ($q) {
                    $q->orderBy('id', 'ASC');
                },
                'match_players.player_match_stats' => function ($q) use ($id) {
                    $q->where('match_id', $id);
                }, 'match_players.player_actual_teams' => function ($query) use ($tournament_id) {
                $query->where('tournament_id', $tournament_id);
            }, 'match_players.player_roles' => function ($role) {
                $role->orderBy('game_role_id', 'ASC');
            }
            ])
            ->first()->toArray();

        $team_name = $data['match']['team_one'];
        if (!empty($request->team_name)) {
            $team_name = $request->team_name;
        }
        $data['team_name'] = strtoupper($team_name);
        // dd($team_name);
        // dd($data['match']['match_players'][0]);
        return view('pages.scorecard-popup', $data);

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public
    function test()
    {
        dd('test');
        // return view('user.team_detail1');

    }

    public
    function newdash()
    {

        $data['user_teams'] = \App\UserTeam::where('user_id', \Auth::id())
            ->get()
            ->toArray();
        //dd($data);
        //dd($data);
        $data['userprofileinfo'] = \App\User::findOrFail(\Auth::id());
        $data['upcommingTour'] = \App\Tournament::all()->sortBy("start_date")->where('start_date', '>=', getGmtTime());


        $data['upcommingTour']->toArray();


        return view('user.dashboard.newdash', $data);
    }


    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    function getServerTimeAsGMT()
    {
        $timestamp = localtime();
        $timestamp[5] += 1900;
        $timestamp[4]++;
        for ($i = 0; $i <= 9; $i++) {
            if ($timestamp[0] == $i) {
                $newValue = "0" . $i;
                $timestamp[0] = $newValue;
            }
        }
        for ($i = 0; $i <= 9; $i++) {
            if ($timestamp[1] == $i) {
                $newValue = "0" . $i;
                $timestamp[1] = $newValue;
            }
        }

        $this->timestamp = $timestamp[5] . "-" . $timestamp[4] . "-" . $timestamp[3] . " " . $timestamp[2] . ":" . $timestamp[1] . ":" . $timestamp[0];
        $this->timestamp = strtotime($this->timestamp);
        return $this->timestamp;
    }

    public function addPlayerStats($pid)
    {

        $api_key = config('const.cricapi_key');
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://cricapi.com/api/playerStats', [
            'query' => ['apikey' => $api_key, 'pid' => $pid]
        ]);
        $body = $res->getBody();
        $result = \GuzzleHttp\json_decode($body->getContents());
        $res = (array)$result;
        $syncdata = [];
        $player_id = \App\Player::where('cricapi_pid', $pid)->first()->id;
        \App\PlayerStatistics::where('player_id', $player_id)->delete();
        foreach ($res['data'] as $fkey => $batbowl) {
            foreach ($batbowl as $skey => $gameforamt) {
                //skey gives us formats key i.e listA,T20i,Batting bowling
                //fkey gives us batting blowling
                $format_id = \App\Format::where('name', $skey)->first()->id;
                $playing_cat_id = \App\PlayingCategory::where('name', $fkey)->first()->id;
                foreach ($gameforamt as $tkey => $types) {
                    echo $types . '<br>';
                    //type tell weather its 50 twty of etc

                    $type_id = \App\Type::where('name', $tkey)->first()->id . ' ' . $types . '<br>';




                }


            }
        }
        die;


    }


    public function leaderboard($tournament_id)
    {
        $data['leaders'] = \App\Leaderboard::where('tournament_id', $tournament_id)->with('user', 'user_team')->where('score', '>', 0)->take(20)->
        orderBy('score', 'DESC')->get()->toArray();
        //dd($data['leaders']);

        $data['tournamet'] = \App\Tournament::find($tournament_id)->name;

        return view('pages.leaderboard', $data);

    }

    function allTournaments()
    {

        $datetime = new \DateTime();
        $date = $datetime->format('Y-m-d H:i:s');
        $objTourmament = \App\Tournament::where('is_active', 1)->get()->sortByDesc('start_date');
        $data['tournaments_list'] = $objTourmament->toArray();
        return view('user.dashboard.home', $data);

    }


    public function fixturesDetial($tournament_id)
    {
        $data['fixture_details'] = \App\Tournament::where('slug', $tournament_id)->with(['tournament_matches' => function ($query) {
            $query->orderBy('start_date', 'asc');

        }])->firstOrFail()->toArray();

        return view('pages.fixtures', $data);

    }

    public function contactPage()
    {
        return view('pages.contact');
    }


    public function upcommingTournamnets()
    {
        return view('pages.upccoming_tournaments');
    }


    public function championTrophy()
    {
        return view('pages.fixtures_c_trophy');
    }

    public function rankings()
    {

        $data['rankings'] = \App\RankingCategory::with(['category_players' => function ($query) {
            $query->orderBy('rating', 'DESC');

        }])->get()->toArray();


        return view('pages.rankings', $data);
    }

    public function postContact(Request $request)
    {
        $this->validatorContact($request->all())->validate();
        $emailRecievers = [
            'umair_hamid100@yahoo.com',
            'hassan@branchezconsulting.com',
            'adeel@branchezconsulting.com'
        ];
        \Mail::send('emails.contact', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
        ), function ($message) use ($request, $emailRecievers) {
            $message->from($request->get('email'));
            $message->to($emailRecievers, 'Admin')->subject('Gamithon Contact');
        });
        return redirect()->back()->with('status', 'Thanks for contacting us!');
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected    function validatorContact(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
    }

    public    function termsCon()
    {
        return view('pages.t-c');
    }

    public    function privacyPolicy()
    {
        return view('pages.p-p');
    }

    function scoreRule()
    {
        $data['tournament'] = \App\Tournament::where('id', config('const.tournament_id'))
            ->with(['tournament_game.game_actions.game_terms', 'game_term_points' => function ($q) {
                $q->orderBY('points', 'DESC');


            }])
            ->firstOrFail()
            ->toArray();
        //dd( $data['tournament'] );
        $data['game_actions'] = $data['tournament']['tournament_game']['game_actions'];
        return view('pages.score-rule', $data);
    }

    public function fantasycricket()
    {
        return view('pages.fantasy-cricket');
    }


    public
    function aboutUs()
    {
        return view('pages.about_us');
    }


    public
    function howPlay()
    {


        $data['tournament'] = \App\Tournament::where('id', config('const.tournament_id'))
            ->with(['tournament_game.game_actions.game_terms', 'game_term_points' => function ($q) {
                $q->orderBY('points', 'DESC');


            }])
            ->firstOrFail()
            ->toArray();
        //dd( $data['tournament'] );
        $data['game_actions'] = $data['tournament']['tournament_game']['game_actions'];
        return view('pages.how-to-play', $data);
    }

    public   function searchUser(Request $request)
    {
        $searchParam = $request->get('searchParam');
        if (strlen($searchParam) > 2) {
            $user = User::where('email', 'like', '%' . $searchParam . '%')
                ->orWhere('name', 'like', '%' . $searchParam . '%')
                ->get()->toArray();
            return response()->json($user);
        }

    }
}
