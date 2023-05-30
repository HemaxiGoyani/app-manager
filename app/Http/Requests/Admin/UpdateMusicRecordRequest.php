<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\MusicRecord;
use App\Repositories\Admin\MusicRecordRepository;

class UpdateMusicRecordRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = MusicRecord::$rules;

        $musicRecord =$this->route('musicRecord');
        $musicRecord->hasMedia('musics') ? $requiredMedia = 'nullable' : $requiredMedia = 'required';
        $rules['music'] = $requiredMedia . '|mimes:mp3,wav';
        return $rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(MusicRecordRepository::requestHandler($this));
    }
}
