<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\MusicianProfilePicture;
use App\Repositories\Admin\MusicianProfilePictureRepository;

class UpdateMusicianProfilePictureRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = MusicianProfilePicture::$rules;
        
        return $rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(MusicianProfilePictureRepository::requestHandler($this));
    }
}
