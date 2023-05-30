<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Class AppAdditionalSpecificValue
 *
 * @package App\Models
 * @version September 6, 2021, 4:10 pm IST
 * @property \App\Models\Application $appFk
 * @property \App\Models\AdditionalSpecificAttribute $attributeFk
 * @property bigIncrements $id
 * @property integer $app_fk
 * @property integer $attribute_fk
 * @property string $value
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Application $application
 * @property-read \App\Models\AdditionalSpecificAttribute $attribute
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue newQuery()
 * @method static \Illuminate\Database\Query\Builder|AppAdditionalSpecificValue onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue whereAppFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue whereAttributeFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppAdditionalSpecificValue whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|AppAdditionalSpecificValue withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AppAdditionalSpecificValue withoutTrashed()
 * @mixin Model
 */
class AppAdditionalSpecificValue extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'app_additional_specific_values';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'app_fk',
        'attribute_fk',
        'value',
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
        'app_fk' => 'integer',
        'attribute_fk' => 'integer',
        'value' => 'string',
        'uuid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'app_fk' => 'required|integer|exists:applications,id,deleted_at,NULL',
        'attribute_fk' => 'required|integer|exists:additional_specific_attributes,id,deleted_at,NULL',
        'value' => 'required|max:190'
    ];

    /**
     * Label corrections for inputs.
     * @var string[]
     */
    public static $labels = [
        'app_fk' => 'application',
        'attribute_fk' => 'attribute'
    ];

    /**
     * Additional specific value can have one application
     * .
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function application()
    {
        return $this->belongsTo(\App\Models\Application::class, 'app_fk', 'id');
    }

    /**
     * Additional specific value can have one attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function attribute()
    {
        return $this->belongsTo(\App\Models\AdditionalSpecificAttribute::class, 'attribute_fk', 'id');
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


        static::creating(function(AppAdditionalSpecificValue $appAdditionalSpecificValue){
            $appAdditionalSpecificValue->uuid = Str::uuid()->toString();
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
     * Scopes for any particular uuid, quiet similar to findWithUuid, but it just returns the query instead of complete object.
     *
     * @param $query
     * @param $uuid
     * @return mixed
     */
    public function scopeUuid($query, $uuid) {
        return $query->whereUuid($uuid);
    }
}
