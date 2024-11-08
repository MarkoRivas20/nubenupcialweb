<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Celular</th>
        <th>Confirmacion</th>
        <th>Mensaje</th>
        <th>Fecha</th>
    </tr>
    </thead>
    <tbody>
    @foreach($confirmations as $confirmation)
        <tr>
            <td>{{ $confirmation->person_name }}</td>
            <td>{{ $confirmation->person_phone }}</td>
            <td>
                @switch($confirmation->person_confirmation)
                    @case(0)
                        Si
                        @break
                    @case(1)
                        No
                        @break
                    @default
                        
                @endswitch
            </td>
            <td>{{ $confirmation->person_message }}</td>
            <td>{{$confirmation->created_at->format('d/m/Y h:m:s')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>