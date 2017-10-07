<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayingCategory extends Model
{

    protected $table = 'playing_category';
    public $timestamps = false;
    public function type(){
        return $this->belongsToMany(
            '\App\Type','player_stats_details','playing_category','type_id');

    }


}
