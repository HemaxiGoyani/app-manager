<?php

namespace App\Models;

use App\MyClasses\GeneralHelperFunctions;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Class WallpaperCategory
 *
 * @package App\Models
 * @version September 3, 2021, 3:03 pm IST
 * @property bigIncrements $id
 * @property string $name
 * @property tinyInteger $order
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Musician[] $musicians
 * @property-read int|null $musicians_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wallpaper[] $wallpaper
 * @property-read int|null $wallpaper_count
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|WallpaperCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WallpaperCategory whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|WallpaperCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|WallpaperCategory withoutTrashed()
 * @mixin Model
 * @property-read mixed $musician
 */
class WallpaperCategory extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'wallpaper_categories';


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
        'uuid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:190',
        'order' => 'nullable|integer',
        'musicians' => 'nullable|array',
        'musicians.*' => 'nullable|uuid|exists:musicians,uuid,deleted_at,NULL',
    ];

    /**
     * wallpaper category can have many wallpapers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function wallpaper()
    {
        return $this->hasMany(\App\Models\Wallpaper::class, 'category_fk', 'id');
    }

    /**
     * Wallpaper Category may have one or more Musician
     *
     * @return mixed
     */
    public function musicians()
    {
        return $this->belongsToMany(Musician::class, 'wallpaper_category_musician', 'category_id', 'musician_id')
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


        static::creating(function(WallpaperCategory $wallpaperCategory){
            $wallpaperCategory->uuid = Str::uuid()->toString();
        });

        static::deleting(function (WallpaperCategory $wallpaperCategory) {
            GeneralHelperFunctions::deleteModelRecordsOneByOne($wallpaperCategory->wallpaper);
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
     * Returns musicians in Text
     * @return mixed
     */
    public function getMusicianAttribute() {
        return $this->musicians->pluck('name')->join(', ');
    }
}
