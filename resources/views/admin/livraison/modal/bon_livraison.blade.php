<style>
   .bon table , .bon td , .bon th{
        border-color: black !important;
    }

    .bon th{
        border-bottom:none !important;
    }
</style>
<div class="row">
    <div class="col-sm-2">
        <img src="{{asset('assets/images/logo/logo-second.png')}}" alt="IMG" style="max-width:320px;max-height:140px;">
    </div>
    <div class="col-sm-10">
       
    </div>
</div> 

<div class="row mt-3" >
    <div class="col-sm-5">
        <div class="row" >
            <div class="col-sm-12" >

                <span>Adresse :</span>
                <span>{{isset($info->adresse) ? $info->adresse : 'Rue de commerce Ampasiamazava'}}</span>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                
                <span>Tel :</span>
                <span>{{isset($info->telephone) ? $info->telephone : '+261 32 71 979 15'}}</span>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                
                <span>Email :</span>
                <span>{{isset($info->email) ? $info->email : 'hismaljee@gmail.com'}}</span>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h6 > <span style="font-weight: bold;border-bottom:solid 1px black;" >Coordonnées</span></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                
                <span>NIF :</span>
                <span>{{isset($info->nif) ? $info->nif : '123 456 789 0258'}}</span>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                
                <span>STAT :</span>
                <span>{{isset($info->stat) ? $info->stat : '987 654 321'}}</span>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                
                <span>RCS :</span>
                <span>{{isset($info->rcs) ? $info->rcs : '028546'}}</span>

            </div>
        </div>
    </div>
    <div class="col-sm-7" style="padding-top:5% !important;">
        <h3 class="">BON DE LIVRAISON N°: {{$livraisons[0]->numero_bl}}</h3>
        <div class="row mt-2">
            <div class="col-sm-12">
                <span>Doit:</span>
            </div>
        </div>
        <div class="row mt-2" style="margin-right:3px;">
            <div class="col-sm-12" style="border:solid 1px black;border-radius:5px;">
                <h5 class="mt-2">{{$client[0]->user}}</h5>
                <p class="mt-4">Email : </p>
                <p class="mt-2">Tél : </p>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-sm-12">
        <p>Toamasina, {{isset($livraisons[0]->date_livraison) === true ? date("d/m/Y", strtotime($livraisons[0]->date_livraison)) : ''}}</p>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 bon" style="padding:3px; border-radius:5px; border:solid 1px black;" >
        <table class="table table-bordered" style="margin-bottom:1px !important;">
            <thead>
                <th style="text-align: center" >Quantité</th>
                <th style="text-align: center" >Désignation</th>
                <th style="text-align: center" >Prix U.</th>
                <th style="text-align: center" >Rémise</th>
                <th style="text-align: center" >Montant</th>
            </thead>
            <tbody>
                @php
                    $montant_total = 0;
                @endphp
                @if (isset($livraisons) === true && $livraisons->count() > 0)
                    
                    @foreach ($livraisons as $item)
                        @php
                            $remise = 0;
                            if(isset($reduction[0]) === true && $reduction[0]->produit_id == $item->produit_id){
                                
                                $remise = $reduction[0]->is_percent == true ? ( ($reduction[0]->valeur * $item->pu_vente) /100 ) * $item->quantite : $reduction[0]->valeur;
                            }

                            $montant = ($item->quantite * $item->pu_vente) - $remise;
                            $montant_total += $montant;
                        @endphp
                        <tr>
                            <td>{{nombre($item->quantite)}}</td>
                            <td>{{$item->name}}</td>
                            <td style="text-align: right;" >{{format_prix($item->pu_vente)}}</td>
                            <td style="text-align: right;" >{{format_prix($remise) }}</td>
                            <td style="text-align: right;" >{{ format_prix($montant) }}</td>
                        </tr>
                    @endforeach

                @endif
                <tr>
                    <td colspan=2>
                        <h6 style="font-weight: bold">Conditions de vente :</h6>
                        <p>Les marchandises vendues ne sont ni réprises ni échangées</p>
                    </td>
                    <td colspan="2" style="text-align: right;">
                        <h6 style="font-weight: bold" >MONTANT TOTAL:</h6>
                        <p>REMISE :</p>
                        <p>NET A PAYER</p>
                    </td>
                    <td style="text-align: right;">
                        <h6 style="font-weight: bold">{{format_prix($montant_total)}}</h6>
                        <p>0</p>
                        <p>{{format_prix($montant_total)}}</p>
                    </td>
                </tr>
               
            </tbody>
        </table>
    </div>
</div>
<div class="row mt-2" style="padding:3px; border-radius:5px; border:solid 1px black;">
    <div class="col-sm-12 bon" style="padding:0px !important;">
        <table class="table table-bordered" style="margin-bottom:1px !important;padding-right:1px !important;">
            <thead>
                <th style=" text-align: center;" colspan=4 >Visas</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p  style="text-align: center;margin-top:90px !important;">
                            Le Fournisseur
                        </p>
                    </td>
                    
                    <td>
                        <p  style="text-align: center;margin-top:90px !important;">
                            Le Magasinier
                        </p>
                    </td>
                    
                    <td>
                        <p  style="text-align: center;margin-top:90px !important;">
                            Le Livreur
                        </p>
                    </td>
                    
                    <td>
                        <p  style="text-align: center;margin-top:90px !important;">
                            Le Client
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>