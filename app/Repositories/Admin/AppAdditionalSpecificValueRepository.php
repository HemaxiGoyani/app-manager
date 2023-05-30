<?php

namespace App\Repositories\Admin;

use App\Models\AdditionalSpecificAttribute;
use App\Models\AppAdditionalSpecificValue;
use App\Models\Application;
use App\MyClasses\GeneralHelperFunctions;
use App\MyClasses\QueryFilters;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AppAdditionalSpecificValueRepository
 * @package App\Repositories\Admin
 * @version September 6, 2021, 4:10 pm IST
*/

class AppAdditionalSpecificValueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'app_fk',
        'attribute_fk',
        'value'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AppAdditionalSpecificValue::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request)
    {
        return [
            'app_fk' => GeneralHelperFunctions::getModelIdFromUuid(Application::query(), $request->input('app_fk')),
            'attribute_fk' => GeneralHelperFunctions::getModelIdFromUuid(AdditionalSpecificAttribute::query(), $request->input('attribute_fk')),
        ];
    }

    /**
     * Applies filters on query for the tasks
     * @param Builder $QUERY
     * @param Request $request
     * @return Builder
     */
    public static function applyFilters(Builder $QUERY, Request $request = null) {
        $request = $request ?? request();
        $QUERY = QueryFilters::applyRelationFilter($request, $QUERY, 'application', 'applications', 'uuid');
        $QUERY = QueryFilters::applyRelationFilter($request, $QUERY, 'attribute', 'attributes', 'uuid');
        return $QUERY;
    }
}
