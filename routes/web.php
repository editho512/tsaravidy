<?php

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


Route::get('/', function () {
    //Verifier si l'utilisateur ne possède aucun rôle
    $getRole = false;

    if(@unserialize(auth()->user()->role)){
        foreach (unserialize(auth()->user()->role) as $key => $value) {
            if(in_array($value, droit())){
               $getRole = true;
            }
        }
        
    }

    return view('accueil', compact("getRole"));
})->name('accueil');

Auth::routes();


Route::group(['middleware' => ['role']], function () {
    
    Route::get('/home', 'HomeController@index')->name('home');

    /**-------------------- LIVRAISON -------------------------------- */

    Route::get('/livraison/bon_livraison/delete/{livraison}', 'LivraisonController@delete_bon_livraison')->name('livraison.delete_bon_livraison');

    Route::post('/livraison/livraison/modifier/', 'LivraisonController@modifier')->name('livraison.modifier');

    Route::get('/livraison/bon_livraison/supprimer/{livraison}', 'LivraisonController@supprimer_bon_livraison')->name('livraison.supprimer_bon_livraison');

    Route::get('/livraison/livraison/supprimer/{livraison}', 'LivraisonController@supprimer_livraison')->name('livraison.supprimer_livraison');

    Route::get('/livraison/bon_livraison/modifier/{livraison}', 'LivraisonController@modifier_bon_livraison')->name('livraison.modifier_bon_livraison');

    Route::get('/livraison/bon_livraison/download/{livraison}', 'LivraisonController@download_bon_livraison')->name('livraison.download');

    Route::get('/livraison/bon_livraison/{livraison}', 'LivraisonController@voir_bon_livraison')->name('livraison.bon_livraison');

    Route::post('/livraison/ajouter', 'LivraisonController@ajouter')->name('livraison.ajouter');

    Route::get('/livraison/commande/{commande?}', 'LivraisonController@commande')->name('livraison.commande');

    Route::get('/livraison', 'LivraisonController@index')->name('livraison.liste');
    
    /**-------------------- FIN LIVRAISON -------------------------------- */

    /** ------------------ DASHBOARD CONTROLLER ---------------------- */
    
    Route::post('/dashboard/liste/production', 'DashboardController@production_periodique')->name('dashboard_production_liste');
    
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('role');;
    
    Route::post('/dashboard/liste', 'DashboardController@depense_liste')->name('dashboard_depense_liste');
    
    Route::post('/dashboard/liste/gain', 'DashboardController@gain_liste')->name('dashboard_gain_liste');
    
    Route::get('/dashboard/depense_periodique/{debut?}', 'DashboardController@depense_periodique')->name('depense_periodique');
    
    /** ------------------ FIN DASHBOARD CONTROLLER ---------------------- */
    
    
    /** ------------------ USER CONTROLLER ---------------------- */

    Route::post('/user/create', 'UserController@create')->name('utilisateur.creer');
    
    Route::get('/user', 'UserController@index')->name('utilisateurs');
    
    Route::get('/user/{user}', 'UserController@edit')->name('utilisateurs.edit');
    
    Route::patch('/user/update/{user}', 'UserController@update')->name('utilisateurs.update');
    
    Route::delete('/user/supprimer/{user}', 'UserController@delete')->name('utilisateurs.delete');
    
    
    /**-------------------FIN USER CONTROLLER----------------------*/
    
    
    /**-------------------DEPENSE CONTROLLER----------------------*/
    Route::post('/depenses/loyer/delete/{loyer}', 'DepenseController@loyerDelete')->name('loyer.delete');

    Route::get('/depenses/loyer/supprimer/{loyer}', 'DepenseController@loyerSupprimer')->name('loyer.delete.show');
    
    Route::post('/depenses/loyer/update/{loyer}', 'DepenseController@loyerUpdate')->name('loyer.update');

    Route::get('/depenses/loyer/modifier/{loyer}', 'DepenseController@loyerModifier')->name('loyer.edit.show');

    Route::post('/depense/loyer/create', 'DepenseController@createLoyer')->name('depense.loyer.create');
    
    Route::get('/depenses/{tabActive?}', 'DepenseController@index')->name('depense');
    
    Route::post('/depense', 'DepenseController@create')->name('depense.create');
    
    Route::get('/depense/{depense}', 'DepenseController@edit')->name('depense.edit');
    
    Route::post('/depense/update/{depense}', 'DepenseController@update')->name('depense.update');
    
    Route::get('/depense/supprimer/{depense}', 'DepenseController@showDelete')->name('depense.delete.show');
    
    Route::delete('/depense/supprimer/{depense}', 'DepenseController@delete')->name('depense.delete');
    
    /**-------------------FIN DEPENSE CONTROLLER----------------------*/
    
    
    /**-------------------MATIERE CONTROLLER----------------------*/
    
    Route::get('/matieres', 'MatierePremiereController@index')->name('matiere');
    
    Route::get('/matiere/{matiere}', 'MatierePremiereController@show')->name('matiere.show');
    
    Route::post('/matiere', 'MatierePremiereController@create')->name('matiere.create');
    
    Route::get('/matiere/single/{matiere}', 'MatierePremiereController@editSingle')->name('matiere.edit');
    
    Route::post('/matiere/single/update/{matiere}', 'MatierePremiereController@updateSingle')->name('matiere.update');
    
    Route::get('/matiere/single/delete/{matiere}', 'MatierePremiereController@showDeleteSingle')->name('matiere.single.delete.show');
    
    Route::delete('/matiere/single/delete/{matiere}', 'MatierePremiereController@deleteSingle')->name('matiere.single.delete');
    
    Route::get('/matiere-premiere/{matierePremiere}', 'MatierePremiereController@edit')->name('matiere.premiere.edit');
    
    Route::post('/matiere-premiere/update/{matierePremiere}', 'MatierePremiereController@update')->name('matiere.premiere.update');
    
    Route::get('/matiere-premiere/supprimer/{matierePremiere}', 'MatierePremiereController@showDelete')->name('matiere.premiere.delete.show');
    
    Route::delete('/matiere-premiere/supprimer/{matierePremiere}', 'MatierePremiereController@delete')->name('matiere.premiere.delete');
    
    Route::get('/ajouter-matiere-premiere', 'MatierePremiereController@addSingleView')->name('add.single.matiere.view');
    
    Route::post('/ajouter-matiere-premiere', 'MatierePremiereController@addSingle')->name('post.add.single.matiere');
    
    /**-------------------FIN MATIERE CONTROLLER----------------------*/
    
    /**-------------------FORMULE CONTROLLER----------------------*/
    
    Route::get('/formules', 'FormuleController@index')->name('formule');
    
    Route::get('/ajouter-formule', 'FormuleController@addSingleView')->name('add.single.formule.view');
    
    Route::post('/ajouter-formule', 'FormuleController@addSingle')->name('post.add.single.formule');
    
    Route::get('/formule/modifier/{formule}', 'FormuleController@editSingle')->name('formule.single.edit');
    
    Route::post('/formule/modifier/{formule}', 'FormuleController@updateSingle')->name('formule.single.update');
    
    Route::get('/formule/supprimer/{formule}', 'FormuleController@showDeleteSingle')->name('formule.single.delete.show');
    
    Route::delete('/formule/supprimer/{formule}', 'FormuleController@deleteSingle')->name('formule.single.delete');
    
    Route::get('/formule/{formule}', 'FormuleController@show')->name('formule.show');
    
    Route::post('/formule/produit', 'FormuleController@create')->name('formule.create');
    
    Route::get('/formule/produit/{formuleProduit}', 'FormuleController@edit')->name('formule.edit');
    
    Route::post('/formule/produit/update/{formuleProduit}', 'FormuleController@update')->name('formule.update');
    
    Route::delete('/formule/produit/delete/{formuleProduit}', 'FormuleController@destroy')->name('formule.destroy');
    
    /**-------------------FIN FORMULE CONTROLLER----------------------*/
    
    
    /**-------------------COMMANDE CONTROLLER----------------------*/
    
    Route::get('/commandes', 'CommandeController@index')->name('commande');
    
    Route::post('/ajouter-commande', 'CommandeController@addSingle')->name('post.add.single.commande');
    
    Route::get('/commande/modifier/{commande}', 'CommandeController@editSingle')->name('commande.single.edit');
    
    Route::post('/commande/modifier/{commande}', 'CommandeController@updateSingle')->name('commande.single.update');
    
    Route::get('/commande/supprimer/{commande}', 'CommandeController@showDeleteSingle')->name('commande.single.delete.show');
    
    Route::delete('/commande/supprimer/{commande}', 'CommandeController@deleteSingle')->name('commande.single.delete');
    
    Route::get('/commande/{commande}', 'CommandeController@show')->name('commande.show');
    
    Route::post('/commande/produit', 'CommandeController@create')->name('commande.create');
    
    Route::get('/commande/produit/{produit}', 'CommandeController@edit')->name('commande.edit');
    
    Route::post('/commande/produit/update/{produit}', 'CommandeController@update')->name('commande.update');
    
    Route::get('/commande/produit/supprimer/{produit}', 'CommandeController@showDeleteProduit')->name('commande.produit.delete.show');
    
    Route::delete('/commande/produit/supprimer/{produit}', 'CommandeController@deleteProduit')->name('commande.produit.delete');
    
    /**------------------------------*/ //A EDITER

    Route::post('/commande/produit/casse', 'CommandeController@updateCasse')->name('commande.casse.update');
    
    Route::get('/commande/produit/production/{produit}', 'CommandeController@showProduit')->name('commande.produit.show');
    
    Route::post('/commande/produit/production', 'CommandeController@createProduit')->name('commande.produit.create');
    
    Route::get('/commande/produit/modifier/production/{production}', 'CommandeController@editProduit')->name('commande.produit.edit');
    
    Route::post('/commande/produit/production/update/{production}', 'CommandeController@updateProduit')->name('commande.produit.update');
    
    Route::get('/commande/produit/supprimer/production/{production}', 'CommandeController@showDeleteProduction')->name('commande.production.delete.show');
    
    Route::delete('/commande/produit/supprimer/production/{production}', 'CommandeController@deleteProduction')->name('commande.production.delete');
    
    /**-------------------FIN COMMANDE CONTROLLER----------------------*/
    
    /**------------------LIVRAISON CONTROLLER-------------------------*/
    
    Route::post('/livraison', 'LivraisonController@create')->name('livraison.create');
    
    Route::get('/livraison/modifier/{livraison}', 'LivraisonController@edit')->name('livraison.edit');
    
    Route::post('/livraison/update/{livraison}', 'LivraisonController@update')->name('livraison.update');
    
    Route::get('/livraison/supprimer/{livraison}', 'LivraisonController@showDelete')->name('livraison.delete.show');
    
    Route::delete('/livraison/supprimer/{livraison}', 'LivraisonController@delete')->name('livraison.delete');
    
    /**------------------FIN LIVRAISON CONTROLLER-------------------------*/
    
    Route::get('/calcul/revient/production', 'CommandeController@calculeRevient');
    
});

