<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'announcements';

    /**
     * @var array|string[]
     */
    protected $fillable = [
        'content',
        'user_id',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'media_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'start_date' => 'date:y-m-d',
        'end_date' => 'date:y-m-d',    ];

    /**
     * @var string[]
     */

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where([
            ['start_date', '<=', Carbon::now()],
            ['end_date', '>=', Carbon::now()],
        ]);
    }

    /**
     * @return mixed
     */
    public static function randomItem()
    {
        return self::active()
            ->inRandomOrder()
            ->first();
    }

    public function media()
    {
        return Media::find($this->attributes['media_id']) ?? Media::find(22095);
    }
}
