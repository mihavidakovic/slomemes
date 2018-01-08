<?php

namespace App\Listeners;

use Session;
use Gstt\Achievements\Model\AchievementProgress;
use Gstt\Achievements\Event\Unlocked;

class AchievementUnlocked
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(Unlocked $event)
    {
        // There's an AchievementProgress instance located on $event->progress
        Session::flash('achievement', $event->progress->details->name);
    }
}