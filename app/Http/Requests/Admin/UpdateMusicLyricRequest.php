<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\MusicLyric;
use App\Repositories\Admin\MusicLyricRepository;

class UpdateMusicLyricRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = MusicLyric::$rules;

        return $rules;
    }

    /**
     * Includes some attribute corrections
     * @return array|string[]
     */
    public function attributes() {
        return MusicLyric::$labels;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(MusicLyricRepository::requestHandler($this));
    }
}
