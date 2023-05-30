<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdditionalSpecificAttribute;
use App\MyClasses\GeneralHelperFunctions;
use Illuminate\Http\Request;

class AttributeSearchController extends Controller
{
    /**
     * Searches the attributes
     * @param Request $request
     * @return array
     */
    public function search(Request $request) {
        $term = $request->query('term');
        $query = AdditionalSpecificAttribute::query();
        $totalRecordCount = $query->count();
        $query = GeneralHelperFunctions::applyPaginationToTheQuery($request, $query);
        if ($term != '') {
            $query = $query->where(function ($subQuery) use ($term) {
                $subQuery->orWhere('name', 'like', '%' . $term . '%');
            });
            $totalRecordCount = $query->count();
        }
        if($request->has('except')){
            $query = $query->where('uuid', '<>', $request->input('except'));
        }
        $results = [];
        foreach ($query->get() as $task) {
            $results[] = self::getResultsArr_forGeneralUse($task);
        }
        return GeneralHelperFunctions::prepareSelect2Response_forDefaultListing($results, $term, $totalRecordCount, $request, true);
    }

    /**
     * Prepares Result for search attribute.
     * @param AdditionalSpecificAttribute $additionalSpecificAttribute
     * @param string $id
     * @return array
     */
    public static function getResultsArr_forGeneralUse(AdditionalSpecificAttribute $additionalSpecificAttribute, $id = 'uuid')
    {
        if(is_null($additionalSpecificAttribute))  return [];
        return [
            'id' => $additionalSpecificAttribute->{$id},
            'name' => $additionalSpecificAttribute->name,
        ];
    }
}
