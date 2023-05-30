<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Kalnoy\Nestedset\QueryBuilder;

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
 * @mixin Model
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSpecificAttribute uuid($uuid)
 * @property-read \Kalnoy\Nestedset\Collection|AdditionalSpecificAttribute[] $children
 * @property-read int|null $children_count
 * @property-read AdditionalSpecificAttribute|null $parent
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static QueryBuilder|AdditionalSpecificAttribute ancestorsAndSelf($id, array $columns = [])
 * @method static QueryBuilder|AdditionalSpecificAttribute ancestorsOf($id, array $columns = [])
 * @method static QueryBuilder|AdditionalSpecificAttribute applyNestedSetScope(?string $table = null)
 * @method static QueryBuilder|AdditionalSpecificAttribute countErrors()
 * @method static QueryBuilder|AdditionalSpecificAttribute d()
 * @method static QueryBuilder|AdditionalSpecificAttribute defaultOrder(string $dir = 'asc')
 * @method static QueryBuilder|AdditionalSpecificAttribute descendantsAndSelf($id, array $columns = [])
 * @method static QueryBuilder|AdditionalSpecificAttribute descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static QueryBuilder|AdditionalSpecificAttribute fixSubtree($root)
 * @method static QueryBuilder|AdditionalSpecificAttribute fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static QueryBuilder|AdditionalSpecificAttribute getNodeData($id, $required = false)
 * @method static QueryBuilder|AdditionalSpecificAttribute getPlainNodeData($id, $required = false)
 * @method static QueryBuilder|AdditionalSpecificAttribute getTotalErrors()
 * @method static QueryBuilder|AdditionalSpecificAttribute hasChildren()
 * @method static QueryBuilder|AdditionalSpecificAttribute hasParent()
 * @method static QueryBuilder|AdditionalSpecificAttribute isBroken()
 * @method static QueryBuilder|AdditionalSpecificAttribute leaves(array $columns = [])
 * @method static QueryBuilder|AdditionalSpecificAttribute makeGap(int $cut, int $height)
 * @method static QueryBuilder|AdditionalSpecificAttribute moveNode($key, $position)
 * @method static QueryBuilder|AdditionalSpecificAttribute orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static QueryBuilder|AdditionalSpecificAttribute orWhereDescendantOf($id)
 * @method static QueryBuilder|AdditionalSpecificAttribute orWhereNodeBetween($values)
 * @method static QueryBuilder|AdditionalSpecificAttribute orWhereNotDescendantOf($id)
 * @method static QueryBuilder|AdditionalSpecificAttribute rebuildSubtree($root, array $data, $delete = false)
 * @method static QueryBuilder|AdditionalSpecificAttribute rebuildTree(array $data, $delete = false, $root = null)
 * @method static QueryBuilder|AdditionalSpecificAttribute reversed()
 * @method static QueryBuilder|AdditionalSpecificAttribute root(array $columns = [])
 * @method static QueryBuilder|AdditionalSpecificAttribute whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static QueryBuilder|AdditionalSpecificAttribute whereAncestorOrSelf($id)
 * @method static QueryBuilder|AdditionalSpecificAttribute whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static QueryBuilder|AdditionalSpecificAttribute whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static QueryBuilder|AdditionalSpecificAttribute whereIsAfter($id, $boolean = 'and')
 * @method static QueryBuilder|AdditionalSpecificAttribute whereIsBefore($id, $boolean = 'and')
 * @method static QueryBuilder|AdditionalSpecificAttribute whereIsLeaf()
 * @method static QueryBuilder|AdditionalSpecificAttribute whereIsRoot()
 * @method static QueryBuilder|AdditionalSpecificAttribute whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static QueryBuilder|AdditionalSpecificAttribute whereNotDescendantOf($id)
 * @method static QueryBuilder|AdditionalSpecificAttribute withDepth(string $as = 'depth')
 * @method static QueryBuilder|AdditionalSpecificAttribute withoutRoot()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AppAdditionalSpecificValue[] $additionalSpecificValue
 * @property-read int|null $additional_specific_value_count
 */
class AdditionalSpecificAttribute extends Model
{
    use SoftDeletes, NodeTrait;

    use HasFactory;

    public $table = 'additional_specific_attributes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'name',
        'data_type',
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
        'data_type' => 'string',
        'uuid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'data_type' => 'string'
    ];

    /**
     * Attribute may have more than one additional specific value.
     *
     * @return mixed
     */
    public function additionalSpecificValue()
    {
        return $this->hasMany(\App\Models\AppAdditionalSpecificValue::class, 'attribute_fk', 'id');
    }

    /**
     * Get a new base query that includes deleted nodes.
     *
     * @since 1.1
     *
     * @return QueryBuilder
     */
    public function newNestedSetQuery($table = null)
    {
        $builder = $this->usesSoftDelete()
            ? $this->withTrashed()
            : $this->newQuery();

        return $this->applyNestedSetScope($builder, $table);
    }

    /**
     * Overriding because,
     *      When soft deleting, it creates a new query using `descendant()` method, which then auto applies the Global Task Scope
     *      and bypasses the `newNestedSetQuery()`. This then creates the the problem of
     *      "MySQL 1093 Error: Cannot update the table when target table `tasks` is in FROM clause as well"
     *      Therefore, overridden the method and adding withoutGlobalScope there.
     */
    protected function deleteDescendants()
    {
        $lft = $this->getLft();
        $rgt = $this->getRgt();

        $method = $this->usesSoftDelete() && $this->forceDeleting
            ? 'forceDelete'
            : 'delete';

        $this->descendants();

        if ($this->hardDeleting()) {
            $height = $rgt - $lft + 1;

            $this->newNestedSetQuery()->makeGap($rgt + 1, -$height);

            // In case if user wants to re-create the node
            $this->makeRoot();

            static::$actionsPerformed++;
        }
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


        static::creating(function(AdditionalSpecificAttribute $additionalSpecificAttribute){
            $additionalSpecificAttribute->uuid = Str::uuid()->toString();
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
