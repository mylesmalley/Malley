<?php
    namespace Modules\Labour\Http\Controllers\ManageLabour;

    use Carbon\Carbon;

    trait ParsesTimeTrait
    {
        /**
         * @param string $date
         * @param string $hours
         * @param string $minutes
         * @param string $ampm
         * @return Carbon
         */
        private function parse_time( string $date, string $hours, string $minutes, string $ampm): Carbon
        {

            $newEndString = $date . ' ' .
                $hours . ":" .
                str_pad($minutes, 2, '0', STR_PAD_LEFT)
                . ' ' . $ampm;

            return Carbon::parse($newEndString, 'America/Moncton' );
        }

    }