<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Customer::select('id', 'name', 'email', 'phone', 'address', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Correo', 'Teléfono', 'Dirección', 'Fecha de Registro'];
    }
}
