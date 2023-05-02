<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'testid' => 'required|exists:tests,id',
            'partnumber' => 'required|string|max:255',
            'serialno' => 'required|string|max:255',
            'duration' => 'required|integer',
            'results' => 'required|array',
            'results.*.defname' => 'required|string|max:255',
            'results.*.read' => 'required|numeric',
            'results.*.result' => 'required|string|max:255',
        ];
    }
}
