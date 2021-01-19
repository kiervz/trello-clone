<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $isMethodPut = $this->method() == 'PUT';
        return [
            'name' => $isMethodPut ? 'required|string|unique:tasks,name,' .$this->id : 'required|string|unique:tasks'
        ];
    }
}
