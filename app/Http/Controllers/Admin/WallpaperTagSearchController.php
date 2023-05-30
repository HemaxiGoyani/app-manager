<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WallpaperTag;
use App\MyClasses\GeneralHelperFunctions;
use Illuminate\Http\Request;

class WallpaperTagSearchController extends Controller
{
    /**
     * Searches the musician
     * @param Request $request
     * @return array
     */
    public function searchWallPaperTag(Request $request)
    {
        $term = $request->query('term');
        $query = WallpaperTag::query();
        $totalRecordCount = $query->count();
        $query = GeneralHelperFunctions::applyPaginationToTheQuery($request, $query);
        if ($term != '') {
            $query = $query->where(function ($subQuery) use ($term) {
                $subQuery->orWhere('name', 'like', '%' . $term . '%');
            });
            $totalRecordCount = $query->count();
        }
        $results = [];
        foreach ($query->get() as $wallpaperTag) {
            $results[] = self::getResultsArr_forGeneralUse($wallpaperTag);
        }
        return GeneralHelperFunctions::prepareSelect2Response_forDefaultListing($results, $term, $totalRecordCount, $request, true);
    }

    /**
     * Prepares Result for search musician.
     * @param WallpaperTag $wallpaperTag
     * @param string $id
     * @return array
     */
    public static function getResultsArr_forGeneralUse(WallpaperTag $wallpaperTag, $id = 'uuid')
    {
        if(is_null($wallpaperTag))  return [];
        return [
            'id' => $wallpaperTag->{$id},
            'name' => $wallpaperTag->name,
            'updated_at' => $wallpaperTag->last_updated_at
        ];
    }
}
