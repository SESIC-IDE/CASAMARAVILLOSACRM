<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::with('customer')
            ->where('user_id', Auth::id())
            ->orderBy('reminder_date', 'asc')
            ->paginate(10);

        return view('reminders.index', compact('reminders'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('reminders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'reminder_date' => 'required|date',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        Reminder::create([
            ...$validated,
            'user_id' => Auth::id(),
            'status' => 'Pendiente',
        ]);

        return redirect()->route('reminders.index')->with('success', 'Recordatorio creado correctamente.');
    }

    public function edit(Reminder $reminder)
    {
        $customers = Customer::all();
        return view('reminders.edit', compact('reminder', 'customers'));
    }

    public function update(Request $request, Reminder $reminder)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'reminder_date' => 'required|date',
            'status' => 'required|string',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        $reminder->update($validated);

        return redirect()->route('reminders.index')->with('success', 'Recordatorio actualizado correctamente.');
    }

    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
        return redirect()->route('reminders.index')->with('success', 'Recordatorio eliminado correctamente.');
    }
}
