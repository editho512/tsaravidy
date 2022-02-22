

<form action="">

        
        <div class="card card-{{$disabled === true ? 'danger' : 'primary'}} card-outline">
            <div class="card-body box-profile">
    
                <h3 class="profile-username text-center">Information général:</h3>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="adresse">Adresse :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="modifier_adresse" name="adresse" class="form-control" value="{{isset($info->adresse) ? $info->adresse : 'Rue de commerce Ampasiamazava'}}" required>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="phone">Téléphone :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="modifier_phone" name="phone" class="form-control" value="{{isset($info->telephone) ? $info->telephone : '+261 32 71 979 15'}}"  required>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="mail">Email :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="modifier_mail" name="mail" class="form-control" value="{{isset($info->email) ? $info->email : 'hismaljee@gmail.com'}}" required>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="nif">NIF :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="modifier_nif" name="nif" class="form-control" value="{{isset($info->nif) ? $info->nif : '123 456 789 0258'}}" required>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="stat">STAT :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="modifier_stat" name="stat" class="form-control" value="{{isset($info->stat) ? $info->stat : '987 654 321'}}" required>
                            </div>
                        </div>
                        
    
                    </div>
                    <div class="col-md-6">
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="rcs">RCS :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="modifier_rcs" name="rcs" class="form-control" value="{{isset($info->rcs) ? $info->rcs : '028546'}}" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="commande">Commande :</label>
                            </div>
                            <div class="col-md-8">
                                <select name="commande" id="modifier_livraison_commande" class="form-control" autocomplete="off" disabled >
                                    <option value=0>Numero de BC</option>
                                    @if (isset($commandes) === true && $commandes->count() > 0)
                                        @foreach ($commandes as $commande)
                                            <option value={{$commande->id}} {{$commande->id == $commande_id ? "selected" : "" }}>{{$commande->numero_bc}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2" style="display: none;">
                            <div class="col-md-4">
                                <label for="client">Client :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  name="client" id="modifier_livraison_client" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-2" >
                            <div class="col-md-4">
                                <label for="client">Numéro BL :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="modifier_numero_bl" name="numero_bl"  class="form-control" placeholder="Numéro BL" value="{{isset($livraisons[0]->numero_bl) === true ? $livraisons[0]->numero_bl : (isset($info->numero_bl) === true ? $info->numero_bl : "")}}"  disabled required>
                            </div>
                        </div>
    
                        <!-- Date dd/mm/yyyy -->
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label>Date de livraison :</label>
                            </div>
    
                            <div class="col-md-8">
                                <div class="input-group date" id="modifier_date_livraison" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#modifier_date_livraison" name="date_livraison" value="{{isset($livraisons[0]->date_livraison) === true  ? $livraisons[0]->date_livraison : ""}}" required/>
                                    <div class="input-group-append" data-target="#modifier_date_livraison" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- Date dd/mm/yyyy -->
    
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card-body -->
    
        <div class="card card-danger card-outline" id="modal-suppression-livraison" style="display:none;">
            <div class="card-body box-profile">
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <p>Voulez-vous vraiment supprimer la livraison <span class="content-alert-remove"></span> ?</p>
                        <button type="button" class="btn btn-danger supprimer">Supprimer</button>
                        <button type="button" class="btn btn-default annuler">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="card card-defalut card-outline">
            <div class="card-body box-profile">
                <div class="row">
                    <div class="col-md-12">
                        <table id="body-form-livraison" class="table table-bordered table-striped dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th>Désignation</th>
                                    <th>Non-livrée</th>
                                    <th>Prix Unitaire</th>
                                    <th>Quantité</th>
                                    <!--<th>Rémise</th>-->
                                    <th>Montant</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($produits as $produit)
                                        <tr class="liste-produit" data-id="{{$produit->id}}">
                                            @php
                                                    $quantite = 0;
                                                    $livraison_id = 0;
                                                    $remise = 0;
                                                    
                                                    foreach($livraisons as $item){
                                                        if($item->produit_id == $produit->id){
                                                            $quantite = $item->quantite;
                                                            $livraison_id = $item->id;
                                                        }
                                                        if(isset($reduction[0]) === true && $reduction[0]->produit_id == $item->produit_id){
                                                            
                                                            $remise = $reduction[0]->is_percent == true ? ( ($reduction[0]->valeur * $item->pu_vente) /100 ) * $item->quantite : $reduction[0]->valeur;
                                                        }
                                                    }
                                                    
                                                @endphp
    
                                            <td>{{$produit->name}}</td>
                                            <td data-value="{{$produit->quantite - $quantite }}">{{nombre($produit->quantite - $quantite)}}</td>
                                            <td data-value="{{$produit->pu_vente}}">{{format_prix($produit->pu_vente)}}</td>
                                            <td class="quantite">
                                                <input type="text"  data-dispo="{{$produit->dispo + $quantite}}" class="form-control quantite-a-livree" placeholder="Quantité à livrer {{ isset($produit->dispo) === true ?  ( "( ".($produit->dispo + $quantite). " disponible(s) )" ) : ""}}" value="{{$quantite}}">
                                            </td>
                                            <!--
                                            <td >
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input type="text"  class="form-control" placeholder="Rémise">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="type_remise" id=""  checked>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span for="">(en %)</span>
                                                    </div>
                                                </div>
                                            </td>-->
                                            <td >{{ format_prix($quantite * $produit->pu_vente ) }} </td>
                                            <td class="row">
                                                <div class="col-md-12" style="text-align: center">
    
                                                    <button type="button" {{$quantite == 0 ? "disabled" : ""}} class="btn btn-xs btn-danger supprimer-livraison" data-url="{{route('livraison.supprimer_livraison', ['livraision' => $livraison_id])}}" ><span class="fa fa-trash"></span></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                            </tbody>
                        </table>
    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                            <div class="col-md-4" style="text-align: right !important;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span>Commentaire :</span>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="commentaire" id="modifier_commentaire" class="form-control" cols="30" rows="2" placeholder="Votre commentaire" autocomplete="off" >{{isset($livraisons[0]->commentaire) === true ? $livraisons[0]->commentaire : ""}}</textarea>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        @if ($disabled === true)
            <script>
                $("#modal-supprimer-bon_livraison .modal-body input , #modal-supprimer-bon_livraison .modal-body button").attr("disabled", true);
            </script>
        @endif
        <script>
            
           
            $(document).on("click", "#modal-suppression-livraison .supprimer", function(e){
               let url = $(this).attr("data-url");
                
               $.get(url, {}, dataType="HTML").done(function(data){
                   
                   if(data == "0"){

                        $("#modal-suppression-livraison").next().remove();
                        $("#modal-suppression-livraison").parent().append("<p class='alert alert-primary'>Aucun </p>");

                        $("#modal-suppression-livraison").remove();

                      

                   }else{
                    
                        $("#modal-modifier-bon_livraison .modal-body").html(data);

                   }
                    
    
               })
    
            });
            

            $(document).on("click", "#modal-suppression-livraison .annuler", function (e) {

                $("#modal-suppression-livraison").hide(200);

            })
    
            $(document).on("click", ".supprimer-livraison", function(){
                
                let url = $(this).attr("data-url");
                let name = $(this).parent().parent().prev().prev().prev().prev().prev().html();
                let value = $(this).parent().parent().prev().prev().find("input").val();
    
                $("#modal-suppression-livraison .supprimer").attr("data-url", url);
    
                $("#modal-suppression-livraison .content-alert-remove").html("de "+value+" '"+name+"'");
    
                $("#modal-suppression-livraison").show(200);
    
            });      
    
            $(document).on("keyup", ".quantite-a-livree", function () {
                let quantite = $(this).val();
    
                let montant = 0;
                let non_livree = $(this).attr("data-dispo");
    
                if(parseFloat(quantite) > parseFloat(non_livree)){
                    $(this).addClass("is-invalid");
                }else{
                    $(this).removeClass("is-invalid");
                }
    
                if(quantite != undefined && quantite != ""){
                    let pu = $(this).parent().prev().attr("data-value");
                    montant = parseFloat(pu) * parseFloat(quantite);
                }
                    $(this).parent().next().html(montant+" Ar");
            })
        </script>
    
     
</form>