<?php

namespace App\Models;

use App\MyClasses\GeneralHelperFunctions;
use App\Scopes\OrderScope;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Class Musician
 *
 * @package App\Models
 * @version August 31, 2021, 5:05 pm IST
 * @property \App\Models\MusicBand $bandFk
 * @property bigIncrements $id
 * @property string $name
 * @property integer $band_fk
 * @property tinyInteger $order
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Application[] $applications
 * @property-read int|null $applications_count
 * @property-read \App\Models\MusicBand $musicBand
 * @method static \Illuminate\Database\Eloquent\Builder|Musician findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Musician newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Musician newQuery()
 * @method static \Illuminate\Database\Query\Builder|Musician onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Musician query()
 * @method static \Illuminate\Database\Eloquent\Builder|Musician whereBandFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Musician whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Musician whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Musician whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Musician whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Musician whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Musician whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Musician whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Musician withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Musician withoutTrashed()
 * @mixin Model
 * @property-read mixed $application
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicianProfilePicture[] $musicianProfilePicture
 * @property-read int|null $musician_profile_picture_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicianVideo[] $musicianVideo
 * @property-read int|null $musician_video_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WallpaperCategory[] $wallpaperCategory
 * @property-read int|null $wallpaper_category_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wallpaper[] $wallpapers
 * @property-read int|null $wallpapers_count
 */
class Musician extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'musicians';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'name',
        'band_fk',
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
        'band_fk' => 'integer',
        'uuid' => 'string'
    ];

    /**
     * Validation rules
     *m
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:190',
        'band_fk' => 'required|integer|exists:music_bands,id,deleted_at,NULL',
        'order' => 'nullable|integer',
        'applications' => 'nullable|array',
        'applications.*' => 'nullable|uuid|exists:applications,uuid,deleted_at,NULL',
    ];

    /**
     * Label corrections for inputs.
     * @var string[]
     */
    public static $labels = [
        'band_fk' => 'music band',
    ];

    /**
     * one Musician can belong to one Music Band
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function musicBand() {
        return $this->belongsTo(\App\Models\MusicBand::class, 'band_fk', 'id')->withTrashed();
    }

    /**
     * One Musician can have many Musician Profile Picture
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function musicianProfilePicture() {
        return $this->hasMany(\App\Models\MusicianProfilePicture::class, 'musician_fk', 'id');;
    }

    /**
     * Musician may have one or more wallpaper category.
     *
     * @return mixed
     */
    public function wallpaperCategory()
    {
        return $this->belongsToMany(WallpaperCategory::class, 'wallpaper_category_musician', 'musician_id', 'category_id')
            ->withTimestamps()
            ->withTrashed();
    }

    /**
     * Musician may have one or more wallpaper.
     *
     * @return mixed
     */
    public function wallpapers()
    {
        return $this->belongsToMany(Wallpaper::class, 'wallpaper_musician', 'musician_id', 'wallpaper_id')
            ->withTimestamps()
            ->withTrashed();
    }


    /**
     * One Musician can have many Musician Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function musicianVideo() {
        return $this->hasMany(\App\Models\MusicianVideo::class, 'musician_fk', 'id');;
    }

    /**
     * Musician may have one or more application.
     *
     * @return mixed
     */
    public function applications()
    {
        return $this->belongsToMany(Application::class, 'musician_application', 'musician_id', 'application_id')
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


        static::creating(function(Musician $musician){
            $musician->uuid = Str::uuid()->toString();
        });

        static::deleting(function (Musician $musician) {
            GeneralHelperFunctions::deleteModelRecordsOneByOne($musician->musicianProfilePicture);
            GeneralHelperFunctions::deleteModelRecordsOneByOne($musician->musicianVideo);
        });

        static::addGlobalScope(new OrderScope());

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
     * Returns Applications in Text
     * @return mixed
     */
    public function getApplicationAttribute() {
        return $this->applications->pluck('name')->join(', ');
    }
}
