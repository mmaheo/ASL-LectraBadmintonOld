<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';

    protected $fillable = [
        'first_set_first_team',
        'first_set_second_team',
        'second_set_first_team',
        'second_set_second_team',
        'third_set_first_team',
        'third_set_second_team',
        'display',
        'first_team_id',
        'second_team_id',
        'my_wo',
        'his_wo',
        'unplayed',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'display' => 'boolean',
        'my_wo'    => 'boolean',
        'his_wo'   => 'boolean',
        'unplayed' => 'boolean',
    ];

    public function firstTeam()
    {
        return $this->belongsTo('App\Team');
    }

    public function secondTeam()
    {
        return $this->belongsTo('App\Team');
    }
}
