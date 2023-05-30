<?php

namespace App\Repositories\Admin;

use App\Models\Wallpaper;
use App\Models\WallpaperCategory;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class WallpaperRepository
 * @package App\Repositories\Admin
 * @version September 3, 2021, 4:05 pm IST
*/

class WallpaperRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category_fk'
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
        return Wallpaper::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request)
    {
        return [
            'category_fk' => GeneralHelperFunctions::getModelIdFromUuid(WallpaperCategory::query(), $request->input('category_fk')),
            'musicians' => $request->has('musicians') && count($request->input('musicians')) > 0 ? $request->input('musicians') : [],
            'wallpaper_tags' => $request->has('wallpaper_tags') && count($request->input('wallpaper_tags')) > 0 ? $request->input('wallpaper_tags') : [],
        ];
    }

    /**
     * @param Wallpaper $wallpaper
     * @param Request $request
     * @return bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function  updateOrCreate_avatar(Wallpaper $wallpaper, Request $request) {
        $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $wallpaper->name, 'size' => '350']);
        return GeneralHelperFunctions::updateOrCreate_singleMedia($wallpaper, $request, 'avatar', 'avatar', $defaultMedia, true);
    }
}
