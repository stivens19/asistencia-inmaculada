<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <style>
        .header {
            border: solid 1px black;
            padding: 1px 10px 10px 10px;
            font-size: 14px;
        }

        .header h4 {
            font-size: 18px;
            padding-top: 0;
            padding-bottom: 0;
            text-align: center;
        }

        .mr {
            margin-right: 50px;
        }

        table {
            border-collapse: collapse;
            width: 100vw;
            font-size: 12px;
        }

        td.bajo {
            background-color: #3437dd23;
            font-size: 12px;
        }

        thead {
            color: black;
            font-size: 12px;
            font-size: 12px;
        }

        thead tr td {
            font-weight: bold;
            color: #ffffff;
            padding: 1px;
            font-size: 12px;
        }

        tbody tr td {
            color: #4e4e4e;
            padding: 1px;
            font-size: 14px;
        }

        td {
            border-style: solid;
            border-color: #cccccc;
            border-width: 1px;
        }

        .total {
            text-align: right;
        }
        .tarde {
            color:red;
        }
    </style>
</head>

<body>
    <div class="header">
        <h4>REPORTE DE ASISTENCIAS</h4>
    </div>

    <h2>SALON: {{ $grado }}º {{ $seccion }}</h2>
    <table>
        <thead>
            <tr>
                <th>FECHA</th>
                <th>HORA INGRESO</th>
                <th>ALUMNO</th>
                <th>HORA DE LLEGADA</th>
                <th>TARDE</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalTarde=0;
                $totalTemprano=0;
            @endphp
            @foreach ($attuser as $att)
                @php
                    if($att->tarde){
                        $totalTarde++;
                    }else{
                        $totalTemprano++;
                    }
                @endphp
                <tr>
                    <td>{{ $att->attendance->date }}</td>
                    <td>{{ $att->attendance->time_in }}</td>
                    <td>{{ $att->user->name }}</td>
                    <td>{{ $att->time_attendance }}</td>
                    <td class="{{ $att->tarde ? 'tarde' : null }}">{{ $att->tarde ? 'Si' :'No'}}</td>
                </tr>
            @endforeach


        </tbody>



    </table>
    <p class="total">Total Tardes :{{ $totalTarde }} Alumnos</p>
    <p class="total">Total Temprano :{{ $totalTemprano }} Alumnos</p>
    <p class="total">Total en Clases :{{ $totalTemprano + $totalTarde }} Alumnos</p>
</body>

</html>
