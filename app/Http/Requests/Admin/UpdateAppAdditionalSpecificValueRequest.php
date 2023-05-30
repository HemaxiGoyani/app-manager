<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\AppAdditionalSpecificValue;
use App\Repositories\Admin\AppAdditionalSpecificValueRepository;

class UpdateAppAdditionalSpecificValueRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = AppAdditionalSpecificValue::$rules;

        return $rules;
    }

    /**
     * Includes some attribute corrections
     * @return array|string[]
     */
    public function attributes() {
        return AppAdditionalSpecificValue::$labels;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation()
    {
        $this->merge(AppAdditionalSpecificValueRepository::requestHandler($this));
    }
}
