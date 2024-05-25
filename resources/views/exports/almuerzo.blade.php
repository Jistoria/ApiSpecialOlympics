<table>
    <thead>
        <tr>
            <th><strong>Cedula</strong></th>
            <th><strong>Nombre</strong></th>
            <th><strong>Apellido</strong></th>
            <th><strong>Tipo de Usuario</strong></th>
            <th><strong>Fecha</strong></th>
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
        <tr></tr>
        <tr>
            <td>--</td>
            <td>--</td>
            <td><strong>Total {{$no_entregados}}</strong></td>
            <td><strong>Total entregados {{$entregados}}</strong></td>
            <td><strong>Total {{ $total }}</strong></td>
        </tr>
    </tbody>
</table>
