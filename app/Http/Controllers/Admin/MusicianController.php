<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MusicianDataTable;
use App\Models\Application;
use App\Models\Musician;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMusicianRequest;
use App\Http\Requests\Admin\UpdateMusicianRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\MusicianRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class MusicianController extends AppBaseController
{
    /** @var  MusicianRepository */
    private $musicianRepository;

    public function __construct(MusicianRepository $musicianRepo)
    {
        $this->musicianRepository = $musicianRepo;
    }

    /**
     * Display a listing of the Musician.
     *
     * @param MusicianDataTable $musicianDataTable
     * @return Response
     */
    public function index(MusicianDataTable $musicianDataTable)
    {
        return $musicianDataTable->render('admin.musicians.index');
    }

    /**
     * Show the form for creating a new Musician.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.musicians.create');
    }

    /**
     * Store a newly created Musician in storage.
     *
     * @param CreateMusicianRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMusicianRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $musician = $this->musicianRepository->create($input);

        if($request->has('applications'))
            $musician->applications()->sync(Application::whereIn('uuid', $request->input('applications'))->get());

        DB::commit();

        return Response::json(['message' => 'Musician has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($musician, route('admin.musicians.edit', $musician))]);
    }

    /**
     * Display the specified Musician.
     *
     * @param  Musician $musician
     *
     * @return Response
     */
    public function show(Musician $musician)
    {
        return view('admin.musicians.show')->with('musician', $musician);
    }

    /**
     * Show the form for editing the specified Musician.
     *
     * @param  Musician $musician
     *
     * @return Response
     */
    public function edit(Musician $musician)
    {
        return view('admin.musicians.edit')->with('musician', $musician);
    }

    /**
     * Update the specified Musician in storage.
     *
     * @param  Musician $musician
     * @param UpdateMusicianRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Musician $musician, UpdateMusicianRequest $request)
    {
        DB::beginTransaction();
        $musician = $this->musicianRepository->update($request->all(), $musician->id);

        if($request->has('applications'))
            $musician->applications()->sync(Application::whereIn('uuid', $request->input('applications'))->get());
        DB::commit();

        return Response::json(['message' => 'Musician updated successfully.']);
    }

    /**
     * Remove the specified Musician from storage.
     *
     * @param  Musician $musician
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Musician $musician)
    {
        $this->musicianRepository->delete($musician->id);

        return Response::json(['message' => 'Musician deleted successfully']);
    }
}
