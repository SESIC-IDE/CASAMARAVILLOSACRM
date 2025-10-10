<?php

namespace App\Repositories\Eloquent;

use App\Models\Reminder;
use App\Repositories\Contracts\ReminderRepositoryInterface;

class ReminderRepository implements ReminderRepositoryInterface
{
    public function all()
    {
        return Reminder::with('customer')->latest()->get();
    }

    public function find($id)
    {
        return Reminder::findOrFail($id);
    }

    public function create(array $data)
    {
        return Reminder::create($data);
    }

    public function update($id, array $data)
    {
        $reminder = $this->find($id);
        $reminder->update($data);
        return $reminder;
    }

    public function delete($id)
    {
        return Reminder::destroy($id);
    }

    public function pending()
    {
        return Reminder::where('status', 'pending')->get();
    }
}
