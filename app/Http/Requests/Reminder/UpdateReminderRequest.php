<?php

namespace App\Http\Requests\Reminder;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReminderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'status'      => 'in:pending,completed,overdue',
            'priority'    => 'in:low,medium,high',
        ];
    }
}
