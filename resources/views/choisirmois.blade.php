@extends ('sommairecomptable')
@section('contenu1')
<div id="contenu">
    <h2>Les fiches de frais</h2>
    <a href="{{ route('chemin_choisirvisiteurs')}}" title="validation">&lt;= Retour au choix visiteur</a>

    <h3>Mois à sélectionner :</h3>
    <form action="{{ route('chemin_fichefraisCR') }}" method="post">
        {{ csrf_field() }}
        <div class="corpsForm">
            @if(empty($mois))
            <h1 style="color: black; text-align: center; background-color: blue;">Pas de mois à valider pour l'instant</h1>
            @else
            <p>
                <label for="lstMois">Mois :</label>
                <select id="lstMois" name="lstMois">
                    @foreach($mois as $m)
                    <option value="{{ $m['mois'] }}">{{ $m['mois'] }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="visiteur_id" value="{{ $visiteur }}">
            </p>
            @endif
        </div>
        @if(!empty($mois))
        <p>
            <input id="ok" type="submit" value="Valider" size="20" />
        </p>
        @endif
    </form>
</div>
@endsection
