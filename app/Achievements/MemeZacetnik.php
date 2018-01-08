<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;
use App\User;
use Auth;

class MemeZacetnik extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Meme začetnik";

    /*
     * A small description for the achievement
     */
    public $description = "";
    public $points = 50;
    
    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        $user = User::find(Auth::user()->id);
        $user->rank = "Meme začetnik";
        $user->save();
    }
}
