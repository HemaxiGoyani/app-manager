<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Class MusicLyric
 *
 * @package App\Models
 * @version September 3, 2021, 12:50 pm IST
 * @property \App\Models\MusicRecord $musicFk
 * @property \App\Models\Language $languageFk
 * @property bigIncrements $id
 * @property integer $music_fk
 * @property integer $language_fk
 * @property string $lyrics
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Language $language
 * @property-read \App\Models\MusicRecord $music
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric newQuery()
 * @method static \Illuminate\Database\Query\Builder|MusicLyric onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric query()
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric whereLanguageFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric whereLyrics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric whereMusicFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MusicLyric whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|MusicLyric withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MusicLyric withoutTrashed()
 * @mixin Model
 */
class MusicLyric extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'music_lyrics';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'music_fk',
        'language_fk',
        'lyrics',
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
        'music_fk' => 'integer',
        'language_fk' => 'integer',
        'lyrics' => 'string',
        'uuid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'music_fk' => 'required|integer|exists:music_records,id,deleted_at,NULL',
        'language_fk' => 'required|integer|exists:languages,id,deleted_at,NULL',
        'lyrics' => 'required|string'
    ];

    /**
     * Label corrections for inputs.
     * @var string[]
     */
    public static $labels = [
        'music_fk' => 'music',
        'language_fk' => 'language',
    ];

    /**
     * music lyrics can only belong to one music record
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function music()
    {
        return $this->belongsTo(\App\Models\MusicRecord::class, 'music_fk', 'id');
    }

    /**
     *  music lyrics can only belong to one language
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function language()
    {
        return $this->belongsTo(\App\Models\Language::class, 'language_fk', 'id');
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


        static::creating(function(MusicLyric $musicLyric){
            $musicLyric->uuid = Str::uuid()->toString();
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
}
