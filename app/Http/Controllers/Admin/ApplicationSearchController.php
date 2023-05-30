<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\MyClasses\GeneralHelperFunctions;
use Illuminate\Http\Request;

class ApplicationSearchController extends Controller
{
    /**
     * Searches the clientele
     * @param Request $request
     * @return array
     */
    public function searchApplication(Request $request) {
        $term = $request->query('term');
        $query = Application::query();
        $totalRecordCount = $query->count();
        $query = GeneralHelperFunctions::applyPaginationToTheQuery($request, $query);
        if ($term != '') {
            $query = $query->where(function ($subQuery) use ($term) {
                $subQuery->orWhere('name', 'like', '%' . $term . '%')
                    ->orWhere('version', 'like', '%' . $term . '%');
            });
            $totalRecordCount = $query->count();
        }
        $results = [];
        foreach ($query->get() as $application) {
            $results[] = self::getResultsArr_forGeneralUse($application);
        }
        return GeneralHelperFunctions::prepareSelect2Response_forDefaultListing($results, $term, $totalRecordCount, $request, true);
    }

    /**
     * Prepares Result for search application.
     * @param Application $application
     * @param string $id
     * @return array
     */
    public static function getResultsArr_forGeneralUse(Application $application, $id = 'uuid')
    {
        if(is_null($application))  return [];
        return [
            'id' => $application->{$id},
            'name' => $application->name,
            'version' => $application->version,
            'account' => $application->account ? $application->account->name : '',
        ];
    }
}
