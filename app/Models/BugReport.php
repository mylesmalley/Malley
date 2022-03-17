<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BugReport extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'bug_reports';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'user_id',
        'related_id',
        'related_table',
        'title',
        'description',
        'type',
        'browser',
        'full_version',
        'major_version',
        'app_name',
        'user_agent',
        'os',
        'user_notes',
        'dev_notes',
        'status',
        'urgency',
        'program', // blueprint, index etc
        'url', // try to get the route with the problem

        // added for engineering addition
        'assigned_user_id', // default null
        'engineering_task', // bit, default 0

        'due_date',

        'file_locations',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function assignedUser()
    {
        return $this->belongsTo('App\Models\User', 'assigned_user_id', 'id');
    }

    public function getUserNameAttribute(): string
    {
        return $this->user->first_name.' '.$this->user->last_name;
    }

    /**
     * @var array
     */
    public $colours = [
        1 => 'eeeeee',
        2 => '67d33d',
        3 => '92c032',
        4 => 'a9b22a',
        5 => 'b9a524',
        6 => 'c5991e',
        7 => 'd18b18',
        8 => 'dc7b11',
        9 => 'e96509',
        10 => 'f64102',
    ];

    public static $blueprintUrgencies = [
        10 => "Critical - Can't continue!",
        9 => 'Really Bad',
        //  8 => "",
        7 => 'As soon as you can',
        // 6 => "",
        //  5 => "",
        4 => 'Normal',
        //    3 => "",
        //      2 => "",
        1 => 'Just a suggestion',
    ];

    public static $engineeringUrgencies = [
        10 => 'Order is complete, but cannot ship until this is taken care of.',
        9 => 'Customer Technical Support.',
        8 => 'Current build ongoing, not complete.',
        7 => 'Blueprint Option Create / Update',
        6 => 'Build scheduled, but not started',
        5 => 'Capture existing parts from the floor',
        4 => 'Update Drawing ECN / ECR',
        3 => 'Certification Process (OPLA, BNQ, KKK) ',
        2 => 'New Product development based on customer/internal request (Small change <1k hrs) ',
        1 => 'Large project development (>1k hrs)',
    ];

    /**
     * @return string[]
     */
    public static function blueprintUrgencyScale(): array
    {
        return self::$blueprintUrgencies;
    }

    /**
     * @return string[]
     */
    public static function engineeringUrgencyScale(): array
    {
        return self::$engineeringUrgencies;
    }

    /**
     * @return string
     */
    public function getUrgencyLabelAttribute(): string
    {
        if ($this->attributes['engineering_task']) {
            return self::$engineeringUrgencies[$this->attributes['urgency']];
        }

        return self::$blueprintUrgencies[$this->attributes['urgency']];
    }

    /**
     * @return string
     */
    public function getColourAttribute(): string
    {
        return '#'.$this->colours[$this->attributes['urgency']];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('App\Models\BugReportActivity')
            ->orderBy('sequence', 'ASC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nextActivities()
    {
        return $this->activities()
            ->where('completed', false)
            ->where('sequence', $this->nextSequence());
    }

    public function nextSequence(): int
    {
        $next = $this->activities()
            ->where('completed', false)->first();

        return $next->sequence ?? -1;
    }

    public function nextActivitySequence(): int
    {
        if (! $this->activities()->count()) {
            return 1;
        }

        $latest = $this->hasMany('App\Models\BugReportActivity')
        ->orderBy('sequence', 'DESC')
            ->first();

        return $latest->sequence + 1;
    }

    public function pendingUserActions(User $user)
    {
        return  self::withCount(['nextActivities' => function ($query) use ($user) {
                $query->where('assigned_user_id', $user->id);
            }, '>', 0])
            ->with(['nextActivities' => function ($query) use ($user) {
                $query->where('assigned_user_id', $user->id);
            }])

            ->get();
    }
}
