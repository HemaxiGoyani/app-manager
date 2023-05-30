<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Class Application
 * @package App\Models
 * @version August 30, 2021, 8:22 am UTC
 *
 * @property \App\Models\Account $accountFk
 * @property bigIncrements $id
 * @property string $name
 * @property integer $version_count
 * @property string $version
 * @property integer $account_fk
 * @property string $package
 * @property string $notification_app_id
 * @property string $notification_server_key
 * @property string $update_title
 * @property string $update_message
 * @property boolean $status
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class Application extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'applications';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'name',
        'version_count',
        'version',
        'account_fk',
        'package',
        'notification_app_id',
        'notification_server_key',
        'update_title',
        'update_message',
        'status',
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
        'version_count' => 'integer',
        'version' => 'string',
        'account_fk' => 'integer',
        'package' => 'string',
        'notification_app_id' => 'string',
        'notification_server_key' => 'string',
        'update_title' => 'string',
        'update_message' => 'string',
        'status' => 'boolean',
        'uuid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:190',
        'version_count' => 'integer|nullable',
        'version' => 'required|string',
        'account_fk' => 'required|integer|exists:accounts,id,deleted_at,NULL',
        'package' => 'required|string',
        'notification_app_id' => 'required|string',
        'notification_server_key' => 'required|string',
        'update_title' => 'required|string',
        'update_message' => 'required|string',
        'status' => 'nullable|integer|in:0,1'
    ];

    /**
     * Label corrections for inputs.
     * @var string[]
     */
    public static $labels = [
        'account_fk' => 'account',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'account_fk', 'id');
    }

    /**
     * Application may have more than one additional specific value.
     *
     * @return mixed
     */
    public function additionalSpecificValue()
    {
        return $this->hasMany(\App\Models\AppAdditionalSpecificValue::class, 'app_fk', 'id');
    }

    /**
     * Application may have one or more Music Band.
     *
     * @return mixed
     */
    public function musicBands(){
        return $this->belongsToMany(MusicBand::class, 'music_band_application','application_id', 'musicband_id');
    }

    /**
     * Application may have one or more Musicians.
     *
     * @return mixed
     */
    public function musicians(){
        return $this->belongsToMany(Musician::class, 'musician_application','application_id', 'musician_id');
    }

    /**
     * Application may have one or more Music Album.
     *
     * @return mixed
     */
    public function musicAlbums(){
        return $this->belongsToMany(MusicAlbum::class, 'music_album_application','application_id', 'album_id');
    }

    /**
     * Application may have one or more Music Record.
     *
     * @return mixed
     */
    public function musicRecords(){
        return $this->belongsToMany(MusicRecord::class, 'music_record_application','application_id', 'record_id');
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


        static::creating(function(Application $application){
            $application->uuid = Str::uuid()->toString();
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
