<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Class WallpaperTag
 *
 * @package App\Models
 * @version September 3, 2021, 3:55 pm IST
 * @property bigIncrements $id
 * @property string $name
 * @property tinyInteger $order
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wallpaper[] $wallpapers
 * @property-read int|null $wallpapers_count
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag newQuery()
 * @method static \Illuminate\Database\Query\Builder|WallpaperTag onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperTag whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|WallpaperTag withTrashed()
 * @method static \Illuminate\Database\Query\Builder|WallpaperTag withoutTrashed()
 * @mixin Model
 * @property-read string|null $last_updated_at
 */
class WallpaperTag extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'wallpaper_tags';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'name',
        'order',
        'uuid',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'uuid' => 'string',
        'updated_at' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:190',
        'order' => 'nullable|integer'
    ];

    /**
     * Wallpaper Tag may have one or more wallpaper.
     *
     * @return mixed
     */
    public function wallpapers()
    {
        return $this->belongsToMany(Wallpaper::class, 'wallpaper_tag', 'tag_id', 'wallpaper_id')
            ->withTimestamps()
            ->withTrashed();
    }

    /**
     * Changing route key name
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Things require during the boot
     */
    protected static function booted() {
        parent::booted();


        static::creating(function(WallpaperTag $wallpaperTag){
            $wallpaperTag->uuid = Str::uuid()->toString();
        });
    }

    /**
     * Get Object by UUID
     *
     * @param $query
     * @param $uuid
     * @param array $with
     * @return mixed
     */
    public function scopeFindWithUuid($query,$uuid,$with = []){
        return $query->where('uuid',$uuid)->with($with)->firstOrFail();
    }

    /**
     * Returns just the date from last updated at column
     * @return string|null
     */
    public function getLastUpdatedAtAttribute() {
        return $this->updated_at ? $this->updated_at->toDayDateTimeString() : null;
    }
}
