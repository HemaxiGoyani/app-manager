<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\WallpaperCategory;
use App\Repositories\Admin\WallpaperCategoryRepository;

class CreateWallpaperCategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return WallpaperCategory::$rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(WallpaperCategoryRepository::requestHandler($this));
    }
}
