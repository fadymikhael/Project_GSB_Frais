@extends ('sommairecomptable')
@section('contenu1')

    <div id="contenu">
        <h2>Les fiches de frais</h2>
        <style>
            .button {
                background-color: #3498db;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                transition: background-color 0.3s;
                margin-top: 100px;

            }

            .button:hover {
                background-color: #2980b9;
            }
        </style>

        <h3>Mois à sélectionner :</h3>
        <form action="{{ route('chemin_fichefraisCR') }}" method="post">
            {{ csrf_field() }}
            <div class="corpsForm">
                @if (empty($mois))
                    <h1 style="color: black; text-align: center; background-color: rgb(162, 162, 197);">Pas de mois à valider
                        pour
                        l'instant</h1>
                @else
                    <p>
                        <label for="lstMois">Mois :</label>
                        <select id="lstMois" name="lstMois">
                            @foreach ($mois as $m)
                                <option value="{{ $m['mois'] }}">{{ $m['mois'] }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="visiteur_id" value="{{ $visiteur }}">
                    </p>
                @endif
            </div>
            @if (!empty($mois))
                <p>
                    <input id="ok" type="submit" value="Valider" size="20" />
                </p>
            @endif
            <a href="{{ route('chemin_choisirvisiteurs') }}" class="button" title="validation"> Retour au choix du
                visiteur</a>

        </form>
    </div>
@endsection
