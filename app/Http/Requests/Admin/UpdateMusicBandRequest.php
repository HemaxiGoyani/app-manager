<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\MusicBand;
use App\Repositories\Admin\MusicBandRepository;

class UpdateMusicBandRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = MusicBand::$rules;
        
        return $rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(MusicBandRepository::requestHandler($this));
    }
}
