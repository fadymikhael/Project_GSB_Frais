@extends ('sommairecomptable')
@section('contenu1')
<div id="contenu">
    <h2>Les fiches de frais</h2>
    <h3>Visiteur à sélectionner : </h3>
    <form action="{{ route('chemin_choisirmois') }}" method="post">
        {{ csrf_field() }}
        <div class="corpsForm">
            <p>
                <label for="lstVisiteur">Visiteur : </label>
                <select id="lstVisiteur" name="lstVisiteur">
                    @foreach($visiteurs as $visiteur)
                    <option value="{{ $visiteur->id }}">
                        {{ $visiteur->nom }} {{ $visiteur->prenom }}
                    </option>
                    @endforeach
                </select>
</p>
</div>
            <p> 
                <input id="ok" type="submit" value="Valider" size="20" />
                <input id="annuler" type="reset" value="Effacer" size="20" />
            </p> 
        
    </form>
</div>
@endsection