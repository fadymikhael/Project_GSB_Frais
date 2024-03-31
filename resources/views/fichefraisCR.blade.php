@extends('sommairecomptable')
@section('contenu1')
<div id="contenu">
    <h2>Les fiches frais</h2>
    <form action="{{ route('chemin_updateFicheFraisCr')}}" method="post">
        @csrf
        <input type="hidden" name="visiteur_id" value="{{ $visiteur }}">
        <input type="hidden" name="mois" value="{{ $mois }}">

        <label for="ETP">Forfait étape :</label>
        <input type="text" id="ETP" name="ETP" value="{{ $ETP }}">
        <br>
        <label for="KM">Frais Km :</label>
        <input type="text" id="KM" name="KM" value="{{ $KM }}">
        <br>
        <label for="NUI">Nuitée Hôtel :</label>
        <input type="text" id="NUI" name="NUI" value="{{ $NUI }}">
        <br>
        <label for="REP">Repas Restaurant :</label>
        <input type="text" id="REP" name="REP" value="{{ $REP }}">
        <input type="hidden" name="visiteur_id" value="{{ $visiteur }}">

        <br><br>
        <button type="submit" style="width: auto;">Modifier/Valider</button>
    </form>
</div>
@endsection