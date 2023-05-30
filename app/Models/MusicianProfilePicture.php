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
 * Class MusicianProfilePicture
 *
 * @package App\Models
 * @version September 1, 2021, 8:56 am IST
 * @property \App\Models\Musician $musicianFk
 * @property bigIncrements $id
 * @property string $name
 * @property integer $musician_fk
 * @property tinyInteger $order
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $avatar_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture newQuery()
 * @method static \Illuminate\Database\Query\Builder|MusicianProfilePicture onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture query()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture whereMusicianFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicianProfilePicture whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|MusicianProfilePicture withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MusicianProfilePicture withoutTrashed()
 * @mixin Model
 * @property-read \App\Models\Musician $musician
 */
class MusicianProfilePicture extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    use HasFactory;

    public $table = 'musician_profile_pictures';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'name',
        'musician_fk',
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
        'musician_fk' => 'integer',
        'uuid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'musician_fk' => 'required|integer|exists:musicians,id,deleted_at,NULL',
        'order' => 'nullable|integer',
        'avatar' => 'image|max:1024',
    ];

    /**
     * Label corrections for inputs.
     * @var string[]
     */
    public static $labels = [
        'musician_fk' => 'musician',
    ];

    /**
     * one Musician Profile Picture can belong to one Musician Band
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function musician() {
        return $this->belongsTo(\App\Models\Musician::class, 'musician_fk', 'id');
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


        static::creating(function(MusicianProfilePicture $musicianProfilePicture){
            $musicianProfilePicture->uuid = Str::uuid()->toString();
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
        return GeneralHelperFunctions::getSingleMediaUrls($this, 'musicianProfilePictures');
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
