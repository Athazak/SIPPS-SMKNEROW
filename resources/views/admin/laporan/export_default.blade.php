<table border="1" style="border-collapse: collapse; width:100%;">
    <thead>
        <tr style="background:#E0E7FF; font-weight:bold; text-align:center;">
            @foreach(array_keys($data->first() ?? []) as $key)
                <th style="width:150px;">{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
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