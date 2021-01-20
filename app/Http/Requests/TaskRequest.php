<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'task_name' => $isMethodPut ? 'required|string|unique:tasks,task_name,' .$this->id : ['required','string', Rule::unique('tasks')->where(function($query) {
                $query->where('user_id', '<>', $this->user_id);
            })]
        ];
    }
}
