<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtikliRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'naziv' => 'required|string|max:50',
            'opis' => 'required|string',
            'slikaLink' => 'required|string',
            'stanje' => 'required|numeric',
            'osnovnaCena' => 'required|numeric',
            'procenatPopusta' => 'required|numeric'
        ];
    }
}
