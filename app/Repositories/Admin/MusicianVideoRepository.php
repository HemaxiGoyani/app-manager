<?php

namespace App\Repositories\Admin;

use App\Models\Musician;
use App\Models\MusicianVideo;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class MusicianVideoRepository
 * @package App\Repositories\Admin
 * @version September 1, 2021, 11:50 am IST
*/

class MusicianVideoRepository extends BaseRepository
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
        return MusicianVideo::class;
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
     * @param MusicianVideo $musicianVideo
     * @param Request $request
     * @return bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function updateOrCreate_avatar(MusicianVideo $musicianVideo, Request $request) {
        $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $musicianVideo->name, 'size' => '350']);
        return GeneralHelperFunctions::updateOrCreate_singleMedia($musicianVideo, $request, 'avatar', 'avatar', $defaultMedia, true);
    }
}
