<?php

namespace App\Models;

use App\MyClasses\GeneralHelperFunctions;
use App\Scopes\OrderScope;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class MusicBand
 *
 * @package App\Models
 * @version August 30, 2021, 9:39 am UTC
 * @property bigIncrements $id
 * @property string $name
 * @property tinyInteger $order
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $avatar_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand newQuery()
 * @method static \Illuminate\Database\Query\Builder|MusicBand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand query()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicBand whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|MusicBand withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MusicBand withoutTrashed()
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Application[] $applications
 * @property-read int|null $applications_count
 * @property-read mixed $application
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicAlbum[] $musicAlbums
 * @property-read int|null $music_albums_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicRecord[] $musicRecords
 * @property-read int|null $music_records_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Musician[] $musician
 * @property-read int|null $musician_count
 */
class MusicBand extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    use HasFactory;

    public $table = 'music_bands';


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
        'avatar' => 'image|max:1024',
        'applications' => 'nullable|array',
        'applications.*' => 'nullable|uuid|exists:applications,uuid,deleted_at,NULL',
    ];

    /**
     * Music Band may have one or more application.
     *
     * @return mixed
     */
    public function applications() {
        return $this->belongsToMany(Application::class, 'music_band_application', 'musicband_id', 'application_id')
            ->withTimestamps()
            ->withTrashed();
    }

    /**
     * Music Band may have one or more Music Album.
     *
     * @return mixed
     */
    public function musicAlbums(){
        return $this->belongsToMany(MusicAlbum::class, 'music_album_band','band_id', 'album_id')
            ->withTrashed();
    }

    /**
     * Music Band may have one or more Music Record.
     *
     * @return mixed
     */
    public function musicRecords(){
        return $this->belongsToMany(MusicRecord::class, 'music_record_band','band_id', 'record_id')
            ->withTrashed();
    }

    /**
     * One Music Band can have many Musicians
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function musician() {
        return $this->hasMany(\App\Models\Musician::class, 'band_fk', 'id')->withTrashed();;
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


        static::creating(function(MusicBand $musicBand){
            $musicBand->uuid = Str::uuid()->toString();
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
     * Returns avatar url
     * @return mixed
     */
    public function getAvatarUrlAttribute(){
        return GeneralHelperFunctions::getSingleMediaUrls($this, 'musicBands');
    }

    /**
     * Returns Applications in Text
     * @return mixed
     */
    public function getApplicationAttribute() {
        return $this->applications->pluck('name')->join(', ');
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
