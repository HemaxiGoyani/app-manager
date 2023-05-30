<?php

namespace App\Repositories\Admin;

use App\Models\Musician;
use App\Models\MusicianProfilePicture;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class MusicianProfilePictureRepository
 * @package App\Repositories\Admin
 * @version September 1, 2021, 8:56 am IST
*/

class MusicianProfilePictureRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'musician_fk',
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
        return MusicianProfilePicture::class;
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
            'musician_fk' => GeneralHelperFunctions::getModelIdFromUuid(Musician::query(), $request->input('musician_fk')),
        ];
    }

    /**
     * @param MusicianProfilePicture $musicianProfilePicture
     * @param Request $request
     * @return bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function updateOrCreate_avatar(MusicianProfilePicture $musicianProfilePicture, Request $request) {
        $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $musicianProfilePicture->name, 'size' => '350']);
        return GeneralHelperFunctions::updateOrCreate_singleMedia($musicianProfilePicture, $request, 'avatar', 'avatar', $defaultMedia, true);
    }
}
