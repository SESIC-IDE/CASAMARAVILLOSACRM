<?php

namespace App\Http\Requests\Interaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreInteractionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'type'        => 'required|in:call,email,meeting,whatsapp',
            'date'        => 'required|date',
            'summary'     => 'required|string|min:5',
            'outcome'     => 'nullable|string|max:255',
        ];
    }
}
