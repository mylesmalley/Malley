<?php

namespace App\Models;

use App\Models\BaseModel;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

/**
 * App\Models\BugReportActivity
 *
 * @property int $id
 * @property int $bug_report_id
 * @property int $assigned_user_id
 * @property int $sequence
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $assigned_at
 * @property string|null $due_at
 * @property string|null $notes
 * @property int $user_id
 * @property bool $completed
 * @property string|null $due_date
 * @property-read \App\Models\User $assignedUser
 * @property-read \App\Models\BugReport $bugReport
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereAssignedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereAssignedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereBugReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereDueAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereSequence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BugReportActivity whereUserId($value)
 * @mixin \Eloquent
 */
class BugReportActivity  extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

	protected $table = 'bug_report_activities';

    protected $fillable = [
        'id',
        'bug_report_id',
        'sequence',
        'user_id',
        'assigned_user_id',
	    'created_at',
        'updated_at',
        'assigned_at',
        'due_at',
        'title',
	    'notes',
        'completed',
        'due_date',

    ];






    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bugReport()
    {
        return $this->belongsTo('App\Models\BugReport');
    }


    public function assignedUser()
    {
        return $this->belongsTo('App\Models\User', 'assigned_user_id', 'id');
    }


	/**
	 * @var array
	 */
    public $colours = [
    	1 => "eeeeee",
    	2 => "67d33d",
	    3 => "92c032",
	    4 => "a9b22a",
		5 => "b9a524",
		6 => "c5991e",
	    7 => "d18b18",
	    8 => "dc7b11",
	    9 => "e96509",
	    10 => "f64102",
    ];



    public function toggleCompletion()
    {
        $this->attributes['completed'] = ! $this->attributes['completed'];
        $this->save();
    }

}
