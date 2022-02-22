<?php

namespace App\Http\Controllers;

use App\Formule;
use App\Produit;
use App\Commande;
use App\Livraison;
use App\Reduction;
use Carbon\Carbon;
use App\Production;
use App\TypeReduction;
use Illuminate\Http\Request;

class CommandeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $commandes = Commande::all();

        $active_commande_index = 'active';

        /*alertify()->success('Updated record successfully')->delay(3000)->clickToClose()->position('bottom right');*/

        return view('admin.commande.commande', compact('active_commande_index', 'commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $verb = $request->all();

        $verb['montant'] = $verb['quantite'] * $verb['pu_vente'];

        $formules = Formule::find($verb["formule_id"]);
        $verb['cout_essence'] = $formules->cout_essence;
        $verb['cout_salarial'] = $formules->cout_salarial;
        $verb['cout_livraison'] = $formules->cout_livraison;

        $produit = Produit::create($verb);

        // ajoute d'un remise s'il y en a.
        if(isset($verb["remise"]) === true && doubleval($verb["remise"]) > 0){
            $this->mettre_remise($verb, $produit);
        }

        $string = $produit->name.' ajouté avec succès.';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    public function updateCasse (Request $request){
        $verb = $request->all();
        $production = Production::where("produit_id", $verb["produit_id"])->orderBy('id', "desc")->get()[0];
        $verb["nombre_casse"] = $verb["nombre_casse"] + $production->nombre_casse;
        $verb["quantite"] = $production->quantite;
        $verb["nombre_cycle"] = $production->nombre_cycle;
        
        $verb['revient'] = Production::calculeRevient($verb);
        $production->update($verb);

        alertify()->success("Le nombre des casses a été modifié")->delay(5000)->clickToClose()->position('bottom right');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createProduit(Request $request)
    {
        $verb = $request->all();

        $verb['date_production'] = Carbon::createFromFormat('d/m/Y', $verb['date_production'])->format('Y-m-d');
        $verb['date_available'] = Carbon::parse($verb['date_production'])->addHours($verb['date_available'])->toDateTimeString();

        $produit = Produit::find($verb['produit_id']);
        $matieres_besoins = $produit->variations();
        
        foreach ($matieres_besoins as $matiere){
            $matiere->besoin = $matiere->valeur * $verb['nombre_cycle'];
            $matiere->dispo = $matiere->matiere->stockDisponible();
        }
        
        $matiere_indisponiles = $matieres_besoins->filter(function ($value, $key) {
            return $value->dispo < $value->besoin;
        })->flatten();
        
        if (!$matiere_indisponiles->isEmpty()){
            foreach ($matiere_indisponiles as $indisponile){
                alertify()->error("Stock de ".$indisponile->matiere->name." insuffisant.")->persistent()->clickToClose()->position('bottom right');
            }
            return redirect()->back();
        }
        
        $revient = 0;
        
        foreach ($matieres_besoins as $matiere){
            $matiere->matiere->reduceStock($matiere->besoin);
            //Calcul du revient
            $revient += $matiere->valeur * $matiere->matiere->prixCourant();
            
        }
        

        $verb['revient'] = Production::calculeRevient($verb);

      

        $production = Production::create($verb);

        $string = $produit->name.' ajouté avec succès.';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Add single ressource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSingle(Request $request)
    {
        $verb = $request->all();

        $verb['numero_bc'] = strtoupper($verb['numero_bc']);

        $verb['date_livraison'] = Carbon::createFromFormat('d/m/Y', $verb['date_livraison'])->format('Y-m-d');
        $verb['date_paiement'] = Carbon::createFromFormat('d/m/Y', $verb['date_paiement'])->format('Y-m-d');

        $commande = Commande::create($verb);

        $string = 'Commande '.$commande->numero_bc.' ajouté avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commande  $commande
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Commande $commande)
    {
        $active_commande_index = 'active';

        if (!$commande){
            abort(404);
        }

        $produits = $commande->produits;

        $formules = Formule::whereHas('variations')->get();

        //return response()->json($produits[0]->variations());

        return view('admin.commande.produit', compact('active_commande_index', 'commande', 'produits', 'formules'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showProduit(Produit $produit)
    {
        $active_commande_index = 'active';

        if (!$produit){
            abort(404);
        }

        $productions = $produit->productions;

        $variations = $produit->variations();

        $formule = $produit->formule;

        $commande = $produit->commande;

        $reste = $produit->quantite - $produit->quantiteProduit();

        $livraisons = $produit->livraisons;

        return view('admin.commande.production', compact('active_commande_index', 'commande', 'produit', 'formule', 'productions', 'variations', 'reste', 'livraisons'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commande  $commande
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editSingle(Commande $commande)
    {
       
        return view('admin.commande.modal.commande.edit', compact('commande'));
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\Commande  $commande
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDeleteSingle(Commande $commande)
    {
        return view('admin.commande.modal.commande.delete', compact('commande'));
    }

    /**
     * Deleting the specified resource.
     *
     * @param  \App\Commande  $commande
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSingle(Commande $commande)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $numeroBC = $commande->numero_bc;

        $produits = $commande->produits;

        foreach ($produits as $produit) {

            $productions = $produit->productions;

            $matieres_besoins = $produit->variations();

            foreach ($productions as $production){
                foreach ($matieres_besoins as $matiere){
                    $matiere->besoin = $matiere->valeur * $production->nombre_cycle;
                    $matiere->matiere->recoverStock($matiere->besoin);
                }
            }

        }

        $commande->delete();

        $string = 'Commande BC n° '.$numeroBC.' supprimée avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Produit $produit)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $reduction = Reduction::where("produit_id", $produit->id)->get();

        return view('admin.commande.modal.produit.edit', compact('produit', 'reduction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Production  $production
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editProduit(Production $production)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        return view('admin.commande.modal.production.edit', compact('production'));
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDeleteProduit(Produit $produit)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        return view('admin.commande.modal.produit.delete', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Production  $production
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDeleteProduction(Production $production)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        return view('admin.commande.modal.production.delete', compact('production'));
    }

    /**
     * Deleting the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduit(Produit $produit){
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $name = $produit->name;

        $productions = $produit->productions;

        $matieres_besoins = $produit->variations();

        foreach ($productions as $production){
            foreach ($matieres_besoins as $matiere){
                $matiere->besoin = $matiere->valeur * $production->nombre_cycle;
                $matiere->matiere->recoverStock($matiere->besoin);
            }
        }

        Reduction::where("produit_id", $produit->id)->delete();

        $produit->delete();

        $string = 'Produit '.$name.' supprimée avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Deleting the specified resource.
     *
     * @param  \App\Production  $production
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduction(Production $production){
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $name = $production->produit->name;
        $nombre = $production->quantite;

        $matieres_besoins = $production->produit->variations();

        foreach ($matieres_besoins as $matiere){
            $matiere->besoin = $matiere->valeur * $production->nombre_cycle;
            $matiere->matiere->recoverStock($matiere->besoin);
        }

        $production->delete();

        $string = $nombre.' '.$name.' supprimée avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commande  $commande
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSingle(Request $request, Commande $commande)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }

        $verb = $request->all();

        $verb['date_livraison'] = Carbon::createFromFormat('d/m/Y', $verb['date_livraison'])->format('Y-m-d');
        $verb['date_paiement'] = Carbon::createFromFormat('d/m/Y', $verb['date_paiement'])->format('Y-m-d');

        $commande->update($verb);
                
        $string = 'Mis à jour avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Produit $produit)
    {
        $verb = $request->all();

        $verb['montant'] = $verb['quantite'] * $verb['pu_vente'];

        $formules = Formule::find($produit->formule_id);
        $verb['cout_essence'] = $formules->cout_essence;
        $verb['cout_salarial'] = $formules->cout_salarial;
        $verb['cout_livraison'] = $formules->cout_livraison;

        $produit->update($verb);

        $reduction = Reduction::where("produit_id", $produit->id)->delete();
      
        // ajoute d'un remise s'il y en a.
        if(isset($verb["remise"]) === true && doubleval($verb["remise"]) > 0){
            
            $this->mettre_remise($verb, $produit);
        }
        $string = 'Mis à jour avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Production  $production
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduit(Request $request, Production $production)
    {
        
        $verb = $request->all();
        
        $verb['date_production'] = Carbon::createFromFormat('d/m/Y', $verb['date_production'])->format('Y-m-d');
        $verb['date_available'] = Carbon::parse($verb['date_production'])->addHours($verb['date_available'])->toDateTimeString();
        $verb["produit_id"] = $production->produit_id;
        $verb["nombre_cycle"] = $production->nombre_casse;
        $verb["quantite"] = $production->quantite;
        $verb["nombre_cycle"] = $production->nombre_cycle;
        
        $verb['revient'] = Production::calculeRevient($verb);
        //dd($production->revient, $verb['quantite'], $production->quantite, $verb['revient']);

        $production->update($verb);

        $string = 'Mis à jour avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        //
    }

    public function calculeRevient(){

        $productions = Production::all();

        foreach ($productions as $production){

            $matieres_besoins = $production->produit->variations();

            $revient = 0;

            foreach ($matieres_besoins as $matiere){
                //Calcul du revient
                $revient += $matiere->valeur * $matiere->matiere->prixCourant();

            }

            $production->revient = round(($revient * $production->nombre_cycle)/$production->quantite, 2);

            $production->save();
        }


    }

    public function mettre_remise($verb, $produit){
        $type_reduction = TypeReduction::where("name", "Rémise")->get();
        
        Reduction::create(["produit_id" => $produit->id,
                            "type_reduction_id" => $type_reduction[0]->id ,
                            "valeur" => doubleval($verb["remise"]),
                            "is_percent" => (isset($verb["is_percent"]) === true && $verb["is_percent"] == true ? true : false) ]);
    }
}
