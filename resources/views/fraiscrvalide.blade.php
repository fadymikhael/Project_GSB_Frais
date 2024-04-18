@extends('sommairecomptable')
@section('contenu1')
<div id="contenu" style="padding: 20px;">
    <h2 style="text-align: center;">Les fiches frais</h2>
    <div style="background-color: #f9f9f9; border-radius: 10px; padding: 20px; text-align: center;">
        <h3 style="margin-bottom: 20px;">Bien validé ! &#10004;</h3>
        <p>Votre validation a été enregistrée avec succès.</p>
    </div>
</div>

<div style="text-align: right">
    <a href="{{ route('chemin_choisirvisiteurs')}}" title="Retour au choix visiteur" style="text-decoration: none; color: #007bff; font-weight: bold;margin-bot:  font-size: 16px;">
        &lt; Retour au choix du visiteur
    </a>
</div>
@endsection
