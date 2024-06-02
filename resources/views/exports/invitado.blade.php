<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total-row td {
            font-weight: bold;
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th><strong>Cédula</strong></th>
                <th><strong>Nombre</strong></th>
                <th><strong>Apellido</strong></th>
                <th><strong>Tipo de Invitado</strong></th>
                <th><strong>Provincia</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach($invitados as $invitado)
            <tr>
                <td>{{ $invitado->cedula }}</td>
                <td>{{ $invitado->nombre }}</td>
                <td>{{ $invitado->apellido }}</td>
                <td>{{ $invitado->tipoInvitado->tipo_invitado_nombre }}</td>
                <td>{{ $invitado->provincia?->provincia ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
