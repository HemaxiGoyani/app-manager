<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\MusicianVideo;
use App\Repositories\Admin\MusicianVideoRepository;

class UpdateMusicianVideoRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = MusicianVideo::$rules;
        
        return $rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(MusicianVideoRepository::requestHandler($this));
    }
}
