<?php

namespace App\Repositories\Admin;

use App\Models\MusicAlbum;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class MusicAlbumRepository
 * @package App\Repositories\Admin
 * @version September 2, 2021, 2:00 pm IST
*/

class MusicAlbumRepository extends BaseRepository
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
        return MusicAlbum::class;
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

    /**
     * @param MusicAlbum $musicAlbum
     * @param Request $request
     * @return bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function  updateOrCreate_avatar(MusicAlbum $musicAlbum, Request $request) {
        $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $musicAlbum->name, 'size' => '350']);
        return GeneralHelperFunctions::updateOrCreate_singleMedia($musicAlbum, $request, 'avatar', 'avatar', $defaultMedia, true);
    }
}
