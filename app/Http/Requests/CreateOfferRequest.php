<?php

namespace App\Http\Requests;

use App\Enums\OfferStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['bail', 'required', 'string', 'min:3', 'max:255'],
            'description' => ['bail', 'required', 'string', 'min:3', 'max:65535'],
            'status' => ['bail', 'required', 'string', Rule::enum(OfferStatus::class)],
        ];
    }
}
