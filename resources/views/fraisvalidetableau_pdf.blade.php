<!DOCTYPE html>
<html>

<head>
    <title>Frais Validés</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <h1>Frais Validés</h1>
    <table>
        <thead>
            <tr>
                <th>Mois</th>
                <th>Visiteur</th>
                <th>Montant Validé</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lesFiches as $fiche)
                <tr>
                    <td>{{ $fiche['mois'] }}</td>
                    <td>{{ $fiche['nom'] }} {{ $fiche['prenom'] }}</td>
                    <td>{{ $fiche['montantValide'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
