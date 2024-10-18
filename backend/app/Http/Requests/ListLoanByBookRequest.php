<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListLoanByBookRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'bookId' => $this->route('id'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'bookId' => ['uuid', 'required'],
        ];
    }
}
