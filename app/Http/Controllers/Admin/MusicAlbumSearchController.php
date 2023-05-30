<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MusicAlbum;
use App\MyClasses\GeneralHelperFunctions;
use Illuminate\Http\Request;

class MusicAlbumSearchController extends Controller
{
    /**
     * Searches the clientele
     * @param Request $request
     * @return array
     */
    public function searchMusicAlbum(Request $request)
    {
        $term = $request->query('term');
        $query = MusicAlbum::query();
        $totalRecordCount = $query->count();
        $query = GeneralHelperFunctions::applyPaginationToTheQuery($request, $query);
        if ($term != '') {
            $query = $query->where(function ($subQuery) use ($term) {
                $subQuery->orWhere('name', 'like', '%' . $term . '%');
            });
            $totalRecordCount = $query->count();
        }
        $results = [];
        foreach ($query->get() as $musicAlbum) {
            $results[] = self::getResultsArr_forGeneralUse($musicAlbum);
        }
        return GeneralHelperFunctions::prepareSelect2Response_forDefaultListing($results, $term, $totalRecordCount, $request, true);
    }

    /**
     * Prepares Result for search application.
     * @param MusicAlbum $musicAlbum
     * @param string $id
     * @return array
     */
    public static function getResultsArr_forGeneralUse(MusicAlbum $musicAlbum, $id = 'uuid')
    {
        if(is_null($musicAlbum))  return [];
        return [
            'id' => $musicAlbum->{$id},
            'name' => $musicAlbum->name,
            'avatar' => $musicAlbum->avatar_url['100'],
        ];
    }
}
