<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MusicBandDataTable;
use App\Models\Application;
use App\Models\MusicBand;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMusicBandRequest;
use App\Http\Requests\Admin\UpdateMusicBandRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\MusicBandRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class MusicBandController extends AppBaseController
{
    /** @var  MusicBandRepository */
    private $musicBandRepository;

    public function __construct(MusicBandRepository $musicBandRepo)
    {
        $this->musicBandRepository = $musicBandRepo;
    }

    /**
     * Display a listing of the MusicBand.
     *
     * @param MusicBandDataTable $musicBandDataTable
     * @return Response
     */
    public function index(MusicBandDataTable $musicBandDataTable)
    {
        return $musicBandDataTable->render('admin.music_bands.index');
    }

    /**
     * Show the form for creating a new MusicBand.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.music_bands.create');
    }

    /**
     * Store a newly created MusicBand in storage.
     *
     * @param CreateMusicBandRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMusicBandRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();

        $musicBand = $this->musicBandRepository->create($input);

        if($request->has('applications'))
            $musicBand->applications()->sync(Application::whereIn('uuid', $request->input('applications'))->get());

        $this->musicBandRepository->updateOrCreate_avatar($musicBand, $request);

        DB::commit();

        return Response::json(['message' => 'MusicBand has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($musicBand, route('admin.musicBands.edit', $musicBand))]);
    }

    /**
     * Display the specified MusicBand.
     *
     * @param  MusicBand $musicBand
     *
     * @return Response
     */
    public function show(MusicBand $musicBand)
    {
        return view('admin.music_bands.show')->with('musicBand', $musicBand);
    }

    /**
     * Show the form for editing the specified MusicBand.
     *
     * @param  MusicBand $musicBand
     *
     * @return Response
     */
    public function edit(MusicBand $musicBand)
    {
        return view('admin.music_bands.edit')->with('musicBand', $musicBand);
    }

    /**
     * Update the specified MusicBand in storage.
     *
     * @param  MusicBand $musicBand
     * @param UpdateMusicBandRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MusicBand $musicBand, UpdateMusicBandRequest $request)
    {
        DB::beginTransaction();

        $musicBand = $this->musicBandRepository->update($request->all(), $musicBand->id);

        if($request->has('applications'))
            $musicBand->applications()->sync(Application::whereIn('uuid', $request->input('applications'))->get());

        DB::commit();

        return Response::json(['message' => 'MusicBand updated successfully.']);
    }

    /**
     * Remove the specified MusicBand from storage.
     *
     * @param  MusicBand $musicBand
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(MusicBand $musicBand)
    {
        $this->musicBandRepository->delete($musicBand->id);

        return Response::json(['message' => 'Music Band deleted successfully']);
    }
}
