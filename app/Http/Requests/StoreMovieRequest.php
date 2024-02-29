<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
            'title' => 'required|string|max:180',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'genres' => 'required|array|min:1',
            'genres.*' => 'required|array:name',
            'genres.*.name' => 'required|string|max:30|distinct:strict',

        ];
    }

    public function messages(): array
    {
        return [
            'genres.*.name.distinct' => 'The name of each genre must be unique.',
            'genres.*' => 'The genre array must contain only array with genre names',
            'genres.*.name.required' => 'The genre array must contain only genre names',
            'genres.*.name.string' => 'The genre must be a string',
            'genres.*.name.max' => 'The genre must be maximum 30 characters long',
        ];
    }
}
