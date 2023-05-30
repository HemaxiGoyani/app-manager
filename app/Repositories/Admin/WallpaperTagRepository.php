<?php

namespace App\Repositories\Admin;

use App\Models\WallpaperTag;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class WallpaperTagRepository
 * @package App\Repositories\Admin
 * @version September 3, 2021, 3:55 pm IST
*/

class WallpaperTagRepository extends BaseRepository
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
        return WallpaperTag::class;
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
        ];
    }
}
