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
                <th><strong>Tipo de Usuario</strong></th>
                <th><strong>Provincia</strong></th>
                <th><strong>Fecha</strong></th>
                <th><strong>Horario</strong></th>
                <th><strong>Estado</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach($almuerzos as $almuerzo)
            <tr>
                @if ($almuerzo->deportista)
                    <td>{{ $almuerzo->deportista->cedula }}</td>
                    <td>{{ $almuerzo->deportista->nombre }}</td>
                    <td>{{ $almuerzo->deportista->apellido }}</td>
                    <td>Atleta</td>
                    <td>{{ $almuerzo->deportista->provincia?->provincia ?? 'N/A' }}</td>
                @endif
                @if ($almuerzo->invitado)
                    <td>{{ $almuerzo->invitado->cedula }}</td>
                    <td>{{ $almuerzo->invitado->nombre }}</td>
                    <td>{{ $almuerzo->invitado->apellido }}</td>
                    <td>{{ $almuerzo->invitado->tipoInvitado->tipo_invitado_nombre }}</td>
                    <td>{{ $almuerzo->invitado->provincia?->provincia ?? 'N/A' }}</td>
                @endif
                <td>{{ $almuerzo->horarioComida->fecha }}</td>
                <td>{{ $almuerzo->horarioComida->horario }}</td>
                <td>{{ $almuerzo->completado ? 'entregado' : 'no entregado' }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td>--</td>
                <td>--</td>
                <td colspan="2">Total no entregados: {{$no_entregados}}</td>
                <td colspan="2">Total entregados: {{$entregados}}</td>
                <td colspan="2">Total: {{ $total }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
