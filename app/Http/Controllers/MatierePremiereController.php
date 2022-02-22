<?php

namespace App\Http\Controllers;

use App\Matiere;
use App\MatierePremiere;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MatierePremiereController extends Controller
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
        $matieres = Matiere::all();

        $active_matiere_index = 'active';

        /*alertify()->success('Updated record successfully')->delay(3000)->clickToClose()->position('bottom right');*/

        return view('admin.matiere.matiere', compact('active_matiere_index', 'matieres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $verb = $request->all();

        $verb['montant'] = ($verb['quantite'] * $verb['pu']) + $verb['frais_livraison'];

        $verb['numero_bl'] = strtoupper($verb['numero_bl']);
        $verb['quantite_dispo'] = $verb['quantite'];

        if ($verb['mode_paiement'] == 'credit'){

            $verb['montant'] = $verb['montant'] + $verb['montant_credit'];

            $verb['date_credit'] = Carbon::createFromFormat('d/m/Y', $verb['date_credit'])->format('Y-m-d');
        }

        MatierePremiere::create($verb);

        $string = $verb['name'].' ajouté avec succès.';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showMatiere()
    {
        //
    }

    /**
     * Add ressource in storage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addSingleView(Request $request)
    {
        $active_matiere_single_add = 'active';
        return view('admin.matiere.ajout-matiere', compact('active_matiere_single_add'));
    }

    /**
     * Add single ressource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSingle(Request $request)
    {
        $verb = $request->all();

        if (Matiere::findDesignation($request->name)){
            $string = $request->name.' existe déjà.';
            alertify()->error($string)->delay(5000)->clickToClose()->position('bottom right');
            return redirect()->back();
        }

        $matiere = Matiere::create($verb);

        $string = $matiere->name.' ajouté avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();

    }

    /**
     * Add ressource in storage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add()
    {
        //
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
     * @param  \App\MatierePremiere  $matierePremiere
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Matiere $matiere)
    {
        $active_matiere_index = 'active';

        if (!$matiere){
            abort(404);
        }

        $stocks = $matiere->stocks;

        $all_quantite_dispo = $matiere->stockDisponible();

        return view('admin.matiere.matiere-premiere', compact('active_matiere_index', 'matiere', 'stocks', 'all_quantite_dispo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MatierePremiere  $matiere
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editSingle(Matiere $matiere)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        return view('admin.matiere.modal.edit', compact('matiere'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MatierePremiere  $matierePremiere
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(MatierePremiere $matierePremiere)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        return view('admin.matiere.modal.matiere-premiere.edit', compact('matierePremiere'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MatierePremiere  $matierePremiere
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, MatierePremiere $matierePremiere)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $verb = $request->all();

        $verb['montant'] = ($verb['quantite'] * $verb['pu']) + $verb['frais_livraison'];

        $verb['numero_bl'] = strtoupper($verb['numero_bl']);

        if ($verb['mode_paiement'] == 'credit'){

            $verb['montant'] = $verb['montant'] + $verb['montant_credit'];

            $verb['date_credit'] = Carbon::createFromFormat('d/m/Y', $verb['date_credit'])->format('Y-m-d');

        }else{

            $verb['montant_credit'] = 0;
            $verb['date_credit'] = null;

        }

        $matierePremiere->update($verb);

        $string = 'Mis à jour avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Add single ressource in storage.
     * @param  \App\Matiere  $matiere
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSingle(Request $request, Matiere $matiere)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $verb = $request->all();

        if ($request->name != $matiere->name && Matiere::findDesignation($request->name)){
            $string = $request->name.' existe déjà.';
            alertify()->error($string)->delay(5000)->clickToClose()->position('bottom right');
            return redirect()->back();
        }

        $matiere->update($verb);

        $string = $matiere->name.' modifié avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();

    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\MatierePremiere  $matiere
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDeleteSingle(Matiere $matiere)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        return view('admin.matiere.modal.delete', compact('matiere'));
    }

    /**
     * Function Deleting the specified resource.
     *
     * @param  \App\MatierePremiere  $matiere
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSingle(Matiere $matiere)
    {

        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $name = $matiere->name;

        $matiere->delete();

        $string = $name.' supprimé avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\MatierePremiere  $matierePremiere
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDelete(MatierePremiere $matierePremiere)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        return view('admin.matiere.modal.matiere-premiere.delete', compact('matierePremiere'));
    }

    /**
     * Function Deleting the specified resource.
     *
     * @param  \App\MatierePremiere  $matierePremiere
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(MatierePremiere $matierePremiere)
    {

        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        
        $name = $matierePremiere->matiere->name;
        $bl = $matierePremiere->numero_bl;

        $matierePremiere->delete();

        $string = $name.' BL n°'.$bl.' supprimé avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MatierePremiere  $matierePremiere
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatierePremiere $matierePremiere)
    {
        //
    }
}
