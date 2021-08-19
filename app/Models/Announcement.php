<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;


/**
 * App\Models\Announcement
 *
 * @property int $id
 * @property string $content
 * @property mixed|null $start_date
 * @property mixed|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int|null $media_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement active()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereUserId($value)
 * @mixin \Eloquent
 */
class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcements';

    public $fillable = [
        'content',
        'user_id',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'media_id',
    ];

    protected  $casts = [
        'start_date' => 'date:y-m-d',
        'end_date' => 'date:y-m-d',
    ];


    protected  $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class );
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive( $query )
    {
        return $query->where([
            ['start_date', '<=', Carbon::now()],
            ['end_date', '>=', Carbon::now()]
        ]);
    }

    /**
     * @return mixed
     */
    public static function randomItem()
    {
        return Announcement::active()
            ->inRandomOrder()
            ->first();
    }


    public function media()
    {
        return Media::find( $this->attributes['media_id'] ) ?? Media::find( 22095 );

    }

}
