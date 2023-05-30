<?php

namespace App\Repositories\Admin;

use App\Models\MusicBand;
use App\Models\Musician;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class MusicianRepository
 * @package App\Repositories\Admin
 * @version August 31, 2021, 5:05 pm IST
*/

class MusicianRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'band_fk',
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
        return Musician::class;
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
            'band_fk' => GeneralHelperFunctions::getModelIdFromUuid(MusicBand::query(), $request->input('band_fk')),
            'applications' => $request->has('applications') && count($request->input('applications')) > 0 ? $request->input('applications') : [],
        ];
    }
}
