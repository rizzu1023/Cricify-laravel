<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        \App\Events\startInningEvent::class => [
            \App\Listeners\startInningListener::class,
        ],

        \App\Events\strikeRotateEvent::class => [
            \App\Listeners\strikeRotateListener::class,
        ],

        \App\Events\endInningEvent::class => [
            \App\Listeners\endInningListener::class,
        ],

        \App\Events\resetInningEvent::class => [
            \App\Listeners\resetInningListener::class,
        ],

        \App\Events\reverseEndInningEvent::class => [
            \App\Listeners\reverseEndInningListener::class,
        ],

        \App\Events\RetiredHurtBatsmanEvent::class => [
            \App\Listeners\RetiredHurtBatsmanListener::class,
        ],

        \App\Events\newOverEvent::class => [
            \App\Listeners\currentBowlerRemoveListener::class,
            \App\Listeners\newBowlerSelectListener::class,
            \App\Listeners\isOverFalseListener::class,
        ],

//        Run events

        \App\Events\dotBallEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\dotBallListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,

        ],
        \App\Events\reverseDotBallEvent::class => [
            \App\Listeners\reverseIsOverForTeam::class,
            \App\Listeners\reverseIsOverForBowler::class,
            \App\Listeners\reverseDotBallListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\oneRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\oneRunListener::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseOneRunEvent::class => [
            \App\Listeners\reverseIsOverForBowler::class,
            \App\Listeners\reverseIsOverForTeam::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseOneRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],


        \App\Events\twoRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\twoRunListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseTwoRunEvent::class => [
            \App\Listeners\reverseIsOverForTeam::class,
            \App\Listeners\reverseIsOverForBowler::class,
            \App\Listeners\reverseTwoRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\threeRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\threeRunListener::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseThreeRunEvent::class => [
            \App\Listeners\reverseIsOverForTeam::class,
            \App\Listeners\reverseIsOverForBowler::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseThreeRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\fourRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\fourRunListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseFourRunEvent::class => [
            \App\Listeners\reverseIsOverForTeam::class,
            \App\Listeners\reverseIsOverForBowler::class,
            \App\Listeners\reverseFourRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\fiveRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\fiveRunListener::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseFiveRunEvent::class => [
            \App\Listeners\reverseIsOverForTeam::class,
            \App\Listeners\reverseIsOverForBowler::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseFiveRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\sixRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\sixRunListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseSixRunEvent::class => [
            \App\Listeners\reverseIsOverForTeam::class,
            \App\Listeners\reverseIsOverForBowler::class,
            \App\Listeners\reverseSixRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

//        wicket events



        \App\Events\wicketEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\wicketListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseWicketEvent::class => [
            \App\Listeners\reverseIsOverForTeam::class,
            \App\Listeners\reverseIsOverForBowler::class,
            \App\Listeners\reverseWicketListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],
//        Leg Byes Events

        \App\Events\legByesOneRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\legByesOneRunListener::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseLegByesOneRunEvent::class => [
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseLegByesOneRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\legByesTwoRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\legByesTwoRunListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],
        \App\Events\reverseLegByesTwoRunEvent::class => [
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
            \App\Listeners\reverseLegByesTwoRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],
        \App\Events\legByesThreeRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\legByesThreeRunListener::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],
        \App\Events\reverseLegByesThreeRunEvent::class => [
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseLegByesThreeRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],
        \App\Events\legByesFourRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\legByesFourRunListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],
        \App\Events\reverseLegByesFourRunEvent::class => [
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
            \App\Listeners\reverseLegByesFourRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        //byes events

        \App\Events\byesOneRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\byesOneRunListener::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseByesOneRunEvent::class => [
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseByesOneRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\byesTwoRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\byesTwoRunListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseByesTwoRunEvent::class => [
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
            \App\Listeners\reverseByesTwoRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\byesThreeRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\byesThreeRunListener::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],

        \App\Events\reverseByesThreeRunEvent::class => [
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseByesThreeRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],
        \App\Events\byesFourRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\byesFourRunListener::class,
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
        ],
        \App\Events\reverseByesFourRunEvent::class => [
            \App\Listeners\isOverForBowler::class,
            \App\Listeners\isOverForTeam::class,
            \App\Listeners\reverseByesFourRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],


//        wide events

        \App\Events\wideZeroRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\wideZeroRunListener::class,
        ],

        \App\Events\reverseWideZeroRunEvent::class => [
            \App\Listeners\reverseWideZeroRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\wideOneRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\wideOneRunListener::class,
            \App\Listeners\strikeRotateListener::class,
        ],

        \App\Events\reverseWideOneRunEvent::class => [
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseWideOneRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],


        \App\Events\wideTwoRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\wideTwoRunListener::class,
        ],
        \App\Events\reverseWideTwoRunEvent::class => [
            \App\Listeners\reverseWideTwoRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\wideThreeRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\wideThreeRunListener::class,
            \App\Listeners\strikeRotateListener::class,
        ],

        \App\Events\reverseWideThreeRunEvent::class => [
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseWideThreeRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],
        \App\Events\wideFourRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\wideFourRunListener::class,
        ],
        \App\Events\reverseWideFourRunEvent::class => [
            \App\Listeners\reverseWideFourRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],


//        no ball event

        \App\Events\noballZeroRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\noballZeroRunListener::class,
        ],

        \App\Events\reverseNoballZeroRunEvent::class => [
            \App\Listeners\reverseNoballZeroRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\noballOneRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\noballOneRunListener::class,
            \App\Listeners\strikeRotateListener::class,
        ],

        \App\Events\reverseNoballOneRunEvent::class => [
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseNoballOneRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\noballTwoRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\noballTwoRunListener::class,
        ],

        \App\Events\reverseNoballTwoRunEvent::class => [
            \App\Listeners\reverseNoballTwoRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\noballThreeRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\noballThreeRunListener::class,
            \App\Listeners\strikeRotateListener::class,
        ],

        \App\Events\reverseNoballThreeRunEvent::class => [
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseNoballThreeRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\noballFourRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\noballFourRunListener::class,
        ],

        \App\Events\reverseNoballFourRunEvent::class => [
            \App\Listeners\reverseNoballFourRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\noballFiveRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\noballFiveRunListener::class,
            \App\Listeners\strikeRotateListener::class,
        ],

        \App\Events\reverseNoballFiveRunEvent::class => [
            \App\Listeners\strikeRotateListener::class,
            \App\Listeners\reverseNoballFiveRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],

        \App\Events\noballSixRunEvent::class => [
            \App\Listeners\matchTrackListener::class,
            \App\Listeners\noballSixRunListener::class,
        ],

        \App\Events\reverseNoballSixRunEvent::class => [
            \App\Listeners\reverseNoballSixRunListener::class,
            \App\Listeners\reverseMatchTrackListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
