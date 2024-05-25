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

                <td>{{ $almuerzo->deportista?->cedula ?? $almuerzo->invitado->cedula }}</td>
                <td>{{ $almuerzo->deportista?->nombre ?? $almuerzo->invitado->nombre}}</td>
                <td>{{ $almuerzo->deportista?->apellido ?? $almuerzo->invitado->apellido }}</td>
                <td>{{ $almuerzo->deportista ? 'Atleta' : $almumerzo->invitado->tipo_invitado_nombre}}</td>

            <td>{{ $almuerzo->horarioComida->fecha }}</td>
            <td>{{ $almuerzo->completado ? 'entregado' : 'no entregado'}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
