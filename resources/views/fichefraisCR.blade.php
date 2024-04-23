@extends('sommairecomptable')
@section('contenu1')
<div id="contenu">
    <h2>Les fiches frais</h2>
    <form action="{{ route('chemin_updateFicheFraisCr')}}" method="post">
        @csrf
        <input type="hidden" name="visiteur_id" value="{{ $visiteur }}">
        <input type="hidden" name="mois" value="{{ $mois }}">

        <table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 10px;">Libellé</th>
                    <th style="padding: 10px;">Montant</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 10px;">Forfait étape :</td>
                    <td style="padding: 10px;"><input type="text" id="ETP" name="ETP" value="{{ $ETP }}" readonly></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Frais Km :</td>
                    <td style="padding: 10px;"><input type="text" id="KM" name="KM" value="{{ $KM }}" readonly></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Nuitée Hôtel :</td>
                    <td style="padding: 10px;"><input type="text" id="NUI" name="NUI" value="{{ $NUI }}" readonly></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Repas Restaurant :</td>
                    <td style="padding: 10px;"><input type="text" id="REP" name="REP" value="{{ $REP }}" readonly></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <button type="button" onclick="activerModification()" style="width: auto; padding: 10px;">Modifier</button>
                        <button type="submit" style="width: auto; padding: 10px;">Valider</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="visiteur_id" value="{{ $visiteur }}">

        <!-- Affichage des erreurs -->
        @if(isset($erreur))
    <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; padding: 20px;">
        <ul style="list-style-type: none; padding: 0;">
            @foreach ($erreur as $message)
                <li style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 10px; font-size: 18px;">
                    {{ $message }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
      
    </form>
</div>


<script>
    function activerModification() {
        document.getElementById("ETP").removeAttribute("readonly");
        document.getElementById("KM").removeAttribute("readonly");
        document.getElementById("NUI").removeAttribute("readonly");
        document.getElementById("REP").removeAttribute("readonly");
    }
</script>

@endsection
