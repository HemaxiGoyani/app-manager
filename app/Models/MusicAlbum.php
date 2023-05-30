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
 * Class MusicAlbum
 *
 * @package App\Models
 * @version September 2, 2021, 2:00 pm IST
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
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum newQuery()
 * @method static \Illuminate\Database\Query\Builder|MusicAlbum onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum query()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|MusicAlbum withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MusicAlbum withoutTrashed()
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Application[] $applications
 * @property-read int|null $applications_count
 * @property-read mixed $application
 * @property-read mixed $music_band
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicBand[] $musicBands
 * @property-read int|null $music_bands_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicRecord[] $musicRecords
 * @property-read int|null $music_records_count
 * @method static \Illuminate\Database\Eloquent\Builder|MusicAlbum findWithUuid($uuid, $with = [])
 */
class MusicAlbum extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    use HasFactory;

    public $table = 'music_albums';


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
    ];

    /**
     * Music Album may have one or more application.
     *
     * @return mixed
     */
    public function applications()
    {
        return $this->belongsToMany(Application::class, 'music_album_application', 'album_id', 'application_id')
            ->withTimestamps()
            ->withTrashed();
    }

    /**
     * Music Album may have one or more music band.
     *
     * @return mixed
     */
    public function musicBands()
    {
        return $this->belongsToMany(MusicBand::class, 'music_album_band', 'album_id', 'band_id')
            ->withTimestamps()
            ->withTrashed();
    }

    /**
     * Music Album may have one or more music band.
     *
     * @return mixed
     */
    public function musicRecords()
    {
        return $this->belongsToMany(MusicRecord::class, 'music_record_album', 'album_id', 'record_id')
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


        static::creating(function(MusicAlbum $musicAlbum){
            $musicAlbum->uuid = Str::uuid()->toString();
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
        return GeneralHelperFunctions::getSingleMediaUrls($this, 'musicAlbums');
    }

    /**
     * Returns Applications in Text
     * @return mixed
     */
    public function getApplicationAttribute() {
        return $this->applications->pluck('name')->join(', ');
    }

    /**
     * Returns music bands in Text
     * @return mixed
     */
    public function getMusicBandAttribute() {
        return $this->musicBands->pluck('name')->join(', ');
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
