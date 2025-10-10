<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\InteractionRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Http\Requests\Interaction\StoreInteractionRequest;
use App\Http\Requests\Interaction\UpdateInteractionRequest;

class InteractionController extends Controller
{
    public function __construct(
        protected InteractionRepositoryInterface $interactions,
        protected CustomerRepositoryInterface $customers
    ) {}

    public function index()
    {
        $data = $this->interactions->all();
        return view('interactions.index', compact('data'));
    }

    public function create()
    {
        $customers = $this->customers->all();
        return view('interactions.create', compact('customers'));
    }

    public function store(StoreInteractionRequest $request)
    {
        $this->interactions->create($request->validated());
        return redirect()->route('interactions.index')->with('success', 'Interacción registrada correctamente.');
    }

    public function edit($id)
    {
        $interaction = $this->interactions->find($id);
        $customers = $this->customers->all();
        return view('interactions.edit', compact('interaction', 'customers'));
    }

    public function update(UpdateInteractionRequest $request, $id)
    {
        $this->interactions->update($id, $request->validated());
        return redirect()->route('interactions.index')->with('success', 'Interacción actualizada correctamente.');
    }

    public function destroy($id)
    {
        $this->interactions->delete($id);
        return redirect()->route('interactions.index')->with('success', 'Interacción eliminada.');
    }
}
