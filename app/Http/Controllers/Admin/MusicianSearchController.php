<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Musician;
use App\MyClasses\GeneralHelperFunctions;
use Illuminate\Http\Request;

class MusicianSearchController extends Controller
{
    /**
     * Searches the musician
     * @param Request $request
     * @return array
     */
    public function searchMusician(Request $request)
    {
        $term = $request->query('term');
        $query = Musician::query();
        $totalRecordCount = $query->count();
        $query = GeneralHelperFunctions::applyPaginationToTheQuery($request, $query);
        if ($term != '') {
            $query = $query->where(function ($subQuery) use ($term) {
                $subQuery->orWhere('name', 'like', '%' . $term . '%');
            });
            $totalRecordCount = $query->count();
        }
        $results = [];
        foreach ($query->get() as $musician) {
            $results[] = self::getResultsArr_forGeneralUse($musician);
        }
        return GeneralHelperFunctions::prepareSelect2Response_forDefaultListing($results, $term, $totalRecordCount, $request, true);
    }

    /**
     * Prepares Result for search musician.
     * @param Musician $musician
     * @param string $id
     * @return array
     */
    public static function getResultsArr_forGeneralUse(Musician $musician, $id = 'uuid')
    {
        if(is_null($musician))  return [];
        return [
            'id' => $musician->{$id},
            'name' => $musician->name,
            'band' => $musician->musicBand ? $musician->musicBand ->name : ''
        ];
    }
}
