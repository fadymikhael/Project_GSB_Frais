@extends('fraisvalide')
@section('contenu2')

    <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 20px;">
        <a href="{{ route('frais.valides.pdf', ['mois' => $moisSelect]) }}" class="custom-btn">Télécharger le PDF</a>

        @if (isset($mois) && isset($lesFiches))
            <table border="1" style="width:100%">
                <tr>
                    <th>Mois</th>
                    <th>Visiteur</th>
                    <th>Montant valide</th>
                </tr>
                @foreach ($lesFiches as $fiche)
                    <tr>
                        <td>{{ $fiche['mois'] }}</td>
                        <td>{{ $fiche['nom'] }} {{ $fiche['prenom'] }}</td>
                        <td>{{ $fiche['montantValide'] }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
