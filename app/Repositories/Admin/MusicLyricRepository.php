<?php

namespace App\Repositories\Admin;

use App\Models\Language;
use App\Models\MusicLyric;
use App\Models\MusicRecord;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class MusicLyricRepository
 * @package App\Repositories\Admin
 * @version September 3, 2021, 12:50 pm IST
*/

class MusicLyricRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'music_fk',
        'language_fk',
        'lyrics'
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
        return MusicLyric::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request)
    {
        return [
            'music_fk' => GeneralHelperFunctions::getModelIdFromUuid(MusicRecord::query(), $request->input('music_fk')),
            'language_fk' => GeneralHelperFunctions::getModelIdFromUuid(Language::query(), $request->input('language_fk')),
        ];
    }
}
