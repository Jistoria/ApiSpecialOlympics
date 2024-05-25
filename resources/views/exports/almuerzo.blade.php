<table>
    <thead>
        <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Tipo de Usuario</th>
            <th>Fecha</th>
            <th>Estado</th>
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
            @endif
            @if ($almuerzo->invitado)
                <td>{{ $almuerzo->invitado->cedula }}</td>
                <td>{{ $almuerzo->invitado->nombre }}</td>
                <td>{{ $almuerzo->invitado->apellido }}</td>
                <td>{{ $almuerzo->invitado->tipoInvitado->tipo_invitado_nombre }}</td>
            @endif
            <td>{{ $almuerzo->horarioComida->fecha }}</td>
            <td>{{ $almuerzo->completado ? 'entregado' : 'no entregado'}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
