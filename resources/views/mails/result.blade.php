<table class="table" id="example1">
    <thead>
        <th>Candidato </th>
        <th>Código del Candidato</th>
    </thead>
    <tbody>
        <tr>
            <td>{{ $result->nominee->name }}</td>
            <td align="center">{{ $result->nominee->code }}</td>
        </tr>
    </tbody>
</table>
<hr>
<p>Fecha y hora de la votación: {{ $result->created_at }}</p>
<p>¡Muchas gracias por participar del proceso de elección de delegados 2021!</p>
