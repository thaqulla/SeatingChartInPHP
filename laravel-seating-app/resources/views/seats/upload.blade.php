<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Data</title>
</head>
<body>
    <h1>Uploaded Data</h1>

    <table>
      {{$data[0][1]}}
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
                <th>Column 1</th>
                <th>Column 1</th>
                <!-- 必要なだけ列を追加 -->
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
