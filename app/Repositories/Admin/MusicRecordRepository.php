<?php

namespace App\Repositories\Admin;

use App\Models\MusicRecord;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class MusicRecordRepository
 * @package App\Repositories\Admin
 * @version September 2, 2021, 4:55 pm IST
*/

class MusicRecordRepository extends BaseRepository
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
        return MusicRecord::class;
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
            'music_bands' => $request->has('music_bands') && count($request->input('music_bands')) > 0 ? $request->input('music_bands') : [],
            'music_albums' => $request->has('music_albums') && count($request->input('music_albums')) > 0 ? $request->input('music_albums') : [],
        ];
    }

    /**
     * Updates or creates the music recording for the music record.
     * @param MusicRecord $musicRecord
     * @param Request $request
     * @return bool|\Spatie\MediaLibrary\Models\Media
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function updateOrCreate_doc(MusicRecord $musicRecord, Request $request) {
        if($request->hasFile('music')) {
            //Collection 'music' being singleFile, any new file will replace the old one here.
            return $musicRecord->addMedia($request->music)
                ->toMediaCollection('musics');
        }

        if($request->has('musicDeleted') && (int)$request->input('musicDeleted')){
            $musicRecord->clearMediaCollection('musics');
        }

        return true;
    }
}
