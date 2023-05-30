<?php

namespace App\Repositories\Admin;

use App\Models\WallpaperCategory;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class WallpaperCategoryRepository
 * @package App\Repositories\Admin
 * @version September 3, 2021, 3:03 pm IST
*/

class WallpaperCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'order'
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
        return WallpaperCategory::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request)
    {
        return [
            'order' => $request->input('order') ?? 0,
            'musicians' => $request->has('musicians') && count($request->input('musicians')) > 0 ? $request->input('musicians') : [],
        ];
    }
}
