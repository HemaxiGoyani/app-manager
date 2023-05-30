<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WallpaperDataTable;
use App\Models\Musician;
use App\Models\Wallpaper;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateWallpaperRequest;
use App\Http\Requests\Admin\UpdateWallpaperRequest;
use App\Models\WallpaperTag;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\WallpaperRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class WallpaperController extends AppBaseController
{
    /** @var  WallpaperRepository */
    private $wallpaperRepository;

    public function __construct(WallpaperRepository $wallpaperRepo)
    {
        $this->wallpaperRepository = $wallpaperRepo;
    }

    /**
     * Display a listing of the Wallpaper.
     *
     * @param WallpaperDataTable $wallpaperDataTable
     * @return Response
     */
    public function index(WallpaperDataTable $wallpaperDataTable)
    {
        return $wallpaperDataTable->render('admin.wallpapers.index');
    }

    /**
     * Show the form for creating a new Wallpaper.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.wallpapers.create');
    }

    /**
     * Store a newly created Wallpaper in storage.
     *
     * @param CreateWallpaperRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateWallpaperRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $wallpaper = $this->wallpaperRepository->create($input);

        if($request->has('musicians'))
            $wallpaper->musicians()->sync(Musician::whereIn('uuid', $request->input('musicians'))->get());

        if($request->has('wallpaper_tags'))
            $wallpaper->tags()->sync(WallpaperTag::whereIn('uuid', $request->input('wallpaper_tags'))->get());

        $this->wallpaperRepository->updateOrCreate_avatar($wallpaper, $request);
        DB::commit();

        return Response::json(['message' => 'Wallpaper has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($wallpaper, route('admin.wallpapers.edit', $wallpaper))]);
    }

    /**
     * Display the specified Wallpaper.
     *
     * @param  Wallpaper $wallpaper
     *
     * @return Response
     */
    public function show(Wallpaper $wallpaper)
    {
        return view('admin.wallpapers.show')->with('wallpaper', $wallpaper);
    }

    /**
     * Show the form for editing the specified Wallpaper.
     *
     * @param  Wallpaper $wallpaper
     *
     * @return Response
     */
    public function edit(Wallpaper $wallpaper)
    {
        return view('admin.wallpapers.edit')->with('wallpaper', $wallpaper);
    }

    /**
     * Update the specified Wallpaper in storage.
     *
     * @param  Wallpaper $wallpaper
     * @param UpdateWallpaperRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Wallpaper $wallpaper, UpdateWallpaperRequest $request)
    {
        DB::beginTransaction();
        $wallpaper = $this->wallpaperRepository->update($request->all(), $wallpaper->id);

        if($request->has('musicians'))
            $wallpaper->musicians()->sync(Musician::whereIn('uuid', $request->input('musicians'))->get());

        if($request->has('wallpaper_tags'))
            $wallpaper->tags()->sync(WallpaperTag::whereIn('uuid', $request->input('wallpaper_tags'))->get());

        DB::commit();

        return Response::json(['message' => 'Wallpaper updated successfully.']);
    }

    /**
     * Remove the specified Wallpaper from storage.
     *
     * @param  Wallpaper $wallpaper
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Wallpaper $wallpaper)
    {
        $this->wallpaperRepository->delete($wallpaper->id);

        return Response::json(['message' => 'Wallpaper deleted successfully']);
    }
}
