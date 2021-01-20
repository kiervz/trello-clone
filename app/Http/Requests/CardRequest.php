<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CardRequest extends FormRequest
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
            'card_name' => $isMethodPut ? 'required|string|unique:cards,card_name,' .$this->id : ['required','string', Rule::unique('cards')->where(function($query) {
                $query->where('task_id', '=', $this->task_id);
            })]
        ];
    }
}
