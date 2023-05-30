<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class AdditionalSpecificAttribute
 *
 * @package App\Models
 * @version September 6, 2021, 12:38 pm IST
 * @property bigIncrements $id
 * @property string $name
 * @property string $data_type
 * @property string $uuid
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute findWithUuid($uuid, $with = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute newQuery()
 * @method static \Illuminate\Database\Query\Builder|AdditionalSpecificAttribute onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereDataType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|AdditionalSpecificAttribute withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AdditionalSpecificAttribute withoutTrashed()
 */
	class AdditionalSpecificAttribute extends \Eloquent {}
}

