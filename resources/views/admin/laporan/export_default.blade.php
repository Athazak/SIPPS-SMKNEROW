<table>
    <thead>
        <tr>
            @foreach(array_keys($data->first() ?? []) as $key)
                <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                @foreach($row as $value)
                    <td>{{ $value }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>