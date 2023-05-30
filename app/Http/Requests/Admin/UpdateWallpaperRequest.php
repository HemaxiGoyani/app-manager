<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\Wallpaper;
use App\Repositories\Admin\WallpaperRepository;

class UpdateWallpaperRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Wallpaper::$rules;

        return $rules;
    }

    /**
     * Includes some attribute corrections
     * @return array|string[]
     */
    public function attributes() {
        return Wallpaper::$labels;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(WallpaperRepository::requestHandler($this));
    }
}
