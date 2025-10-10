<?php

namespace App\Http\Requests\Reminder;

use Illuminate\Foundation\Http\FormRequest;

class StoreReminderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date|after_or_equal:today',
            'status'      => 'in:pending,completed,overdue',
            'priority'    => 'in:low,medium,high',
        ];
    }
}
