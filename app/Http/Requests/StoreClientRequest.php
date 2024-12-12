<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
        return [
            'client_photo' => 'required|mimes:doc,pdf,docx,zip,jpeg,jpg,csv,txt,xlx,xls,png',
        ];
    }

    public function messages()
    {
        return [
            'client_photo.required' => 'The client photo is missing',
        ];
    }
}
