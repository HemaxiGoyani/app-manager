<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MusicBand;
use App\MyClasses\GeneralHelperFunctions;
use Illuminate\Http\Request;

class MusicBandSearchController extends Controller
{
    /**
     * Searches the clientele
     * @param Request $request
     * @return array
     */
    public function searchMusicBand(Request $request)
    {
        $term = $request->query('term');
        $query = MusicBand::query();
        $totalRecordCount = $query->count();
        $query = GeneralHelperFunctions::applyPaginationToTheQuery($request, $query);
        if ($term != '') {
            $query = $query->where(function ($subQuery) use ($term) {
                $subQuery->orWhere('name', 'like', '%' . $term . '%');
            });
            $totalRecordCount = $query->count();
        }
        $results = [];
        foreach ($query->get() as $musicBand) {
            $results[] = self::getResultsArr_forGeneralUse($musicBand);
        }
        return GeneralHelperFunctions::prepareSelect2Response_forDefaultListing($results, $term, $totalRecordCount, $request, true);
    }

    /**
     * Prepares Result for search application.
     * @param MusicBand $musicBand
     * @param string $id
     * @return array
     */
    public static function getResultsArr_forGeneralUse(MusicBand $musicBand, $id = 'uuid')
    {
        if(is_null($musicBand))  return [];
        return [
            'id' => $musicBand->{$id},
            'name' => $musicBand->name,
            'avatar' => $musicBand->avatar_url['100'],
        ];
    }
}
