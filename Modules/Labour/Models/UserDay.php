<?php


namespace Modules\Labour\Models;

//use App\Models\BaseModel;
use App\Models\Labour;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;


class UserDay
{
    public User $user;
    public Collection $labour;
    public Carbon $date;

    public function __construct( User $user, Carbon $date = null )
    {
        $this->user = $user;

        $this->date = $date ?? Carbon::today();

        $this->labour = Labour::where('user_id', $this->user->id )
            ->whereDate('start', $this->date )
            ->with('user.department')
            ->orderBy('start')
            ->get();
    }

    public static function get( int $user_id, string $date ): array
    {
        $user = User::find( $user_id );
        $date = Carbon::create($date, 'America/Moncton' );

        $rawLabour = Labour::where('user_id', $user->id )
            ->whereDate('start', $date )
            ->with('department')
            ->orderBy('start')
            ->get();

        $labour = [];

        foreach( $rawLabour as $lab )
        {
            $labour[] = [
                'id' => $lab->id,
                'user_id' => $lab->user_id ?? 1,
                'job' => $lab->job,
                'start' => $lab->start->format('g:i A'),
                'end' => ($lab->end) ?  $lab->end->format('g:i A') : null,
                'department' => $lab->department->name ?? 'Not Set',
                'flagged' => $lab->flagged,
                'posted' => $lab->posted,
            ] ;
        }

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

        ];
    }




//
//    public static function getFlagged( int $user_id, string $date ): array|null
//    {
//        $user = User::find( $user_id );
//        $date = Carbon::create($date, 'America/Moncton' );
//
//        $rawLabour = Labour::where('user_id', $user->id )
//            ->where('flagged', true)
//            ->whereDate('start', $date )
//            ->with('department')
//            ->orderBy('start')
//            ->get();
//
//        $labour = [];
//
//        if ( count( $labour) === 0) return null;
//
//        foreach( $rawLabour as $lab )
//        {
//            $labour[] = [
//                'id' => $lab->id,
//                'user_id' => $lab->user_id ?? 1,
//                'job' => $lab->job,
//                'start' => $lab->start->format('g:i A'),
//                'end' => ($lab->end) ?  $lab->end->format('g:i A') : null,
//                'department' => $lab->department->name ?? 'Not Set',
//                'flagged' => $lab->flagged,
//                'posted' => $lab->posted,
//            ] ;
//        }
//
//        return [
//            'user' => [
//                'id' => $user->id,
//                'first_name' => $user->first_name,
//                'last_name' => $user->last_name,
//                'department_id' => $user->department_id,
//                'department' => $user->department->name ?? 'Not Set',
//            ],
//            'labour' => $labour,
//            'date' => $date->format('Y-m-d'),
//            'dayName' => $date->format('l'),
//            'monthDay' => $date->format('M d'),
//
//        ];
//    }
//

}
