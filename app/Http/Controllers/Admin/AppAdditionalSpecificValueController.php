<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AppAdditionalSpecificValueDataTable;
use App\Models\AppAdditionalSpecificValue;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateAppAdditionalSpecificValueRequest;
use App\Http\Requests\Admin\UpdateAppAdditionalSpecificValueRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\AppAdditionalSpecificValueRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class AppAdditionalSpecificValueController extends AppBaseController
{
    /** @var  AppAdditionalSpecificValueRepository */
    private $appAdditionalSpecificValueRepository;

    public function __construct(AppAdditionalSpecificValueRepository $appAdditionalSpecificValueRepo)
    {
        $this->appAdditionalSpecificValueRepository = $appAdditionalSpecificValueRepo;
    }

    /**
     * Display a listing of the AppAdditionalSpecificValue.
     *
     * @param AppAdditionalSpecificValueDataTable $appAdditionalSpecificValueDataTable
     * @return Response
     */
    public function index(AppAdditionalSpecificValueDataTable $appAdditionalSpecificValueDataTable)
    {
        return $appAdditionalSpecificValueDataTable->render('admin.app_additional_specific_values.index');
    }

    /**
     * Show the form for creating a new AppAdditionalSpecificValue.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.app_additional_specific_values.create');
    }

    /**
     * Store a newly created AppAdditionalSpecificValue in storage.
     *
     * @param CreateAppAdditionalSpecificValueRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAppAdditionalSpecificValueRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $appAdditionalSpecificValue = $this->appAdditionalSpecificValueRepository->create($input);
        DB::commit();

        return Response::json(['message' => 'AppAdditionalSpecificValue has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($appAdditionalSpecificValue, route('admin.appAdditionalSpecificValues.edit', $appAdditionalSpecificValue))]);
    }

    /**
     * Display the specified AppAdditionalSpecificValue.
     *
     * @param  AppAdditionalSpecificValue $appAdditionalSpecificValue
     *
     * @return Response
     */
    public function show(AppAdditionalSpecificValue $appAdditionalSpecificValue)
    {
        return view('admin.app_additional_specific_values.show')->with('appAdditionalSpecificValue', $appAdditionalSpecificValue);
    }

    /**
     * Show the form for editing the specified AppAdditionalSpecificValue.
     *
     * @param  AppAdditionalSpecificValue $appAdditionalSpecificValue
     *
     * @return Response
     */
    public function edit(AppAdditionalSpecificValue $appAdditionalSpecificValue)
    {
        return view('admin.app_additional_specific_values.edit')->with('appAdditionalSpecificValue', $appAdditionalSpecificValue);
    }

    /**
     * Update the specified AppAdditionalSpecificValue in storage.
     *
     * @param  AppAdditionalSpecificValue $appAdditionalSpecificValue
     * @param UpdateAppAdditionalSpecificValueRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AppAdditionalSpecificValue $appAdditionalSpecificValue, UpdateAppAdditionalSpecificValueRequest $request)
    {
        DB::beginTransaction();
        $appAdditionalSpecificValue = $this->appAdditionalSpecificValueRepository->update($request->all(), $appAdditionalSpecificValue->id);
        DB::commit();

        return Response::json(['message' => 'AppAdditionalSpecificValue updated successfully.']);
    }

    /**
     * Remove the specified AppAdditionalSpecificValue from storage.
     *
     * @param  AppAdditionalSpecificValue $appAdditionalSpecificValue
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(AppAdditionalSpecificValue $appAdditionalSpecificValue)
    {
        $this->appAdditionalSpecificValueRepository->delete($appAdditionalSpecificValue->id);

        return Response::json(['message' => 'App Additional Specific Value deleted successfully']);
    }
}
