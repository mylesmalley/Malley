<?php


namespace Modules\Labour\Models;

use App\Models\Labour;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class UserDay
{
    /**
     * @param User $user
     * @param string $date
     * @return array
     */
   public static function get(User $user, string $date ): array
    {
       return Cache::remember('_user_day_'.$user->id.'-'.$date ,
            Carbon::now()->addDays(30), function() use ($user, $date) {

                //  $user = User::find( $user_id );
                $date = Carbon::create($date, 'America/Moncton');

                $rawLabour = Labour::where('user_id', $user->id)
                    ->whereDate('start', $date)
                    ->with('department')
                    ->orderBy('start')
                    ->get();

                $labour = [];
                $total_elapsed_labour = 0;

                foreach ($rawLabour as $lab) {

                    $labour[] = [
                        'id' => $lab->id,
                        'user_id' => $lab->user_id ?? 1,
                        'job' => $lab->job,
                        'start' => $lab->start->format('g:i A'),
                        'end' => ($lab->end) ? $lab->end->format('g:i A') : null,
                        'elapsed' => $lab->elapsed->forHumans(['parts' => 2]),
                        'department' => $lab->department->name ?? 'Not Set',
                        'flagged' => $lab->flagged,
                        'posted' => $lab->posted,
                    ];
                    //  dd( $lab->elapsed->format('%s') );
                    $total_elapsed_labour += (int)$lab->elapsed->totalSeconds;
                }

                //  $total = CarbonInterval::make( $total_elapsed_labour ,'seconds' );

                return [
                    'user' => [
                        'id' => $user->id,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'department_id' => $user->department_id,
                        'department' => $user->department->name ?? 'Not Set',
                    ],
                    'labour' => $labour,
                    'date' => $date->format('Y-m-d'),
                    'dayName' => $date->format('l'),
                    'monthDay' => $date->format('M d'),
                    'total_elapsed_labour' => number_format($total_elapsed_labour / 3600, 1),
                ];

            });
    }





}
