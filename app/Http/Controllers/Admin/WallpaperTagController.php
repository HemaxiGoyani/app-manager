<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WallpaperTagDataTable;
use App\Models\WallpaperTag;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateWallpaperTagRequest;
use App\Http\Requests\Admin\UpdateWallpaperTagRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\WallpaperTagRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class WallpaperTagController extends AppBaseController
{
    /** @var  WallpaperTagRepository */
    private $wallpaperTagRepository;

    public function __construct(WallpaperTagRepository $wallpaperTagRepo)
    {
        $this->wallpaperTagRepository = $wallpaperTagRepo;
    }

    /**
     * Display a listing of the WallpaperTag.
     *
     * @param WallpaperTagDataTable $wallpaperTagDataTable
     * @return Response
     */
    public function index(WallpaperTagDataTable $wallpaperTagDataTable)
    {
        return $wallpaperTagDataTable->render('admin.wallpaper_tags.index');
    }

    /**
     * Show the form for creating a new WallpaperTag.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.wallpaper_tags.create');
    }

    /**
     * Store a newly created WallpaperTag in storage.
     *
     * @param CreateWallpaperTagRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateWallpaperTagRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $wallpaperTag = $this->wallpaperTagRepository->create($input);
        DB::commit();

        return Response::json(['message' => 'WallpaperTag has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($wallpaperTag, route('admin.wallpaperTags.edit', $wallpaperTag))]);
    }

    /**
     * Display the specified WallpaperTag.
     *
     * @param  WallpaperTag $wallpaperTag
     *
     * @return Response
     */
    public function show(WallpaperTag $wallpaperTag)
    {
        return view('admin.wallpaper_tags.show')->with('wallpaperTag', $wallpaperTag);
    }

    /**
     * Show the form for editing the specified WallpaperTag.
     *
     * @param  WallpaperTag $wallpaperTag
     *
     * @return Response
     */
    public function edit(WallpaperTag $wallpaperTag)
    {
        return view('admin.wallpaper_tags.edit')->with('wallpaperTag', $wallpaperTag);
    }

    /**
     * Update the specified WallpaperTag in storage.
     *
     * @param  WallpaperTag $wallpaperTag
     * @param UpdateWallpaperTagRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WallpaperTag $wallpaperTag, UpdateWallpaperTagRequest $request)
    {
        DB::beginTransaction();
        $wallpaperTag = $this->wallpaperTagRepository->update($request->all(), $wallpaperTag->id);
        DB::commit();

        return Response::json(['message' => 'WallpaperTag updated successfully.']);
    }

    /**
     * Remove the specified WallpaperTag from storage.
     *
     * @param  WallpaperTag $wallpaperTag
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(WallpaperTag $wallpaperTag)
    {
        $this->wallpaperTagRepository->delete($wallpaperTag->id);

        return Response::json(['message' => 'Wallpaper Tag deleted successfully']);
    }
}
