<?php

namespace App\Http\Controllers;

use App\User;
use App\Loyer;
use App\Depense;
use App\Formule;
use App\Matiere;
use App\Produit;
use App\Commande;
use App\Livraison;
use App\Production;
use App\FormuleProduit;
use App\MatierePremiere;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }

        $active_dashboard_index = 'active';
        //dashboard depense
        $depense = Depense::Dashboard_list();
        $depense_total = Depense::selectRaw('sum(montant) as montant_total')->first();
        $depense_periodique = Depense::Periodique_list();

        //dashboard production

        $commande = Formule::Commande_list();
        $produit =  Produit::Produit_list();
        $produit_avalaible =  Produit::Produit_list(true);
        $livraison = Livraison::Livraison_list();
        
        $productions = Production::productionPerProduct();
        $livraisons = Livraison::livraisonPerProduct();
       

        //dashboard Stock
        $quantite_dispo = Matiere::Quantite_dispo();
        $valeur_formule = FormuleProduit::valeur_formule();
        $stock_disponible = $this->stock_produit($valeur_formule, $quantite_dispo);
        $max_stock =  [ "stock" => 0 , "cycle" => 0];

        foreach ($stock_disponible as $key => $value) {
           $max_stock = $max_stock["cycle"] > $value["cycle"] ? $max_stock : [ "cycle" => $value["cycle"] , "stock" => $value["stock"] ];
        }

        //Chiffre d'affaire
        $revient = Produit::Revient_list();
   
        $chiffre_affaire = $this->chiffre_affaire($revient);

        $gain = $this->calcul_gain($revient, $chiffre_affaire);

        $first_month = date("Y-m-d", strtotime(Commande::first_month()));
        
        $Rent = $this->montantLoyer($first_month);

        $last_month = date("Y-m-d", strtotime( date("Y-m-d")));

        $days_numbers = difference_date($first_month, $last_month);
        
        $Rent *= $days_numbers;

        //Général

        $general["chiffre_affaire"] = gain_total_dashboard($chiffre_affaire, true);
        $general["gain"] =  gain_total_dashboard($gain , true, true , $Rent);
        $cout_essence_total = 0;
        $cout_salarial_total = 0;
        $cout_livraison_total = 0;
        $revient_moyen = 0;

        foreach ($revient as $key => $rev) {
            # code...
            $produit_revient = Produit::where("produits.id", $rev->produit)->get();
            $revient_moyen += $rev->quantite_produit * $produit_revient[0]->revientMoyen();
            $cout_essence_total += $produit_revient[0]->cout_essence * $rev->quantite_produit;
            $cout_salarial_total += $produit_revient[0]->cout_salarial * $rev->quantite_produit;
            $cout_livraison_total += $produit_revient[0]->cout_livraison * $rev->quantite_produit;

        }
        $general["revient_moyen"] = $revient_moyen - $cout_essence_total - $cout_salarial_total - $cout_livraison_total;
        $general["cout_essence"] = $cout_essence_total;
        $general["cout_salarial"] = $cout_salarial_total;
        $general["cout_livraison"] = $cout_livraison_total;
        $general["loyer"] = $Rent;

         return view('admin.dashboard',
                     compact('active_dashboard_index' ,
                             'depense' , 'depense_total' , 'depense_periodique' ,
                              'commande' , 'produit' , 'produit_avalaible', 'livraison',
                                'stock_disponible' , 'max_stock',
                                    'chiffre_affaire', 'gain',
                                    'productions'  , 'livraisons',
                                    'Rent' , 'general'
                                ));
    }

    public function montantLoyer($first_month ){

        $totalMonthsDiff = difference_mois($first_month);
        $totalMonthsDiff = $totalMonthsDiff <= 0 ? abs($totalMonthsDiff) + 2 : $totalMonthsDiff;
        $Rent = 0;
        for ($i = 0; $i < $totalMonthsDiff; $i++) { 
            $Rent += Loyer::monthRent($first_month) ;
            $first_month = date("Y-m-d", strtotime("+1 month", strtotime($first_month)));
            
        }
      
        $Rent = ($Rent) / ($totalMonthsDiff * 30);
       
        return $Rent;
    }

    public function production_periodique(Request $request){
        //dashboard production
        $date = request()->all();
        
        $commande = Formule::Commande_list($date);
        $produit =  Produit::Produit_list(false, $date);
        $produit_avalaible =  Produit::Produit_list(true, $date);
       
        $livraison = Livraison::Livraison_list($date);
        
        $productions = Production::productionPerProduct($date);
        $livraisons = Livraison::livraisonPerProduct($date);
        
        return response()->json([  "label" => produit_dashboard($commande , $produit, false , false ),
                                    "aProduire" =>  produit_dashboard($commande , $produit, true , false) ,
                                    "aLivrer" =>  livraison_dashboard($commande , $produit_avalaible , $livraison, false) , 
                                    "productions" => lister_chart($productions, false) , 
                                    "livraisons" => lister_chart($livraisons, false) ,
                                ]);
    }

    public function depense_periodique($debut =  0 )
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }

        $depense_periodique = Depense::Periodique_list($debut);
        
        foreach ($depense_periodique as $key => $value) {
            $value->mois = mois($value->mois);
        }
      
        return response()->json($depense_periodique);
    }

    public function depense_liste( )
    {
        $date = request()->all();
        $data = [];
       
        $total = Depense::Dashboard_total($date);
        $data["depense"]= Depense::Dashboard_list($date);
        $data["depense_total"] = isset ($total->montant_total) ? format_prix($total->montant_total) : format_prix(0);
       
        return response()->json($data);
    }

    public function gain_liste()
    {
        if (auth()->user()->cannot('viewAny', auth()->user())) {
            abort(403);
        }

        $date = request()->all();
        $data = [];
        $revient = Produit::Revient_list($date);
      
        $data["chiffre_affaire"] = $this->chiffre_affaire($revient);

        $data["total_chiffre_affarie"] =  gain_total_dashboard($data["chiffre_affaire"] , true) ;
        $data["total_chiffre_affarie"] = $data["total_chiffre_affarie"] == "" ? "0 ".Config::get('constants.devise') : $data["total_chiffre_affarie"];

        $data["gain"] = $this->calcul_gain($revient,  $data["chiffre_affaire"]);

        
        $default_date = date("Y-m-d", strtotime(Commande::first_month()));
        
        $first_month = date("Y-m-d", strtotime((isset($date["debut"]) === true && $date["debut"] != "") ? $date["debut"] :Commande::first_month()));
        $first_month = $default_date > $first_month ? $default_date : $first_month; 
        
        $last_month = date("Y-m-d", strtotime((isset($date["fin"]) === true && $date["fin"] != "") ? $date["fin"] : date("Y-m-d")));
        $data['rent'] = $this->montantLoyer($first_month ,  true );
        $data['daily_rent'] = $data['rent'];
        $data['days_numbre'] = difference_date($first_month, $last_month);
        $data['rent'] *= $data['days_numbre'];
        
        
        $data["total_gain"] = gain_total_dashboard($data["gain"] , true , false , $data['rent']);

        $data["total_gain"] = $data["total_gain"] == "" ? "0 ".Config::get('constants.devise') : $data["total_gain"];

        $data["total_gain_original"] = doubleval(gain_total_dashboard($data["gain"] , true, true , $data['rent']));

        // general
        $cout_essence_total = 0;
        $cout_salarial_total = 0;
        $cout_livraison_total = 0;
        $revient_moyen = 0;
        
        foreach ($revient as $key => $rev) {
            # code...
            $produit_revient = Produit::where("produits.id", $rev->produit)->get();
            $revient_moyen += $rev->quantite_produit * $produit_revient[0]->revientMoyen();
            $cout_essence_total += $produit_revient[0]->cout_essence * $rev->quantite_produit;
            $cout_salarial_total += $produit_revient[0]->cout_salarial * $rev->quantite_produit;
            $cout_livraison_total += $produit_revient[0]->cout_livraison * $rev->quantite_produit;

        }
        $data["revient_moyen"] = $revient_moyen - $cout_essence_total - $cout_salarial_total - $cout_livraison_total;
        $data["cout_essence"] = $cout_essence_total;
        $data["cout_salarial"] = $cout_salarial_total;
        $data["cout_livraison"] = $cout_livraison_total;
        //$general["loyer"] = $Rent;

       
        return response()->json($data);
    }

    private function stock_produit($valeur_formule, $quantite_dispo)
    {

       
        //Calcule de produit qu'on peut produit par type de produit selon les matières premières restants

        $stock_disponible = [];
        $stock_actuel = [];
        foreach ($valeur_formule as $key => $value) {
            foreach ($quantite_dispo as $k => $val) {
                if( $val->matiere_id == $value->matiere_id ){
                    $stock = [
                        "formule" => $value->name,
                        "quantite" => $value->quantite,
                        "matiere" => $val->matiere,
                        "stock" => ( intval($val->quantite_disponible) > 0 && $value->valeur > 0) ? intval($val->quantite_disponible / $value->valeur)  : 0 ,
                        "valeur" =>  $value->valeur , 
                        "comptabilise" => $value->valeur == 0 ? false : true
                    ];
                    array_push($stock_disponible, $stock);
                }
            }
        }
        foreach ($stock_disponible as $key => $value) {
            foreach ($stock_disponible as $k => $val) {
                if($value["formule"] == $val["formule"]  && $val["comptabilise"]  && $value["comptabilise"]){
                    
                    $value["stock"] = $value["stock"] > $val["stock"] ? $val["stock"] : $value["stock"];
                    $stock_actuel[$value["formule"]] = [ "cycle" => $value["stock"] , "stock" => $value["stock"] * $value["quantite"]];
                }
            }
        }
        
        return $stock_actuel;
    }

    private function chiffre_affaire($data) 
    {
        
        $chiffre_affaire = [];
        foreach ($data as $key => $value) {

            $chiffre_affaire[$value->name] = ( isset($chiffre_affaire[$value->name]) === true ? $chiffre_affaire[$value->name] : 0 ) + ($value->chiffre_affaire);
           
        }
        return $chiffre_affaire;
    }

    private function calcul_gain($revient, $chiffre_affaire)
    {

        $res = [];
        $gain = [];
        foreach ($chiffre_affaire as $key => $value) {
           foreach ($revient as $k => $val) {
               if($key == $val->name){
                //$gain[$key] = (  Produit::find($val->produit)->revientMoyen() );
                $gain[$val->name] = ( isset($gain[$val->name]) === true ? $gain[$val->name] : 0  ) + ( $val->chiffre_affaire - ( $val->quantite_produit * Produit::find($val->produit)->revientMoyen() ) );
                
               }
           }
        }

        return $gain;
    }

}
