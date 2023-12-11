<?php

namespace App\Http\Requests\Api\cities;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
            'name_city' => 'required|string|max:50|unique:cities,name_city',
            'id_state'  => 'required|int|min:1|max:999999|exists:states,id'
       ];

       if($this->isMethod('put')) {
            $validation['id'] = 'required|int|min:1|max:999999|exists:cities,id';
            
            if(isset($this->id)) {
                $validation['name_city'] = $validation['name_city'].",{$this->id}";
            }
        }

       return $validation;
    }

    public function attributes() {
        return [
            'name_city' => 'Ciudad',
            'id_state'  => 'ID de Estado'
        ]; 
    }
}
