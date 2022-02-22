<?php

namespace App\Http\Controllers;

use App\Loyer;
use App\Depense;
use App\Salarie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DepenseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application depense.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($tabActive = "depense")
    {
        $depenses = Depense::all();
        $loyers = Loyer::orderBy("id", "desc")->get();

        $types = ['Charge salariale mensuelle', 'Charge locative', 'Charge de maintenance machine',
            'Dépenses divers', 'Agios', 'Carburant par semaine'];

        $active_depense_index = 'active';

        return view('admin.depense.depense', compact('active_depense_index', 'depenses', 'types', 'loyers', 'tabActive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $verb = $request->except(["salaire"]);

        $verb['quantite'] = ( !isset($verb['quantite']) || intval($verb['quantite']) == 0 ) ? 1 : $verb['quantite'];
        $verb['pu'] = ( !isset($verb['pu']) || intval($verb['pu']) == 0 ) ? 1 : $verb['pu'];

        $salaire = json_decode($request->input('salaire'));

        if(!is_object($salaire) || count($salaire) < 1){

            $verb['montant'] = ($verb['quantite'] * $verb['pu']) + $verb['frais_livraison'];
    
            $verb['numero_bl'] = strtoupper($verb['numero_bl']);
    
            if ($verb['mode_paiement'] == 'credit'){
    
                $verb['montant'] = $verb['montant'] + $verb['montant_credit'];
    
                $verb['date_credit'] = Carbon::createFromFormat('d/m/Y', $verb['date_credit'])->format('Y-m-d');
            }
        }

        $depense = Depense::create($verb);

        $this->storeSalarie($salaire , $depense);

        return redirect()->route('depense');

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
     * @param  \App\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Depense  $depense
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Depense $depense)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $types = ['Charge salariale mensuelle', 'Charge locative', 'Charge de maintenance machine',
            'Dépenses divers', 'Agios', 'Carburant par semaine'];
        return view('admin.depense.modal.edit', compact('depense', 'types'));
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param \App\Depense  $depense
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDelete(Depense $depense)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        return view('admin.depense.modal.delete', compact('depense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Depense  $depense
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Depense $depense)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }

        $verb = $request->except(["salaire"]);

        $verb['quantite'] = ( !isset($verb['quantite']) || intval($verb['quantite']) == 0 ) ? 1 : $verb['quantite'];
        $verb['pu'] = ( !isset($verb['pu']) || intval($verb['pu']) == 0 ) ? 1 : $verb['pu'];

        $salaire = json_decode($request->input('salaire'));


        $verb['montant'] = ($verb['quantite'] * $verb['pu']) + $verb['frais_livraison'];

        if ($verb['mode_paiement'] == 'credit'){

            $verb['montant'] = $verb['montant'] + $verb['montant_credit'];

            $verb['date_credit'] = Carbon::createFromFormat('d/m/Y', $verb['date_credit'])->format('Y-m-d');

        }else{

            $verb['montant_credit'] = 0;
            $verb['date_credit'] = null;

        }
        $depense->update($verb);

        Salarie::where("depense_id" , "=" , $depense->id)->delete();

        $this->storeSalarie($salaire , $depense);
        $string = "Depense ".ucwords( $verb['name']).' modifié avec succès';
        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Depense  $depense
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Depense $depense)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }

        $name = $depense->name;
        Salarie::where("depense_id" , "=" , $depense->id)->delete();
        $depense->delete();

        $string = 'Depense '.$name.' supprimé avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depense $depense)
    {
        //
    }

    private function storeSalarie($salaire , $depense){
        if(isset($salaire) && count($salaire) > 0){
            $montant = 0;
            foreach ($salaire as $key => $value) {
                if(isset($value->salarie_nom) && strlen($value->salarie_nom) > 0
                && isset($value->salarie_montant)  && strlen($value->salarie_nom) > 0 ){

                    $salarie = new Salarie();
                    $salarie->depense_id = $depense->id;
                    $salarie->nom = ucwords($value->salarie_nom);
                    $salarie->montant = $value->salarie_montant;
                    $montant += $salarie->montant;
                    $salarie->save();
                }
            }
            $depense->quantite = 1;
            $depense->pu = $montant;
            $depense->montant = $montant;
            $depense->save();
        }
    }

    public function createLoyer(Request $request){
        $data = $request->all();
        $montant = $data['montant'];
        $date = explode("-", $data['date']);
        if(doubleval($montant) > 0 && intval($date[0]) > 0 && intval($date[0]) < 13 && intval($date[1]) > 0 ){
            $date_debut = date("Y-m-d", strtotime("01-".$date[0]."-".$date[1]));
            Loyer::create(["montant" =>  $montant , "date_debut" => $date_debut]);
            
            alertify()->success("Un nouveau loyer dont le montant vaut '".$montant." Ar' vient d'être ajouté")->delay(5000)->clickToClose()->position('bottom right');;
        }else{
            alertify()->error("Echec de l'ajout d'un nouveau loyer")->delay(5000)->clickToClose()->position('bottom right');;
        }
        
       return redirect()->route('depense', ['tabActive' => 'loyer']);
    }

    public function loyerModifier(Loyer $loyer){

        return view("admin.depense.modal.loyerModifier", compact('loyer'));
    }

    public function loyerUpdate(Request $request, Loyer $loyer){
        $loyers = $request->all();
        if(doubleval($loyers["montant"]) > 0 ){
            $loyer->montant = $loyers["montant"];
            $loyer->update();
            
            alertify()->success("Le loyer a bien été mis à jour")->delay(5000)->clickToClose()->position('bottom right');;
        }else{
            alertify()->error("Echec de mise à jour d'un loyer")->delay(5000)->clickToClose()->position('bottom right');;
        }
        return redirect()->route('depense', ['tabActive' => 'loyer']);
    }

    public function loyerSupprimer(Loyer $loyer){
        return view("admin.depense.modal.loyerSupprimer", compact('loyer'));
    }

    public function loyerDelete(Request $request, Loyer $loyer){
            $loyer->delete();
            
            alertify()->success("Le loyer a bien été mis à jour")->delay(5000)->clickToClose()->position('bottom right');
        return redirect()->route('depense', ['tabActive' => 'loyer']);
    }
}
