<?php

namespace App\Http\Controllers;

use App\Produit;
use App\Commande;
use App\Livraison;
use App\Reduction;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Information;
use Illuminate\Http\Request;


class LivraisonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $active_livraison_index = 'active';

        $livraisons = Livraison::join("produits","produits.id", "=", "livraisons.produit_id")
                                ->join("commandes", "commandes.id", "=", "produits.commande_id")
                                ->groupBy("livraisons.numero_bl")
                                ->orderBy("livraisons.id", "ASC")
                                ->get(["livraisons.id", "livraisons.numero_bl", "commandes.user", "commandes.numero_bc", "livraisons.date_livraison"]);
        
        $commandes = Commande::all();
        
        $info = Information::orderBy('id', 'desc')->first();
        return view('admin.livraison.livraison', compact('active_livraison_index', 'livraisons', 'commandes', 'info'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $verb = $request->all();

        $produit = Produit::find($request->produit_id);

        if ($request->quantite > $produit->quantiteDisponible()){
            $string = 'Erreur, la quantité doit être inférieur ou égale à '.$produit->quantiteDisponible();
            alertify()->error($string)->delay(5000)->clickToClose()->position('bottom right');
            return redirect()->back();
        }

        $verb['date_livraison'] = Carbon::createFromFormat('d/m/Y', $verb['date_livraison'])->format('Y-m-d');
       
        $livraison = Livraison::create($verb);
        $string = 'Livraison n° '.$livraison->numero_bl.' ajouté avec succès.';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Livraison  $livraison
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Livraison $livraison)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $produit = Produit::find($livraison->produit_id);
        return view('admin.commande.modal.livraison.edit', compact('livraison', 'produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Livraison  $livraison
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Livraison $livraison)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $verb = $request->all();

        $produit = Produit::find($livraison->produit_id);

        if ($request->quantite > ($produit->quantiteDisponible()+$livraison->quantite)){
            $string = 'Erreur, la quantité doit être inférieur ou égale à '.($produit->quantiteDisponible()+$livraison->quantite);
            alertify()->error($string)->delay(5000)->clickToClose()->position('bottom right');
            return redirect()->back();
        }

        $verb['date_livraison'] = Carbon::createFromFormat('d/m/Y', $verb['date_livraison'])->format('Y-m-d');

        $livraison->update($verb);

        $string = 'Mis à jour avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\Livraison  $livraison
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDelete(Livraison $livraison)
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $produit = Produit::find($livraison->produit_id);
        return view('admin.commande.modal.livraison.delete', compact('livraison', 'produit'));
    }

    /**
     * Deleting the specified resource.
     *
     * @param  \App\Livraison $livraison
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Livraison $livraison){
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }
        $numero_bl = $livraison->numero_bl;

        $livraison->delete();

        $string = 'Livraison n° '.$numero_bl.' supprimée avec succès';

        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    public function commande(Commande $commande){
        $produits = Produit::where("produits.commande_id", "=", $commande->id)->get();
        $livree = Livraison::whereIn("livraisons.produit_id", $produits->pluck("id"))->get();

       
        
        foreach ($produits as $key_pro => $prod) {
            foreach ($livree as $key_liv => $liv) {
                if($prod->id == $liv->produit_id){
                    $produits[$key_pro]->quantite -= doubleval($liv->quantite);
                }
            }
            $produit = Produit::find($prod->id);
            $produits[$key_pro]->dispo = $produit->quantiteDisponible();
        }

        $data = view("admin.livraison.modal.bodyForm", compact("produits"))->render();
        return response()->json(["commande" => $commande, "data" => $data]);

    }

    public function ajouter(Request $request){
        $post = $request->all();
        
        if(isset($post["content"]) === true && count($post["content"]) > 0){
            $success = collect();
            $verb = [
                'numero_bl' => $post['title']['numero_bl'],
                'commentaire' => $post['title']['commentaire'],
                'date_livraison' => date("Y-m-d", strtotime($post['title']['date_livraison']))
                ] ;
                
               // dd($verb);
            foreach ($post["content"] as $key => $value) {
                $produit = Produit::find($value["id"]);
                if(isset($value["value"]) === true && doubleval($value["value"]) > 0 && $produit->quantiteDisponible() >= doubleval($value["value"])){
                    $verb['produit_id'] = $value["id"];
                    $verb['quantite'] = $value["value"];
                    $livraison = Livraison::create($verb);
                    $success->push($livraison);
                }
            }
            if($success->count() > 0){
                $infos = Information::where("adresse", $post['title']['adresse'])
                                    ->where("telephone", $post['title']['phone'])
                                    ->where("email", $post['title']['email'])
                                    ->where("nif", $post['title']['nif'])
                                    ->where("stat", $post['title']['stat'])
                                    ->where("rcs", $post['title']['rcs'])
                                    ->get();

                if($infos->count() == 0){

                    $infos =  Information::create(
                                ["adresse" => $post['title']['adresse'],
                                "telephone" => $post['title']['phone'],
                                "email" => $post['title']['email'],
                                "nif" => $post['title']['nif'],
                                "stat" => $post['title']['stat'],
                                "rcs" => $post['title']['rcs']
    
                            ]);
                }else{
                    $infos = $infos[0];
                }
                
                Livraison::whereIn("livraisons.id", $success->pluck("id"))->update(['information_id' => $infos->id ]); 

                //alertify()->success("Livraison ". $livraison->numero_bl ." ajouté")->delay(5000)->clickToClose()->position('bottom right');

                $res = ["url" => route('livraison.bon_livraison', ['livraison' => $livraison->id ]),
                         "download" => route('livraison.download', ['livraison' => $livraison->id ])
                        ];
                return response()->json($res);
            }
        }
       
        return 0;

    }


    public function voir_bon_livraison(Livraison $livraison){
        return $this->bon_livraison($livraison);
    }

    public function download_bon_livraison(Livraison $livraison){

        $view = $this->bon_livraison($livraison, true);

        // reference the Dompdf namespace

        // instantiate and use the dompdf class
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);        

        $dompdf->loadHtml($view->render());

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($livraison->numero_bl."_Bon_de_commande"."pdf");
    }

    private function bon_livraison($livraison, $pdf = false){
        
        $infos = Information::where("id", $livraison->information_id)->get();
        $info = $infos->count() > 0 ? $infos[0] : collect();

        $livraisons = Livraison::join("produits", "produits.id", "=", "livraisons.produit_id")->where("livraisons.numero_bl", $livraison->numero_bl)
                                ->get(['produits.name' , 'livraisons.quantite' ,'produits.pu_vente' , 'livraisons.numero_bl' , 'livraisons.date_livraison' , 'livraisons.produit_id']);

        $reduction = Reduction::whereIn("reductions.produit_id", $livraisons->pluck("produit_id"))->get();

        $client = Produit::join("commandes", "commandes.id", "=", "produits.commande_id")->where("produits.id", $livraison->produit_id)->get();


        return view('admin.livraison.modal.bon_livraison'.($pdf === true ? "_pdf" : ""), compact('livraisons', 'info' ,'client', 'reduction'));
    }

    public function modifier_bon_livraison(Livraison $livraison){

        return $this->livraison_modif($livraison);
    }

    public function supprimer_livraison(Livraison $livraison){
        $other = Livraison::where("numero_bl", $livraison->numero_bl)->get();

        $livraison->delete();

        if($other->count() > 1){
            return $this->livraison_modif($livraison);

        }else{

            $info = Information::orderBy('id', 'desc')->first();

            $commande_id = Produit::where("id", $other[0]->produit_id)->get()[0]->commande_id;

            $commandes = Commande::all();

            $produits = Produit::where("produits.commande_id", "=", $commande_id)->get();

            foreach ($produits as $key => $value) {
                $produits[$key]->dispo = $value->quantiteDisponible();
            }


            $livraisons = collect();

            $info->numero_bl = $other[0]->numero_bl;
            //$livraisons->push($other);
            $reduction = Reduction::whereIn("reductions.produit_id", $other->pluck("produit_id"))->get();

            $disabled = false;

            return view('admin.livraison.modal.modifier_bon_livraison', compact('livraison', 'info', 'commande_id', 'commandes', 'produits', 'livraisons', 'reduction', 'disabled'));
        }
    }

    private function livraison_modif($livraison, $disabled = false){

        $info = Information::orderBy('id', 'desc')->first();

        $commande_id = Produit::where("id", $livraison->produit_id)->get()[0]->commande_id;

        if($livraison->information_id != null){
            $info = Information::where('id', $livraison->information_id )->get()[0];
        }

        $commandes = Commande::all();

        $livraisons = Livraison::where("numero_bl", $livraison->numero_bl)->get();

       
        $produits = Produit::where("produits.commande_id", "=", $commande_id)->get();
        $livree = Livraison::whereIn("livraisons.produit_id", $produits->pluck("id"))->get();

        $reduction = Reduction::whereIn("reductions.produit_id", $livraisons->pluck("produit_id"))->get();
        foreach ($produits as $key_pro => $prod) {
            $produit = Produit::find($prod->id);
            $produits[$key_pro]->dispo = $produit->quantiteDisponible();

            foreach ($livree as $key_liv => $liv) {
                if($prod->id == $liv->produit_id && $prod->id == $livraison->produit_id){

                    $produits[$key_pro]->quantite -= doubleval($liv->quantite);
                   // $produits[$key_pro]->dispo += doubleval($liv->quantite);

                }
            }
        }

       
        return view('admin.livraison.modal.modifier_bon_livraison', compact('livraison', 'info', 'commande_id', 'commandes', 'produits', 'livraisons', 'reduction', 'disabled'));
    
    }

    public function supprimer_bon_livraison(Livraison $livraison){
        return $this->livraison_modif($livraison, true);
    }

    public function modifier(Request $request){
        
        $post = $request->all();
        
        if(isset($post["content"]) === true && count($post["content"]) > 0){
            $success = collect();
            $verb = [
                'numero_bl' => $post['title']['numero_bl'],
                'commentaire' => $post['title']['commentaire'],
                'date_livraison' => date("Y-m-d", strtotime($post['title']['date_livraison']))
                ] ;
                
                Livraison::where("numero_bl", $verb['numero_bl'])->delete();
            foreach ($post["content"] as $key => $value) {
                if(isset($value["value"]) === true && doubleval($value["value"]) > 0){
                    $produit = Produit::find($value["id"]);
                    $verb['produit_id'] = $value["id"];
                    $verb['quantite'] = $value["value"];
                    $livraison = Livraison::create($verb);
                    $success->push($livraison);
                }
            }
            if($success->count() > 0){
                $infos = Information::where("adresse", $post['title']['adresse'])
                                    ->where("telephone", $post['title']['phone'])
                                    ->where("email", $post['title']['email'])
                                    ->where("nif", $post['title']['nif'])
                                    ->where("stat", $post['title']['stat'])
                                    ->where("rcs", $post['title']['rcs'])
                                    ->get();

                if($infos->count() == 0){

                    $infos =  Information::create(
                                ["adresse" => $post['title']['adresse'],
                                "telephone" => $post['title']['phone'],
                                "email" => $post['title']['email'],
                                "nif" => $post['title']['nif'],
                                "stat" => $post['title']['stat'],
                                "rcs" => $post['title']['rcs']
    
                            ]);
                }else{
                    $infos = $infos[0];
                }
                
                Livraison::whereIn("livraisons.id", $success->pluck("id"))->update(['information_id' => $infos->id ]);  
                //alertify()->success("Livraison ". $post['title']['numero_bl'] ." modifié")->delay(5000)->clickToClose()->position('bottom right');

                $res = ["url" => route('livraison.bon_livraison', ['livraison' => $success->pluck("id")[0] ]),
                         "download" => route('livraison.download', ['livraison' => $success->pluck("id")[0] ])
                        ];

                return response()->json($res);
            }
        }
       
        return 0;
    }

    public function supprimer(Livraison $livraison){
        $livraisons = Livraison::where("numero_bl", $livraison->numero_bl)->delete();

        alertify()->success("Livraison ". $livraison->numero_bl ." supprimé")->delay(5000)->clickToClose()->position('bottom right');

    }

    public function delete_bon_livraison(Livraison $livraison){
        $bon_livraison = $livraison->numero_bl;

        $livraisons = Livraison::where("numero_bl", $livraison->numero_bl)->delete();
        alertify()->success("Livraison ". $bon_livraison." supprimé")->delay(5000)->clickToClose()->position('bottom right');
        
        return redirect()->back();
    }
    
}
