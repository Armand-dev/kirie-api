<!DOCTYPE html>
<html>
    <head>
        <style>
            .page-break {
                page-break-after: always;
            }

            /* Bootstrap classes */
            .table {
                border-collapse: collapse !important;
                background-color: white;
            }

            td, th {
                background-color: white !important;
            }

            .thead-light > th {
                color: #495057;
                background-color: #e9ecef;
                border-color: #dee2e6;
            }

            .w-full {
                width: 100%;
            }
        </style>
    </head>
    <body>
        {!! $body !!}
        <div class="page-break"></div>
        @if(count($equipment))
            <div>
                <h2 class="text-center mt-4">Anexa 1: <strong>Echipament</strong></h2>
            </div>
            <div>
                <p class="justify-center mt-2">In tabelul de mai jos veti regasi echipamentele instalate in locatie, pe care le preluati in chirie:</p>
            </div>
            <div>
                <table class="table w-full">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Nr. Crt</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model - Serial</th>
                        <th scope="col">Valoare</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($equipment as $item)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $item->category }} > {{ $item->subcategory }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->model }} - {{ $item->serial }}</td>
                            <td>{{ $item->price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </body>
</html>
