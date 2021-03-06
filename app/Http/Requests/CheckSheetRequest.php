<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckSheetRequest extends FormRequest
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
        return [
            'comment' => ['nullable', 'string', 'max:5000'],
            'job' => ['required', 'string', 'max:255'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['exists:App\Models\Label,id']
        ];
    }
}
