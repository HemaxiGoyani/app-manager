<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MusicLyricDataTable;
use App\Models\MusicLyric;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMusicLyricRequest;
use App\Http\Requests\Admin\UpdateMusicLyricRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\MusicLyricRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class MusicLyricController extends AppBaseController
{
    /** @var  MusicLyricRepository */
    private $musicLyricRepository;

    public function __construct(MusicLyricRepository $musicLyricRepo)
    {
        $this->musicLyricRepository = $musicLyricRepo;
    }

    /**
     * Display a listing of the MusicLyric.
     *
     * @param MusicLyricDataTable $musicLyricDataTable
     * @return Response
     */
    public function index(MusicLyricDataTable $musicLyricDataTable)
    {
        return $musicLyricDataTable->render('admin.music_lyrics.index');
    }

    /**
     * Show the form for creating a new MusicLyric.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.music_lyrics.create');
    }

    /**
     * Store a newly created MusicLyric in storage.
     *
     * @param CreateMusicLyricRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMusicLyricRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $musicLyric = $this->musicLyricRepository->create($input);
        DB::commit();

        return Response::json(['message' => 'MusicLyric has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($musicLyric, route('admin.musicLyrics.edit', $musicLyric))]);
    }

    /**
     * Display the specified MusicLyric.
     *
     * @param  MusicLyric $musicLyric
     *
     * @return Response
     */
    public function show(MusicLyric $musicLyric)
    {
        return view('admin.music_lyrics.show')->with('musicLyric', $musicLyric);
    }

    /**
     * Show the form for editing the specified MusicLyric.
     *
     * @param  MusicLyric $musicLyric
     *
     * @return Response
     */
    public function edit(MusicLyric $musicLyric)
    {
        return view('admin.music_lyrics.edit')->with('musicLyric', $musicLyric);
    }

    /**
     * Update the specified MusicLyric in storage.
     *
     * @param  MusicLyric $musicLyric
     * @param UpdateMusicLyricRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MusicLyric $musicLyric, UpdateMusicLyricRequest $request)
    {
        DB::beginTransaction();
        $musicLyric = $this->musicLyricRepository->update($request->all(), $musicLyric->id);
        DB::commit();

        return Response::json(['message' => 'MusicLyric updated successfully.']);
    }

    /**
     * Remove the specified MusicLyric from storage.
     *
     * @param  MusicLyric $musicLyric
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(MusicLyric $musicLyric)
    {
        $this->musicLyricRepository->delete($musicLyric->id);

        return Response::json(['message' => 'Music Lyric deleted successfully']);
    }
}
