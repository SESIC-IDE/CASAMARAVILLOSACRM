<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Clientes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Casa Maravillosa CRM</h2>
    <h3 style="text-align:center;">Reporte de Clientes</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->phone ?? '—' }}</td>
                <td>{{ $c->address ?? '—' }}</td>
                <td>{{ $c->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align:right; margin-top:10px;">Generado: {{ now()->format('d/m/Y H:i') }}</p>
</body>
</html>
