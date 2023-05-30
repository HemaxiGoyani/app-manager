<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\WallpaperTag;
use App\Repositories\Admin\WallpaperTagRepository;

class UpdateWallpaperTagRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = WallpaperTag::$rules;
        
        return $rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(WallpaperTagRepository::requestHandler($this));
    }
}
