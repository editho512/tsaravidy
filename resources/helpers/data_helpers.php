<?php

if(!function_exists("nombre")){
    function nombre($data , $virgule = 0){
        return number_format($data, $virgule ,","," ") ;
    }
}
if(!function_exists("format_prix")){
    function format_prix($data){
        return nombre($data, 2)." ".Config::get('constants.devise') ;
    }
}

if(!function_exists("depense_dashboard")){
    function depense_dashboard($depense , $val = false){
      
        if(isset($depense) && count($depense) > 0){
            foreach ($depense as $key => $value) {
                echo "'".( $val ? $value->montant_total : $value->type )."', ";
                }
        }
       
    }
}

if(!function_exists("mois")){
    function mois($month){
        $name = "";
        switch ($month) {
            case 1:
                $name = "Janvier";
            break;
            case 2:
                $name = "Février";
            break;
            case 3:
                $name = "Mars";
            break;
            case 4:
                $name = "Avril";
            break;
            case 5:
                $name = "Mai";
            break;
            case 6:
                $name = "Juin";
            break;
            case 7:
                $name = "Juillet";
            break;
            case 8:
                $name = "Août";
            break;
            case 9:
                $name = "Septembre";
            break;
            case 10:
                $name = "Octobre";
            break;
            case 11:
                $name = "Novembre";
            break;
            case 12:
                $name = "Decembre";
            break;
            
            
        }
        return $name;
    }
}

if(!function_exists("produit_dashboard")){

    function produit_dashboard($commande , $produit , $val = false, $show = true){
        $res = "";
        $response = [];
        if(isset($commande) && count($commande) > 0){
            foreach ($commande as $key => $value) {
                $quantite_total = intval($value->quantite_commande);
                foreach ($produit as $k => $va) {
                    if($va->formule_id == $value->id ){
                        $quantite_total -= intval($va->quantite_produit);
                    }
                }
                
                $res.= "'".( $val ? $quantite_total : $value->name )."', ";

                array_push($response, ( $val ? $quantite_total : $value->name ));
            }
        }
       if($show === true){
           echo $res;
       }else{
           return $response;
       }
    }
}

if(!function_exists("livraison_dashboard")){

    function livraison_dashboard($commande , $produit , $livraison, $show = true){
        $res = "";
        $response = [];
        if(isset($commande) && count($commande) > 0){
            
            foreach ($commande as $key => $value) {

                $disponible = 0 ;
                $livree = 0;
                foreach ($produit as $k => $va) {
                    
                    if($va->formule_id == $value->id ){
                        $disponible = intval($va->quantite_produit);

                        foreach ($livraison as $ke => $valu) {
                            if($va->formule_id == $valu->formule_id){
                                $livree = intval($valu->quantite_livraison);
                            }
                        }
                    }
                }
                
                $non_livree = intval($disponible) - $livree;
            
                $alivree = $non_livree > $disponible ? $disponible : $non_livree;
                $res .= "'".$alivree."', ";
                array_push($response, $alivree);
            }
          
        }
        if($show === true){
            echo $res;
        }else{
            return $response;
        }

       
       
    }
}

if(!function_exists("gain_dashboard")){

    function gain_dashboard($data, $label = false){
        
        if(isset($data) && count($data) > 0){
            foreach ($data as $key => $value) {
                echo "'".($label ? $key : $value)."', ";
            }
        }
       
    }
}

if(!function_exists("gain_total_dashboard")){

    function gain_total_dashboard($data , $ret = false , $original = false , $rent = 0){
        $total = 0 ;
        $total -= $rent;
        
        if(isset($data) && count($data) > 0){
            foreach ($data as $key => $value) {
                $total += $value;
            }
        }
        if( $ret){
            return ($original === false) ? format_prix($total) : $total ;
        }else{
            echo ($original === false) ? format_prix($total) : $total ;

        }
       
    }
}

if(!function_exists("depense_periodique")){
    function depense_periodique($data , $label = false){
        foreach ($data as $key => $value) {
            echo "'".($label ? mois($value->mois)." ".$value->annee : $value->montant_total  )."', ";
        }
    }
}

if(!function_exists('lister_chart')){

    function lister_chart($data , $show = true){
        $res = "";
        $response = [];
        foreach ($data as $key => $value) {
            $res.= "'".$value->quantite."', ";
            array_push($response, $value->quantite);
        }
        if($show == true){
            echo $res;
        }else{
            return $response;
        }
    }
}

if(!function_exists('liste_date_loyer')){

    function liste_date_loyer(){
        
        $dates = [];

        $date = strtotime(date("d-m-Y"));
        for ($i = 0; $i < 6 ; $i++) { 
            $last = date("Y-m-d", strtotime("+1 month", $date));
            $date = strtotime($last);
            // recuperation

            $month = date("m", $date);
            $year = date("Y", $date);
            $moi = "";

            switch ($month) {
                case 1 :
                    # code...
                   $moi = "Janvier";
                break;
                
                case 2 :
                    # code...
                    $moi = "Février";
                break;

                case 3 :
                    # code...
                    $moi = "Mars";
                break;

                case 4 :
                    # code...
                    $moi = "Avril";
                break;

                case 5 :
                    # code...
                    $moi = "Mai";
                break;

                case 6 :
                    # code...
                    $moi = "Juin";
                break;

                case 7 :
                    # code...
                    $moi = "Juillet";
                break;

                case 8 :
                    # code...
                    $moi = "Août";
                break;

                case 9 :
                    # code...
                    $moi = "Septembre";
                break;

                case 10 :
                    # code...
                    $moi = "Octobre";
                break;

                case 11 :
                    # code...
                    $moi = "Novembre";
                break;

                case 12 :
                    # code...
                    $moi = "Décembre";
                break;
            }
            array_push($dates, ["data" => ($month."-".$year), "label" => ($moi." ".$year) ]);
        }

        return $dates;
    }

    
    
}


if(!function_exists('difference_mois')){

    function difference_mois($date){
        $d1 = date("m", strtotime($date));
        $d2 = date("m",strtotime(date("Y-m-d")));
        $annee =  date("Y",strtotime(date("Y-m-d"))) - date("Y", strtotime($date));
        $mois1 = (12 * $annee ) - $d1;
        $mois2 = $d2 + 1;
        $totalMonthsDiff = $mois1 + $mois2;
    
        return $totalMonthsDiff;
    }
}
if(!function_exists('difference_date')){

    function difference_date($d1, $d2 , $type = "day"){
        //$d1 = strtotime("2018-01-10 00:00:00");
        //$d2 = strtotime("2019-05-18 01:23:45");

        $totalSecondsDiff = abs(strtotime($d1) - strtotime($d2)); //42600225
        $totalMinutesDiff = $totalSecondsDiff/60; //710003.75
        $totalHoursDiff   = $totalSecondsDiff/60/60;//11833.39
        $totalDaysDiff    = $totalSecondsDiff/60/60/24; //493.05
        $totalMonthsDiff  = $totalSecondsDiff/60/60/24/30; //16.43
        $totalYearsDiff   = $totalSecondsDiff/60/60/24/365; //1.35

        if($type == "day"){
            return $totalDaysDiff + 1;
        }else if($type == "month"){
            return $totalMonthsDiff;
        }else if($type == "year"){
            return $totalYearsDiff;
        }
        
    }
}