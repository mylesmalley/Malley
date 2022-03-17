<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Labour extends BaseModel
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'labour';

    protected string $timezone = 'America/Moncton';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'job',
        'start',
        'end',
        'department_id',
        'flagged', // flagged for review
        'posted', // pushed to syspro?
    ];

    public $timestamps = false;

    /**
     * conditions around certain model events
     */
    protected static function booted()
    {
        // when creating a new labour instance,
        static::creating(function (self $labour): bool {
            if (Auth::user() && Auth::user()->can('labour_edit')) {
                return true;
            }

            // don't accept if an active labour record already exists.
            return ! $labour->user->hasActiveLabour;
        });
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return Carbon
     */
    public function getStartAttribute(): Carbon
    {
        return Carbon::parse($this->attributes['start']);
    }

    /**
     * @return Carbon|null
     */
    public function getEndAttribute(): Carbon|null
    {
        if ($this->attributes['end']) {
            return Carbon::parse($this->attributes['end']);
        } else {
            return null;
        }
    }

    /**
     * @return bool
     */
    public function finish(): bool
    {
        if (! $this->attributes['end']) {
            $this->attributes['end'] = Carbon::now($this->timezone)->toIso8601String();
        }

        return $this->save();
    }

    /**
     * @return CarbonInterval
     */
    public function getElapsedAttribute(): CarbonInterval
    {
        $end = ($this->end)
            ? Carbon::parse($this->attributes['end'])
            : Carbon::now($this->timezone);

        return Carbon::parse($this->attributes['start'])
            ->diffAsCarbonInterval($end);
    }

    /**
     * @return bool
     */
    public function toggleFlag(): bool
    {
        $this->attributes['flagged'] = ! $this->attributes['flagged'];

        return $this->save();
    }

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
