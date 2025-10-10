<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ReminderRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Http\Requests\Reminder\StoreReminderRequest;
use App\Http\Requests\Reminder\UpdateReminderRequest;

class ReminderController extends Controller
{
    public function __construct(
        protected ReminderRepositoryInterface $reminders,
        protected CustomerRepositoryInterface $customers
    ) {}

    public function index()
    {
        $data = $this->reminders->all();
        return view('reminders.index', compact('data'));
    }

    public function create()
    {
        $customers = $this->customers->all();
        return view('reminders.create', compact('customers'));
    }

    public function store(StoreReminderRequest $request)
    {
        $this->reminders->create($request->validated());
        return redirect()->route('reminders.index')->with('success', 'Recordatorio creado correctamente.');
    }

    public function edit($id)
    {
        $reminder = $this->reminders->find($id);
        $customers = $this->customers->all();
        return view('reminders.edit', compact('reminder', 'customers'));
    }

    public function update(UpdateReminderRequest $request, $id)
    {
        $this->reminders->update($id, $request->validated());
        return redirect()->route('reminders.index')->with('success', 'Recordatorio actualizado.');
    }

    public function destroy($id)
    {
        $this->reminders->delete($id);
        return redirect()->route('reminders.index')->with('success', 'Recordatorio eliminado.');
    }
}
