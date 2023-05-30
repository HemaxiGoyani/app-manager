<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MusicRecordDataTable;
use App\Models\Application;
use App\Models\MusicAlbum;
use App\Models\MusicBand;
use App\Models\MusicRecord;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMusicRecordRequest;
use App\Http\Requests\Admin\UpdateMusicRecordRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\MusicRecordRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class MusicRecordController extends AppBaseController
{
    /** @var  MusicRecordRepository */
    private $musicRecordRepository;

    public function __construct(MusicRecordRepository $musicRecordRepo)
    {
        $this->musicRecordRepository = $musicRecordRepo;
    }

    /**
     * Display a listing of the MusicRecord.
     *
     * @param MusicRecordDataTable $musicRecordDataTable
     * @return Response
     */
    public function index(MusicRecordDataTable $musicRecordDataTable)
    {
        return $musicRecordDataTable->render('admin.music_records.index');
    }

    /**
     * Show the form for creating a new MusicRecord.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.music_records.create');
    }

    /**
     * Store a newly created MusicRecord in storage.
     *
     * @param CreateMusicRecordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMusicRecordRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $musicRecord = $this->musicRecordRepository->create($input);

        if($request->has('applications'))
            $musicRecord->applications()->sync(Application::whereIn('uuid', $request->input('applications'))->get());

        if($request->has('music_bands'))
            $musicRecord->musicBands()->sync(MusicBand::whereIn('uuid', $request->input('music_bands'))->get());

        if($request->has('music_albums'))
            $musicRecord->musicAlbums()->sync(MusicAlbum::whereIn('uuid', $request->input('music_albums'))->get());


        $this->musicRecordRepository->updateOrCreate_doc($musicRecord, $request);
        DB::commit();

        return Response::json(['message' => 'MusicRecord has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($musicRecord, route('admin.musicRecords.edit', $musicRecord))]);
    }

    /**
     * Display the specified MusicRecord.
     *
     * @param  MusicRecord $musicRecord
     *
     * @return Response
     */
    public function show(MusicRecord $musicRecord)
    {
        return view('admin.music_records.show')->with('musicRecord', $musicRecord);
    }

    /**
     * Show the form for editing the specified MusicRecord.
     *
     * @param  MusicRecord $musicRecord
     *
     * @return Response
     */
    public function edit(MusicRecord $musicRecord)
    {
        return view('admin.music_records.edit')->with('musicRecord', $musicRecord);
    }

    /**
     * Update the specified MusicRecord in storage.
     *
     * @param  MusicRecord $musicRecord
     * @param UpdateMusicRecordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MusicRecord $musicRecord, UpdateMusicRecordRequest $request)
    {
        DB::beginTransaction();
        $musicRecord = $this->musicRecordRepository->update($request->all(), $musicRecord->id);

        if($request->has('applications'))
            $musicRecord->applications()->sync(Application::whereIn('uuid', $request->input('applications'))->get());

        if($request->has('music_bands'))
            $musicRecord->musicBands()->sync(MusicBand::whereIn('uuid', $request->input('music_bands'))->get());

        if($request->has('music_albums'))
            $musicRecord->musicAlbums()->sync(MusicAlbum::whereIn('uuid', $request->input('music_albums'))->get());

        DB::commit();

        return Response::json(['message' => 'MusicRecord updated successfully.']);
    }

    /**
     * Remove the specified MusicRecord from storage.
     *
     * @param  MusicRecord $musicRecord
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(MusicRecord $musicRecord)
    {
        $this->musicRecordRepository->delete($musicRecord->id);

        return Response::json(['message' => 'Music Record deleted successfully']);
    }


}
