@extends ('sommairecomptable')
@section('contenu1')
<div id="contenu">
    <h2>Les fiches de frais</h2>
    <a href="{{ route('chemin_choisirvisiteurs')}}" title="validation"><=Retour au choix visiteur</a>

    <h3>Mois à sélectionner : </h3>
    <form action="{{ route('chemin_fichefraisCR') }}" method="post">
        {{ csrf_field() }}
        <div class="corpsForm">
            @if(!empty($mois))
            <p>
                <label for="lstMois">Mois : </label>
                <select id="lstMois" name="lstMois">
                @foreach($mois as $m)
    <option value="{{ $m['mois'] }}">{{ $m['mois'] }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="visiteur_id" value="{{ $visiteur }}">

            </p>
            @endif
        </div>
            <p> 
                <input id="ok" type="submit" value="Valider" size="20" />
                <input id="annuler" type="reset" value="Effacer" size="20" />
            </p> 
    </form>
</div>
@endsection