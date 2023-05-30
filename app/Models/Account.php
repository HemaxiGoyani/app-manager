<?php

namespace App\Models;

use App\MyClasses\GeneralHelperFunctions;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Class Account
 * @package App\Models
 * @version August 30, 2021, 7:43 am UTC
 *
 * @property bigIncrements $id
 * @property string $name
 * @property string $privacy_policy_url
 * @property string $play_console_url
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class Account extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'accounts';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'name',
        'privacy_policy_url',
        'play_console_url',
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
        'privacy_policy_url' => 'string',
        'play_console_url' => 'string',
        'uuid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:190',
        'privacy_policy_url' => 'url|string',
        'play_console_url' => 'url|string'
    ];

    /**
     * @return mixed
     */
    public function Application()
    {
        return $this->hasMany(\App\Models\Application::class, 'account_fk', 'id')->withTrashed();
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


        static::creating(function(Account $account){
            $account->uuid = Str::uuid()->toString();
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
