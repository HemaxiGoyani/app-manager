<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WallpaperCategoryDataTable;
use App\Models\Musician;
use App\Models\WallpaperCategory;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateWallpaperCategoryRequest;
use App\Http\Requests\Admin\UpdateWallpaperCategoryRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\WallpaperCategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class WallpaperCategoryController extends AppBaseController
{
    /** @var  WallpaperCategoryRepository */
    private $wallpaperCategoryRepository;

    public function __construct(WallpaperCategoryRepository $wallpaperCategoryRepo)
    {
        $this->wallpaperCategoryRepository = $wallpaperCategoryRepo;
    }

    /**
     * Display a listing of the WallpaperCategory.
     *
     * @param WallpaperCategoryDataTable $wallpaperCategoryDataTable
     * @return Response
     */
    public function index(WallpaperCategoryDataTable $wallpaperCategoryDataTable)
    {
        return $wallpaperCategoryDataTable->render('admin.wallpaper_categories.index');
    }

    /**
     * Show the form for creating a new WallpaperCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.wallpaper_categories.create');
    }

    /**
     * Store a newly created WallpaperCategory in storage.
     *
     * @param CreateWallpaperCategoryRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateWallpaperCategoryRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $wallpaperCategory = $this->wallpaperCategoryRepository->create($input);

        if($request->has('musicians'))
            $wallpaperCategory->musicians()->sync(Musician::whereIn('uuid', $request->input('musicians'))->get());

        DB::commit();

        return Response::json(['message' => 'WallpaperCategory has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($wallpaperCategory, route('admin.wallpaperCategories.edit', $wallpaperCategory))]);
    }

    /**
     * Display the specified WallpaperCategory.
     *
     * @param  WallpaperCategory $wallpaperCategory
     *
     * @return Response
     */
    public function show(WallpaperCategory $wallpaperCategory)
    {
        return view('admin.wallpaper_categories.show')->with('wallpaperCategory', $wallpaperCategory);
    }

    /**
     * Show the form for editing the specified WallpaperCategory.
     *
     * @param  WallpaperCategory $wallpaperCategory
     *
     * @return Response
     */
    public function edit(WallpaperCategory $wallpaperCategory)
    {
        return view('admin.wallpaper_categories.edit')->with('wallpaperCategory', $wallpaperCategory);
    }

    /**
     * Update the specified WallpaperCategory in storage.
     *
     * @param  WallpaperCategory $wallpaperCategory
     * @param UpdateWallpaperCategoryRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WallpaperCategory $wallpaperCategory, UpdateWallpaperCategoryRequest $request)
    {
        DB::beginTransaction();
        $wallpaperCategory = $this->wallpaperCategoryRepository->update($request->all(), $wallpaperCategory->id);

        if($request->has('musicians'))
            $wallpaperCategory->musicians()->sync(Musician::whereIn('uuid', $request->input('musicians'))->get());

        DB::commit();

        return Response::json(['message' => 'WallpaperCategory updated successfully.']);
    }

    /**
     * Remove the specified WallpaperCategory from storage.
     *
     * @param  WallpaperCategory $wallpaperCategory
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(WallpaperCategory $wallpaperCategory)
    {
        $this->wallpaperCategoryRepository->delete($wallpaperCategory->id);

        return Response::json(['message' => 'Wallpaper Category deleted successfully']);
    }
}
