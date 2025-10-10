<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'title',
        'description',
        'due_date',
        'status',
        'priority',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
