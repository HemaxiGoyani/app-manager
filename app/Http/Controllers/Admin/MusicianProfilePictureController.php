<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MusicianProfilePictureDataTable;
use App\Models\MusicianProfilePicture;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMusicianProfilePictureRequest;
use App\Http\Requests\Admin\UpdateMusicianProfilePictureRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\MusicianProfilePictureRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class MusicianProfilePictureController extends AppBaseController
{
    /** @var  MusicianProfilePictureRepository */
    private $musicianProfilePictureRepository;

    public function __construct(MusicianProfilePictureRepository $musicianProfilePictureRepo)
    {
        $this->musicianProfilePictureRepository = $musicianProfilePictureRepo;
    }

    /**
     * Display a listing of the MusicianProfilePicture.
     *
     * @param MusicianProfilePictureDataTable $musicianProfilePictureDataTable
     * @return Response
     */
    public function index(MusicianProfilePictureDataTable $musicianProfilePictureDataTable)
    {
        return $musicianProfilePictureDataTable->render('admin.musician_profile_pictures.index');
    }

    /**
     * Show the form for creating a new MusicianProfilePicture.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.musician_profile_pictures.create');
    }

    /**
     * Store a newly created MusicianProfilePicture in storage.
     *
     * @param CreateMusicianProfilePictureRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMusicianProfilePictureRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $musicianProfilePicture = $this->musicianProfilePictureRepository->create($input);

        $this->musicianProfilePictureRepository->updateOrCreate_avatar($musicianProfilePicture, $request);
        DB::commit();

        return Response::json(['message' => 'MusicianProfilePicture has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($musicianProfilePicture, route('admin.musicianProfilePictures.edit', $musicianProfilePicture))]);
    }

    /**
     * Display the specified MusicianProfilePicture.
     *
     * @param  MusicianProfilePicture $musicianProfilePicture
     *
     * @return Response
     */
    public function show(MusicianProfilePicture $musicianProfilePicture)
    {
        return view('admin.musician_profile_pictures.show')->with('musicianProfilePicture', $musicianProfilePicture);
    }

    /**
     * Show the form for editing the specified MusicianProfilePicture.
     *
     * @param  MusicianProfilePicture $musicianProfilePicture
     *
     * @return Response
     */
    public function edit(MusicianProfilePicture $musicianProfilePicture)
    {
        return view('admin.musician_profile_pictures.edit')->with('musicianProfilePicture', $musicianProfilePicture);
    }

    /**
     * Update the specified MusicianProfilePicture in storage.
     *
     * @param  MusicianProfilePicture $musicianProfilePicture
     * @param UpdateMusicianProfilePictureRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MusicianProfilePicture $musicianProfilePicture, UpdateMusicianProfilePictureRequest $request)
    {
        DB::beginTransaction();
        $musicianProfilePicture = $this->musicianProfilePictureRepository->update($request->all(), $musicianProfilePicture->id);
        DB::commit();

        return Response::json(['message' => 'MusicianProfilePicture updated successfully.']);
    }

    /**
     * Remove the specified MusicianProfilePicture from storage.
     *
     * @param  MusicianProfilePicture $musicianProfilePicture
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(MusicianProfilePicture $musicianProfilePicture)
    {
        $this->musicianProfilePictureRepository->delete($musicianProfilePicture->id);

        return Response::json(['message' => 'Musician Profile Picture deleted successfully']);
    }
}
