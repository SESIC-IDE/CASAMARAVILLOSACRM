<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Interaction;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;

class ReportController extends Controller
{
    public function dashboard()
    {
        $customersCount     = Customer::count();
        $interactionsCount  = Interaction::count();
        $remindersPending   = Reminder::where('status', 'pending')->count();
        $remindersCompleted = Reminder::where('status', 'completed')->count();
        $remindersOverdue   = Reminder::where('status', 'overdue')->count();

        // Datos para gráfico
        $chartData = [
            'labels' => ['Pendientes', 'Completados', 'Vencidos'],
            'values' => [$remindersPending, $remindersCompleted, $remindersOverdue],
        ];

        return view('dashboard.index', compact(
            'customersCount',
            'interactionsCount',
            'remindersPending',
            'remindersCompleted',
            'remindersOverdue',
            'chartData'
        ));
    }

    public function customersReport()
    {
        $customers = Customer::all();
        return view('reports.customers', compact('customers'));
    }

    public function exportPdf()
    {
        $customers = Customer::all();
        $pdf = Pdf::loadView('reports.customers_pdf', compact('customers'))
            ->setPaper('a4', 'portrait');
        return $pdf->download('reporte_clientes.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new CustomersExport, 'reporte_clientes.xlsx');
    }
}
