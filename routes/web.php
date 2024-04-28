<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*-------------------- Use case connexion---------------------------*/

Route::get('/', [
    'as' => 'chemin_connexion',
    'uses' => 'connexionController@connecter'
]);

Route::post('/', [
    'as' => 'chemin_valider',
    'uses' => 'connexionController@valider'
]);
Route::get('deconnexion', [
    'as' => 'chemin_deconnexion',
    'uses' => 'connexionController@deconnecter'
]);

/*-------------------- Use case état des frais---------------------------*/
Route::get('selectionMois', [
    'as' => 'chemin_selectionMois',
    'uses' => 'etatFraisController@selectionnerMois'
]);

Route::post('listeFrais', [
    'as' => 'chemin_listeFrais',
    'uses' => 'etatFraisController@voirFrais'
]);

/*-------------------- Use case validation des frais---------------------------*/


Route::get('choisirvisiteurs', [
    'as' => 'chemin_choisirvisiteurs',
    'uses' => 'validationfraisController@choisirvisiteurs'
]);

Route::post('choisirmois', [
    'as' => 'chemin_choisirmois',
    'uses' => 'validationfraisController@choisirmois'
]);

Route::post('fichefraisCR', [
    'as' => 'chemin_fichefraisCR',
    'uses' => 'validationfraisController@fichefraisCR'
]);

Route::post('updateFicheFraisCr', [
    'as' => 'chemin_updateFicheFraisCr',
    'uses' => 'validationfraisController@updateFicheFraisCr'
]);


/*-------------------- Use case affichage des frais validés ---------------------------*/

Route::get('fraisvalide', [
    'as' => 'chemin_fraisvalide',
    'uses' => 'fraisvalideController@choisirMoisVa'
]);

Route::post('voirFraisValide', [
    'as' => 'chemin_voirFraisValide',
    'uses' => 'fraisvalideController@afficherTableau'
]);


Route::get('/frais-valides/pdf/{mois}', 'fraisvalideController@downloadFichesValidéesPDF')->name('frais.valides.pdf');




/*-------------------- Use case gérer les frais---------------------------*/

Route::get('gererFrais', [
    'as' => 'chemin_gestionFrais',
    'uses' => 'gererFraisController@saisirFrais'
]);

Route::post('sauvegarderFrais', [
    'as' => 'chemin_sauvegardeFrais',
    'uses' => 'gererFraisController@sauvegarderFrais'
]);
