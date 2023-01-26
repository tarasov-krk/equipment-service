<?php

namespace Modules\Equipment\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestroyEquipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "equipment" => 'required|integer|exists:equipments,id,deleted_at,NULL',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
