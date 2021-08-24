<?php

namespace Modules\Blueprint\Http\Controllers\Wizard;

use App\Models\WizardQuestion;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

class RedirectFunctions extends Controller
{

    /**
     * FORD TRANSIT MOBILITY
     *     Redirect based on commercial or personal and lift entry direction
     *
     * redirects in a chain depending on previous answers chosen
     *
     * @param Collection $selectedAnswers
     * @return WizardQuestion
     */
    public static function transitMobilityOptions( Collection $selectedAnswers  ): WizardQuestion
    {
        // commercial side entry
        if ( $selectedAnswers->contains(93) // commercial
            && $selectedAnswers->contains(99)) // side entry
        {
            return WizardQuestion::find( 22 );
        }

        // commercial rear entry and rear ramp
        if ( $selectedAnswers->contains(93) //commercial
            && ( $selectedAnswers->contains(98) // rear entry
                || $selectedAnswers->contains(100)  )) // rear ramp
        {
            return WizardQuestion::find( 24 );
        }

        // personal  rear entry and rear ramp
        if ( $selectedAnswers->contains(94) // personal
            && ( $selectedAnswers->contains(95) // rear entry
                || $selectedAnswers->contains(97  ) )) // rear ramp
                {
            return WizardQuestion::find( 23 );
        }

        // personal side entry
        if ( $selectedAnswers->contains(94) // personal
            && $selectedAnswers->contains(96)) // side entry
        {
            return WizardQuestion::find( 21 );
        }

        return WizardQuestion::find( 35 );

    }


}
