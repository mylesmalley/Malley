<?php

namespace App\Models;

use App\Models\BaseModel;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

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
