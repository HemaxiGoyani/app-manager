<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\MusicianVideo;
use App\Repositories\Admin\MusicianVideoRepository;

class CreateMusicianVideoRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return MusicianVideo::$rules;
    }

    /**
     * Includes some attribute corrections
     * @return array|string[]
     */
    public function attributes() {
        return MusicianVideo::$labels;
    }
    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(MusicianVideoRepository::requestHandler($this));
    }
}
