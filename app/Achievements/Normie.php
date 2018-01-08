<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;
use App\User;
use Auth;

class Normie extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Normie";

    /*
     * A small description for the achievement
     */
    public $description = "";

    public $points = 15;
    
    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        $user = User::find(Auth::user()->id);
        $user->rank = "Normie";
        $user->save();
    }
}
