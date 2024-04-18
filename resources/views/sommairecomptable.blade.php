@extends ('modeles/comptable')
@section('menu')
<!-- Division pour le sommaire -->
<div id="menuGauche">
    <div id="infosUtil">
        <p style="font-size: 20px; color: #333;"><strong>Bonjour {{ $comptable['nom'] . ' ' . $comptable['prenom'] }}</strong></p>
    </div>
    <ul id="menuList">
        <li class="smenu" style="margin-bottom: 10px;">
            <a href="{{ route('chemin_choisirvisiteurs')}}" title="validation" style="font-size: 18px; color: #007bff;">Validation des frais</a>
        </li>
        <li class="smenu" style="margin-bottom: 10px;">
            <a href="{{ route('chemin_fraisvalide')}}" title="frais" style="font-size: 18px; color: #007bff;">Frais validés</a>
        </li>
        <li class="smenu" style="margin-bottom: 10px;">
            <a href="{{ route('chemin_deconnexion') }}" title="Se déconnecter" style="font-size: 18px; color: #007bff;">Déconnexion</a>
        </li>
    </ul>
</div>
@endsection
