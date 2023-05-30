<?php

namespace App\Repositories\Admin;

use App\Models\MusicBand;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class MusicBandRepository
 * @package App\Repositories\Admin
 * @version August 30, 2021, 9:39 am UTC
*/

class MusicBandRepository extends BaseRepository
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
        return MusicBand::class;
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
            'applications' => $request->has('applications') && count($request->input('applications')) > 0 ? $request->input('applications') : [],
        ];
    }

    /**
     * @param MusicBand $musicBand
     * @param Request $request
     * @return bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function updateOrCreate_avatar(MusicBand $musicBand, Request $request) {
        $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $musicBand->name, 'size' => '350']);
        return GeneralHelperFunctions::updateOrCreate_singleMedia($musicBand, $request, 'avatar', 'avatar', $defaultMedia, true);
    }
}
