<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function __construct(protected CustomerRepositoryInterface $customers) {}

    public function index(): View
    {
        $data = $this->customers->all();
        return view('customers.index', compact('data'));
    }

    public function create(): View
    {
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        $this->customers->create($request->validated());
        return redirect()->route('customers.index')->with('success', 'Cliente creado exitosamente.');
    }

    public function edit($id): View
    {
        $customer = $this->customers->find($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, $id): RedirectResponse
    {
        $this->customers->update($id, $request->validated());
        return redirect()->route('customers.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        $this->customers->delete($id);
        return redirect()->route('customers.index')->with('success', 'Cliente eliminado.');
    }
}
