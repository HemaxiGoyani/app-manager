<?php

namespace App\Http\Requests\Admin;

use App\MyClasses\GeneralHelperFunctions;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AppAdditionalSpecificValueRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(
            [
                'from_date' => 'nullable|date_format:Y-m-d',
                'to_date' => 'nullable|date_format:Y-m-d',
            ],
            GeneralHelperFunctions::getRulesForArrFilterInputs('uuid|exists:applications,uuid,deleted_at,NULL', 'applications'),
            GeneralHelperFunctions::getRulesForArrFilterInputs('uuid|exists:additional_specific_attributes,uuid,deleted_at,NULL', 'attributes')
        );
    }

    protected function prepareForValidation() {
        $this->merge([
            'from_date' => !is_null($this->input('from_date')) ? Carbon::createFromFormat('d/m/Y',$this->input('from_date'))->toDateString() : null,
            'to_date' => !is_null($this->input('to_date')) ? Carbon::createFromFormat('d/m/Y',$this->input('to_date'))->toDateString() : null,
            'applications' => $this->input('applications') ? array_values($this->input('applications')) : [],
            'attributes' => $this->input('attributes') ? array_values($this->input('attributes')) : [],
        ]);
    }
}
