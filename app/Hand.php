<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hand extends Model
{
    public const FACES = ['2', '3', '4', '5', '6', '7', '8', '9', 'T', 'J', 'Q', 'K', 'A'];
    public const SUITS = ['H', 'D', 'C', 'S'];
    public const SCORE_WEIGHTS = [9 => "straight-flush", 8 => "four-of-a-kind", 7 => "full-house", 6 => "flush", 5 => "straight", 4 => "three-of-a-kind", 3 => "two-pair", 2 => "one-pair", 1 => "high-card"];

    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'round', 'player', 'card_1', 'card_2', 'card_3', 'card_4', 'card_5'
    ];

}
