@extends ('sommairecomptable')
@section('contenu1')
<div id="contenu">
    <h2>Les fiches de frais</h2>
    <h3>Mois à sélectionner : </h3>
    <form action="{{ route('chemin_choisirmois') }}" method="post">
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
            </p>
            @endif
        </div>
        <div class="piedForm">
            <p> 
                <input id="ok" type="submit" value="Valider" size="20" />
                <input id="annuler" type="reset" value="Effacer" size="20" />
            </p> 
        </div>
    </form>
</div>
@endsection