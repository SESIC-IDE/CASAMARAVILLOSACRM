<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'title',
        'description',
        'reminder_date',
        'status',
    ];

    protected $casts = [
        'reminder_date' => 'datetime',
    ];

    // Relaciones
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mutador para vencimiento automático
    public function getIsExpiredAttribute(): bool
    {
        return $this->reminder_date->isPast() && $this->status !== 'Completado';
    }
}
