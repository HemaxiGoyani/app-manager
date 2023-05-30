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
 * Class MusicRecord
 *
 * @package App\Models
 * @version September 2, 2021, 4:55 pm IST
 * @property bigIncrements $id
 * @property string $name
 * @property tinyInteger $order
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read array|null $music_record_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord newQuery()
 * @method static \Illuminate\Database\Query\Builder|MusicRecord onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicRecord whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|MusicRecord withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MusicRecord withoutTrashed()
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Application[] $applications
 * @property-read int|null $applications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicLyric[] $lyrics
 * @property-read int|null $lyrics_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicAlbum[] $musicAlbums
 * @property-read int|null $music_albums_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicBand[] $musicBands
 * @property-read int|null $music_bands_count
 * @property-read mixed $application
 * @property-read mixed $music_album
 * @property-read mixed $music_band
 */
class MusicRecord extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    use HasFactory;

    public $table = 'music_records';


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
        'music' => 'required|mimes:mp3,wav',
        'applications' => 'nullable|array',
        'applications.*' => 'nullable|uuid|exists:applications,uuid,deleted_at,NULL',
        'music_bands' => 'nullable|array',
        'music_bands.*' => 'nullable|uuid|exists:music_bands,uuid,deleted_at,NULL',
        'music_albums' => 'nullable|array',
        'music_albums.*' => 'nullable|uuid|exists:music_albums,uuid,deleted_at,NULL',
    ];

    /**
     * music records can have many music lyrics
     *
     * @return mixed
     */
    public function lyrics()
    {
        return $this->hasMany(\App\Models\MusicLyric::class, 'music_fk', 'id');
    }

    /**
     * Music Record may have one or more applicat-ion.
     *
     * @return mixed
     */
    public function applications()
    {
        return $this->belongsToMany(Application::class, 'music_record_application', 'record_id', 'application_id')
            ->withTimestamps()
            ->withTrashed();
    }

    /**
     * Music Record may have one or more music band.
     *
     * @return mixed
     */
    public function musicBands()
    {
        return $this->belongsToMany(MusicBand::class, 'music_record_band', 'record_id', 'band_id')
            ->withTimestamps()
            ->withTrashed();
    }

    /**
     * Music Record may have one or more Music Album
     *
     * @return mixed
     */
    public function musicAlbums()
    {
        return $this->belongsToMany(MusicAlbum::class, 'music_record_album', 'record_id', 'album_id')
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


        static::creating(function(MusicRecord $musicRecord){
            $musicRecord->uuid = Str::uuid()->toString();
        });

        static::deleting(function (MusicRecord $musicRecord) {
            GeneralHelperFunctions::deleteModelRecordsOneByOne($musicRecord->lyrics);
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

    /**
     * Returns music bands in Text
     * @return mixed
     */
    public function getMusicBandAttribute() {
        return $this->musicBands->pluck('name')->join(', ');
    }

    /**
     * Returns music Albums in Text
     * @return mixed
     */
    public function getMusicAlbumAttribute() {
        return $this->musicAlbums->pluck('name')->join(', ');
    }

    /**
     * Get Music recording Download Link
     * @return array|null
     */
    public function getMusicRecordUrlAttribute() {
        if($this->hasMedia('musics')) {
            $musicRecord = $this->getFirstMedia('musics');
            return [
                'name' => $musicRecord->file_name,
                'url' => route('media_response', [
                    'model' => 'musicRecords',
                    'modelUuid' => $this->uuid,
                    'collection' => 'musics',
                    'mediaId' => $musicRecord->id,
                    'name' => $musicRecord->name,
                ]),
            ];
        }else{
            return null;
        }
    }
    /**
     * Registers the Media Collections to the model.
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('musics')
            ->singleFile();
    }
}
