<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\MusicianProfilePicture;
use App\Repositories\Admin\MusicianProfilePictureRepository;

class CreateMusicianProfilePictureRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return MusicianProfilePicture::$rules;
    }

    /**
     * Includes some attribute corrections
     * @return array|string[]
     */
    public function attributes() {
        return MusicianProfilePicture::$labels;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(MusicianProfilePictureRepository::requestHandler($this));
    }
}
