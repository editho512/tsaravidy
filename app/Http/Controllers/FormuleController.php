<?php

namespace App\Http\Controllers;

use App\Formule;
use App\FormuleProduit;
use App\Matiere;
use Illuminate\Http\Request;

class FormuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $formules = Formule::all();

        $active_formule_index = 'active';

        /*alertify()->success('Updated record successfully')->delay(3000)->clickToClose()->position('bottom right');*/

        return view('admin.formule.formule', compact('active_formule_index', 'formules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $verb = $request->all();

        $matiere = Matiere::find($verb['matiere_id']);

        if (FormuleProduit::findMatiere($verb['formule_id'], $verb['matiere_id'])){

            $string = $matiere->name.' existe déjà.';

            alertify()->error($string)->delay(5000)->clickToClose()->position('bottom right');

            return redirect()->back();
        }

        FormuleProduit::create($verb);

        $string = $matiere->name.' ajouté avec succès.';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Add ressource in storage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addSingleView(Request $request)
    {
        $active_formule_single_add = 'active';
        return view('admin.formule.ajout-formule', compact('active_formule_single_add'));
    }

    /**
     * Add single ressource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSingle(Request $request)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }

        $verb = $request->all();

        if (Formule::findDesignation($request->name)){
            $string = $request->name.' existe déjà.';
            alertify()->error($string)->delay(5000)->clickToClose()->position('bottom right');
            return redirect()->back();
        }

        $formule = Formule::create($verb);

        $string = $formule->name.' ajouté avec succès';

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
     * @param  \App\Formule  $formule
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Formule $formule)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }

        $active_formule_index = 'active';

        if (!$formule){
            abort(404);
        }

        $variations = $formule->variations;

        $matieres = Matiere::all();

        return view('admin.formule.formule-produit', compact('active_formule_index', 'formule', 'variations', 'matieres'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Formule  $formule
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editSingle(Formule $formule)
    {
        return view('admin.formule.modal.formule.edit', compact('formule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormuleProduit  $formuleProduit
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(FormuleProduit $formuleProduit)
    {
        return view('admin.formule.modal.formuleproduit.edit', compact('formuleProduit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Formule  $formule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSingle(Request $request, Formule $formule)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        
        $verb = $request->all();

        $formule->update($verb);

        $string = 'Mis à jour avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormuleProduit  $formuleProduit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, FormuleProduit $formuleProduit)
    {
        $verb = $request->all();

        $formuleProduit->update($verb);

        $string = 'Mis à jour avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\Formule  $formule
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDeleteSingle(Formule $formule)
    {
        return view('admin.formule.modal.formule.delete', compact('formule'));
    }

    /**
     * Deleting the specified resource in storage.
     *
     * @param  \App\Formule  $formule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSingle(Formule $formule)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }

        $name = $formule->name;

        $formule->delete();

        $string = 'Formule '.$name.' supprimé avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormuleProduit  $formuleProduit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(FormuleProduit $formuleProduit)
    {

        if (!$formuleProduit){
            abort(404);
        }

        $formuleProduit->delete();

        $string = 'Suppression avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }
}
