<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MusicianVideoDataTable;
use App\Models\MusicianVideo;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMusicianVideoRequest;
use App\Http\Requests\Admin\UpdateMusicianVideoRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\MusicianVideoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class MusicianVideoController extends AppBaseController
{
    /** @var  MusicianVideoRepository */
    private $musicianVideoRepository;

    public function __construct(MusicianVideoRepository $musicianVideoRepo)
    {
        $this->musicianVideoRepository = $musicianVideoRepo;
    }

    /**
     * Display a listing of the MusicianVideo.
     *
     * @param MusicianVideoDataTable $musicianVideoDataTable
     * @return Response
     */
    public function index(MusicianVideoDataTable $musicianVideoDataTable)
    {
        return $musicianVideoDataTable->render('admin.musician_videos.index');
    }

    /**
     * Show the form for creating a new MusicianVideo.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.musician_videos.create');
    }

    /**
     * Store a newly created MusicianVideo in storage.
     *
     * @param CreateMusicianVideoRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMusicianVideoRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $musicianVideo = $this->musicianVideoRepository->create($input);

        $this->musicianVideoRepository->updateOrCreate_avatar($musicianVideo, $request);
        DB::commit();

        return Response::json(['message' => 'MusicianVideo has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($musicianVideo, route('admin.musicianVideos.edit', $musicianVideo))]);
    }

    /**
     * Display the specified MusicianVideo.
     *
     * @param  MusicianVideo $musicianVideo
     *
     * @return Response
     */
    public function show(MusicianVideo $musicianVideo)
    {
        return view('admin.musician_videos.show')->with('musicianVideo', $musicianVideo);
    }

    /**
     * Show the form for editing the specified MusicianVideo.
     *
     * @param  MusicianVideo $musicianVideo
     *
     * @return Response
     */
    public function edit(MusicianVideo $musicianVideo)
    {
        return view('admin.musician_videos.edit')->with('musicianVideo', $musicianVideo);
    }

    /**
     * Update the specified MusicianVideo in storage.
     *
     * @param  MusicianVideo $musicianVideo
     * @param UpdateMusicianVideoRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MusicianVideo $musicianVideo, UpdateMusicianVideoRequest $request)
    {
        DB::beginTransaction();
        $musicianVideo = $this->musicianVideoRepository->update($request->all(), $musicianVideo->id);
        DB::commit();

        return Response::json(['message' => 'MusicianVideo updated successfully.']);
    }

    /**
     * Remove the specified MusicianVideo from storage.
     *
     * @param  MusicianVideo $musicianVideo
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(MusicianVideo $musicianVideo)
    {
        $this->musicianVideoRepository->delete($musicianVideo->id);

        return Response::json(['message' => 'Musician Video deleted successfully']);
    }
}
