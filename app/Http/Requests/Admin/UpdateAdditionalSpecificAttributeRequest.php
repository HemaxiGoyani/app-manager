<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\AdditionalSpecificAttribute;
use App\Repositories\Admin\AdditionalSpecificAttributeRepository;

class UpdateAdditionalSpecificAttributeRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = AdditionalSpecificAttribute::$rules;
        
        return $rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(AdditionalSpecificAttributeRepository::requestHandler($this));
    }
}
