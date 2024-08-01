<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $photoUrls = explode("\n", $this->photoUrls);
        $photoUrls = array_map('trim', $photoUrls);

        $this->merge([
            'photoUrls' => $photoUrls
        ]);
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'category' => 'required',
            'photoUrls.*' => 'url',
            'tags' => 'required',
        ];
    }
}
