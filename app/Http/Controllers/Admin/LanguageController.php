<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\LanguageDataTable;
use App\Models\Language;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateLanguageRequest;
use App\Http\Requests\Admin\UpdateLanguageRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\LanguageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class LanguageController extends AppBaseController
{
    /** @var  LanguageRepository */
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepo)
    {
        $this->languageRepository = $languageRepo;
    }

    /**
     * Display a listing of the Language.
     *
     * @param LanguageDataTable $languageDataTable
     * @return Response
     */
    public function index(LanguageDataTable $languageDataTable)
    {
        return $languageDataTable->render('admin.languages.index');
    }

    /**
     * Show the form for creating a new Language.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created Language in storage.
     *
     * @param CreateLanguageRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateLanguageRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $language = $this->languageRepository->create($input);
        DB::commit();

        return Response::json(['message' => 'Language has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($language, route('admin.languages.edit', $language))]);
    }

    /**
     * Display the specified Language.
     *
     * @param  Language $language
     *
     * @return Response
     */
    public function show(Language $language)
    {
        return view('admin.languages.show')->with('language', $language);
    }

    /**
     * Show the form for editing the specified Language.
     *
     * @param  Language $language
     *
     * @return Response
     */
    public function edit(Language $language)
    {
        return view('admin.languages.edit')->with('language', $language);
    }

    /**
     * Update the specified Language in storage.
     *
     * @param  Language $language
     * @param UpdateLanguageRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Language $language, UpdateLanguageRequest $request)
    {
        DB::beginTransaction();
        $language = $this->languageRepository->update($request->all(), $language->id);
        DB::commit();

        return Response::json(['message' => 'Language updated successfully.']);
    }

    /**
     * Remove the specified Language from storage.
     *
     * @param  Language $language
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Language $language)
    {
        $this->languageRepository->delete($language->id);

        return Response::json(['message' => 'Language deleted successfully']);
    }
}
