<?php

namespace App\Models;

use App\MyClasses\GeneralHelperFunctions;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Wallpaper
 *
 * @package App\Models
 * @version September 3, 2021, 4:05 pm IST
 * @property \App\Models\WallpaperCategory $categoryFk
 * @property bigIncrements $id
 * @property string $name
 * @property integer $category_fk
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\WallpaperCategory $category
 * @property-read mixed $avatar_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Musician[] $musicians
 * @property-read int|null $musicians_count
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper newQuery()
 * @method static \Illuminate\Database\Query\Builder|Wallpaper onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper whereCategoryFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallpaper whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Wallpaper withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Wallpaper withoutTrashed()
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WallpaperTag[] $tags
 * @property-read int|null $tags_count
 * @property-read mixed $musician
 * @property-read mixed $tag
 */
class Wallpaper extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    use HasFactory;

    public $table = 'wallpapers';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'name',
        'category_fk',
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
        'category_fk' => 'integer',
        'uuid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'avatar' => 'nullable|image|max:2048',
        'name' => 'required|string|max:190',
        'category_fk' => 'required|integer|exists:wallpaper_categories,id,deleted_at,NULL',
        'musicians' => 'nullable|array',
        'musicians.*' => 'nullable|uuid|exists:musicians,uuid,deleted_at,NULL',
        'wallpaper_tags' => 'nullable|array',
        'wallpaper_tags.*' => 'nullable|uuid|exists:wallpaper_tags,uuid,deleted_at,NULL',
    ];


    /**
     * Label corrections for inputs.
     * @var string[]
     */
    public static $labels = [
        'category_fk' => 'category',
    ];

    /**
     * wallpaper can  have one categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\WallpaperCategory::class, 'category_fk', 'id');
    }

    /**
     * Wallpaper may have one or more Musician
     *
     * @return mixed
     */
    public function musicians()
    {
        return $this->belongsToMany(Musician::class, 'wallpaper_musician', 'wallpaper_id', 'musician_id')
            ->withTimestamps()
            ->withTrashed();
    }

    /**
     * Wallpaper may have one or more Tag
     *
     * @return mixed
     */
    public function tags()
    {
        return $this->belongsToMany(WallpaperTag::class, 'wallpaper_tag', 'wallpaper_id', 'tag_id')
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


        static::creating(function(Wallpaper $wallpaper){
            $wallpaper->uuid = Str::uuid()->toString();
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

    /**
     * Returns wallpaper tags in Text
     * @return mixed
     */
    public function getTagAttribute() {
        return $this->tags->pluck('name')->join(', ');
    }

    /**
     * Returns avatar url
     * @return mixed
     */
    public function getAvatarUrlAttribute(){
        return GeneralHelperFunctions::getSingleMediaUrls($this, 'wallpapers');
    }

    /**
     * Registering media collection
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType,['image/gif','image/png','image/jpeg']);
            })
            ->withResponsiveImages()
            ->singleFile();
    }

    /**
     * Register Media Conversions.
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb_100x100')
            ->width(100)
            ->height(100)
            ->nonQueued()
            ->keepOriginalImageFormat()
            ->performOnCollections('avatar');

        $this->addMediaConversion('thumb_250x250')
            ->width(250)
            ->height(250)
            ->nonQueued()
            ->keepOriginalImageFormat()
            ->performOnCollections('avatar');
    }
}
