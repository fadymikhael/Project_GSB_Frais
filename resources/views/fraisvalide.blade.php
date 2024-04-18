@extends('sommairecomptable')
@section('contenu1')
    <div id="contenu">
        <h2>Les fiches de frais</h2>

        <h3>Mois à sélectionner : </h3>
        <form action="{{ route('chemin_voirFraisValide') }}" method="post">
            {{ csrf_field() }}
            <div class="corpsForm">
                @if (!empty($mois))
                    <p>
                        <label for="lstMois">Mois : </label>
                        <select id="lstMois" name="lstMois">
                            @foreach ($mois as $m)
                                <option value="{{ $m['mois'] }}">{{ $m['mois'] }}</option>
                            @endforeach
                        </select>
                    </p>
                @endif
            </div>
            <p>
                <input id="ok" type="submit" name="Submit" value="Valider" size="20" />
            </p>
        </form>
    @endsection
