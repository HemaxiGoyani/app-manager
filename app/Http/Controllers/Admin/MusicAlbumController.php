<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MusicAlbumDataTable;
use App\Models\Application;
use App\Models\MusicAlbum;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMusicAlbumRequest;
use App\Http\Requests\Admin\UpdateMusicAlbumRequest;
use App\Models\MusicBand;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\MusicAlbumRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class MusicAlbumController extends AppBaseController
{
    /** @var  MusicAlbumRepository */
    private $musicAlbumRepository;

    public function __construct(MusicAlbumRepository $musicAlbumRepo)
    {
        $this->musicAlbumRepository = $musicAlbumRepo;
    }

    /**
     * Display a listing of the MusicAlbum.
     *
     * @param MusicAlbumDataTable $musicAlbumDataTable
     * @return Response
     */
    public function index(MusicAlbumDataTable $musicAlbumDataTable)
    {
        return $musicAlbumDataTable->render('admin.music_albums.index');
    }

    /**
     * Show the form for creating a new MusicAlbum.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.music_albums.create');
    }

    /**
     * Store a newly created MusicAlbum in storage.
     *
     * @param CreateMusicAlbumRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMusicAlbumRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $musicAlbum = $this->musicAlbumRepository->create($input);

        if($request->has('applications'))
            $musicAlbum->applications()->sync(Application::whereIn('uuid', $request->input('applications'))->get());

        if($request->has('music_bands'))
            $musicAlbum->musicBands()->sync(MusicBand::whereIn('uuid', $request->input('music_bands'))->get());

        $this->musicAlbumRepository->updateOrCreate_avatar($musicAlbum, $request);
        DB::commit();

        return Response::json(['message' => 'MusicAlbum has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($musicAlbum, route('admin.musicAlbums.edit', $musicAlbum))]);
    }

    /**
     * Display the specified MusicAlbum.
     *
     * @param  MusicAlbum $musicAlbum
     *
     * @return Response
     */
    public function show(MusicAlbum $musicAlbum)
    {
        return view('admin.music_albums.show')->with('musicAlbum', $musicAlbum);
    }

    /**
     * Show the form for editing the specified MusicAlbum.
     *
     * @param  MusicAlbum $musicAlbum
     *
     * @return Response
     */
    public function edit(MusicAlbum $musicAlbum)
    {
        return view('admin.music_albums.edit')->with('musicAlbum', $musicAlbum);
    }

    /**
     * Update the specified MusicAlbum in storage.
     *
     * @param  MusicAlbum $musicAlbum
     * @param UpdateMusicAlbumRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MusicAlbum $musicAlbum, UpdateMusicAlbumRequest $request)
    {
        DB::beginTransaction();
        $musicAlbum = $this->musicAlbumRepository->update($request->all(), $musicAlbum->id);

        if($request->has('applications'))
            $musicAlbum->applications()->sync(Application::whereIn('uuid', $request->input('applications'))->get());

        if($request->has('music_bands'))
            $musicAlbum->musicBands()->sync(MusicBand::whereIn('uuid', $request->input('music_bands'))->get());
        DB::commit();

        return Response::json(['message' => 'MusicAlbum updated successfully.']);
    }

    /**
     * Remove the specified MusicAlbum from storage.
     *
     * @param  MusicAlbum $musicAlbum
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(MusicAlbum $musicAlbum)
    {
        $this->musicAlbumRepository->delete($musicAlbum->id);

        return Response::json(['message' => 'Music Album deleted successfully']);
    }
}
