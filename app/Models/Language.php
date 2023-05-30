<?php

namespace App\Models;

use App\MyClasses\GeneralHelperFunctions;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Class Language
 *
 * @package App\Models
 * @version September 3, 2021, 11:38 am IST
 * @property bigIncrements $id
 * @property string $name
 * @property tinyInteger $order
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MusicLyric[] $lyrics
 * @property-read int|null $lyrics_count
 * @method static \Illuminate\Database\Eloquent\Builder|Language findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Query\Builder|Language onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Language withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Language withoutTrashed()
 * @mixin Model
 */
class Language extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'languages';


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
        'order' => 'nullable|integer'
    ];

    /**
     * languages can have many music lyrics
     *
     * @return mixed
     */
    public function lyrics()
    {
        return $this->hasMany(\App\Models\MusicLyric::class, 'language_fk', 'id');
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


        static::creating(function(Language $language){
            $language->uuid = Str::uuid()->toString();
        });

        static::deleting(function (Language $language) {
            GeneralHelperFunctions::deleteModelRecordsOneByOne($language->lyrics);
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
