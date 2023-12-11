<?php

namespace App\Http\Requests\Api\states;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validation = [
            'name_state' => 'required|string|max:50|unique:states,name_state'
        ];

        if($this->isMethod('put')) {
            $validation['id'] = 'required|int|min:1|max:999999|exists:states,id';

            if(isset($this->id)) {
                $validation['name_state'] = $validation['name_state'].",{$this->id}";
            }
        }

        return $validation;
    }

    public function attributes() {
        return [
            'name_state' => 'Estado/Provincia',
        ]; 
    }
}
