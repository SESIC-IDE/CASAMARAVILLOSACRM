<?php

namespace App\Repositories\Eloquent;

use App\Models\Interaction;
use App\Repositories\Contracts\InteractionRepositoryInterface;

class InteractionRepository implements InteractionRepositoryInterface
{
    public function all()
    {
        return Interaction::with('customer')->latest()->get();
    }

    public function find($id)
    {
        return Interaction::findOrFail($id);
    }

    public function create(array $data)
    {
        return Interaction::create($data);
    }

    public function update($id, array $data)
    {
        $interaction = $this->find($id);
        $interaction->update($data);
        return $interaction;
    }

    public function delete($id)
    {
        return Interaction::destroy($id);
    }

    public function byCustomer($customerId)
    {
        return Interaction::where('customer_id', $customerId)->get();
    }
}
