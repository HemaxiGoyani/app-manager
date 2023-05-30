<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdditionalSpecificAttributeDataTable;
use App\Models\AdditionalSpecificAttribute;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateAdditionalSpecificAttributeRequest;
use App\Http\Requests\Admin\UpdateAdditionalSpecificAttributeRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\AdditionalSpecificAttributeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class AdditionalSpecificAttributeController extends AppBaseController
{
    /** @var  AdditionalSpecificAttributeRepository */
    private $additionalSpecificAttributeRepository;

    public function __construct(AdditionalSpecificAttributeRepository $additionalSpecificAttributeRepo)
    {
        $this->additionalSpecificAttributeRepository = $additionalSpecificAttributeRepo;
    }

    /**
     * Display a listing of the AdditionalSpecificAttribute.
     *
     * @param AdditionalSpecificAttributeDataTable $additionalSpecificAttributeDataTable
     * @return Response
     */
    public function index(AdditionalSpecificAttributeDataTable $additionalSpecificAttributeDataTable)
    {
        return $additionalSpecificAttributeDataTable->render('admin.additional_specific_attributes.index');
    }

    /**
     * Show the form for creating a new AdditionalSpecificAttribute.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.additional_specific_attributes.create');
    }

    /**
     * Store a newly created AdditionalSpecificAttribute in storage.
     *
     * @param CreateAdditionalSpecificAttributeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAdditionalSpecificAttributeRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $additionalSpecificAttribute = $this->additionalSpecificAttributeRepository->create($input);

        if ($request->has('parent_attribute'))
            $additionalSpecificAttribute->appendToNode(AdditionalSpecificAttribute::uuid($request->input('parent_attribute'))->first())->save();
        DB::commit();

        return Response::json(['message' => 'AdditionalSpecificAttribute has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($additionalSpecificAttribute, route('admin.additionalSpecificAttributes.edit', $additionalSpecificAttribute))]);
    }

    /**
     * Display the specified AdditionalSpecificAttribute.
     *
     * @param  AdditionalSpecificAttribute $additionalSpecificAttribute
     *
     * @return Response
     */
    public function show(AdditionalSpecificAttribute $additionalSpecificAttribute)
    {
        return view('admin.additional_specific_attributes.show')->with('additionalSpecificAttribute', $additionalSpecificAttribute);
    }

    /**
     * Show the form for editing the specified AdditionalSpecificAttribute.
     *
     * @param  AdditionalSpecificAttribute $additionalSpecificAttribute
     *
     * @return Response
     */
    public function edit(AdditionalSpecificAttribute $additionalSpecificAttribute)
    {
        return view('admin.additional_specific_attributes.edit')->with('additionalSpecificAttribute', $additionalSpecificAttribute);
    }

    /**
     * Update the specified AdditionalSpecificAttribute in storage.
     *
     * @param  AdditionalSpecificAttribute $additionalSpecificAttribute
     * @param UpdateAdditionalSpecificAttributeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AdditionalSpecificAttribute $additionalSpecificAttribute, UpdateAdditionalSpecificAttributeRequest $request)
    {
        DB::beginTransaction();
        $additionalSpecificAttribute = $this->additionalSpecificAttributeRepository->update($request->all(), $additionalSpecificAttribute->id);
        DB::commit();

        return Response::json(['message' => 'AdditionalSpecificAttribute updated successfully.']);
    }

    /**
     * Remove the specified AdditionalSpecificAttribute from storage.
     *
     * @param  AdditionalSpecificAttribute $additionalSpecificAttribute
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(AdditionalSpecificAttribute $additionalSpecificAttribute)
    {
        $this->additionalSpecificAttributeRepository->delete($additionalSpecificAttribute->id);

        return Response::json(['message' => 'Additional Specific Attribute deleted successfully']);
    }
}
