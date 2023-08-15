<!DOCTYPE html>
<html>
    <head>
        <style>
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    <body>
        {!! $body !!}
        <div class="page-break"></div>
        @if(count($equipment))
            Anexa 1: <strong>Echipament</strong>
            <table>
                <thead>
                    <tr>
                        <th>Nr. Crt</th>
                        <th>Categorie</th>
                        <th>Brand</th>
                        <th>Model - Serial</th>
                        <th>Valoare</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipment as $item)
                    <tr>
                        <td>{{ $loop->index }}</td>
                        <td>{{ $item->category }} > {{ $item->subcategory }}</td>
                        <td>{{ $item->brand }}</td>
                        <td>{{ $item->model }} - {{ $item->serial }}</td>
                        <td>{{ $item->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </body>
</html>
