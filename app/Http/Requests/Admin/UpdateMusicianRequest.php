<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\Musician;
use App\Repositories\Admin\MusicianRepository;

class UpdateMusicianRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Musician::$rules;

        return $rules;
    }

    /**
     * Includes some attribute corrections
     * @return array|string[]
     */
    public function attributes() {
        return Musician::$labels;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(MusicianRepository::requestHandler($this));
    }
}
