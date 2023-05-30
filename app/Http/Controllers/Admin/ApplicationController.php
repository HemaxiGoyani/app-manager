<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ApplicationDataTable;
use App\Models\Application;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateApplicationRequest;
use App\Http\Requests\Admin\UpdateApplicationRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\ApplicationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class ApplicationController extends AppBaseController
{
    /** @var  ApplicationRepository */
    private $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepo)
    {
        $this->applicationRepository = $applicationRepo;
    }

    /**
     * Display a listing of the Application.
     *
     * @param ApplicationDataTable $applicationDataTable
     * @return Response
     */
    public function index(ApplicationDataTable $applicationDataTable)
    {
        return $applicationDataTable->render('admin.applications.index');
    }

    /**
     * Show the form for creating a new Application.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.applications.create');
    }

    /**
     * Store a newly created Application in storage.
     *
     * @param CreateApplicationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateApplicationRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $application = $this->applicationRepository->create($input);
        DB::commit();

        return Response::json(['message' => 'Application has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($application, route('admin.applications.edit', $application))]);
    }

    /**
     * Display the specified Application.
     *
     * @param  Application $application
     *
     * @return Response
     */
    public function show(Application $application)
    {
        return view('admin.applications.show')->with('application', $application);
    }

    /**
     * Show the form for editing the specified Application.
     *
     * @param  Application $application
     *
     * @return Response
     */
    public function edit(Application $application)
    {
        return view('admin.applications.edit')->with('application', $application);
    }

    /**
     * Update the specified Application in storage.
     *
     * @param  Application $application
     * @param UpdateApplicationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Application $application, UpdateApplicationRequest $request)
    {
        DB::beginTransaction();
        $application = $this->applicationRepository->update($request->all(), $application->id);
        DB::commit();

        return Response::json(['message' => 'Application updated successfully.']);
    }

    /**
     * Remove the specified Application from storage.
     *
     * @param  Application $application
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Application $application)
    {
        $this->applicationRepository->delete($application->id);

        return Response::json(['message' => 'Application deleted successfully']);
    }

    /**
     * toggle visibility of artist
     * @param Application $application
     * @return \Illuminate\Http\JsonResponse
     */
    public function visibilityToggler(Application $application)
    {
        $application->status = $application->status ? false : true;
        $application->save();
        $application->refresh();
        return Response::json([
            'success' => 1,
            'class' => $application->status ? 'badge badge-success' : 'badge badge-danger',
            'html' => $application->status ? 'YES' : 'NO',
            'msg' => $application->status ? 'Application is activated' : 'Artist is Deactivated' . "!",
        ],200);
    }
}
