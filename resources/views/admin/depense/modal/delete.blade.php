<form action="{{route('depense.delete', ['depense' => $depense->id])}}" role="form" id="form-supprimer-depense" method="POST">
    @csrf
    @method('delete')
    <input type="hidden" name="depense" value="{{$depense->id}}">
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <label for="name">Designation</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$depense->name}}" disabled>
            </div>
            <label for="type">Type</label>
            <input type="text" name="type" class="form-control" id="type" value="{{$depense->type}}" disabled>
        </div>
        <div class="type_content">
            @if (isset($depense->salaries) && count($depense->salaries) > 0)
                @php
                    $salaire_json = array();
                    foreach($depense->salaries as $key => $salarie){
                        $salaire_json[$key] = [
                            "nombre" => $salarie->nom ,
                            "salarie_montant" => $salarie->montant
                        ];
                    }
                @endphp
                <input type="hidden" name="salaire" class="salarie_data" value="{{json_encode($salaire_json)}}">
                <div class="form-group">
                    <label for="nombre_salarie">Salarié :</label>
                    <div id="salarie_formulaire">
                        @foreach ($depense->salaries as $key => $salarie)
                            <div id="{{($key + 1) > 0 ? 'salarie_formulaire_added-'.($key + 1 ) : ''}}" class="row">
                                <div class="col-sm-6" style="padding-top:1%;">
                                    <input type="text" value='{{$salarie->nom}}' placeholder="Nombre de salarié" name="nombre_salarie" class='form-control ' disabled>
                                </div>
                                <div class="col-sm-6" style="padding-top:1%;">
                                    <input type="text" value='{{$salarie->montant}}' placeholder="Montant salaire" name="montant_salaire" class='form-control' disabled >
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                </div>
           

            @endif
        </div>
        <div class="form-group">
            <label for="numero_bl">Numéro BL</label>
            <input type="text" name="numero_bl" class="form-control" id="numero_bl" value="{{$depense->numero_bl}}" disabled>
        </div>
        <div class="form-group">
            <label for="fournisseur">Fournisseur</label>
            <input type="text" name="fournisseur" class="form-control" id="fournisseur" value="{{$depense->fournisseur}}" disabled>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" class="form-control" id="quantite" value="{{$depense->quantite}}" disabled>
        </div>
        <div class="form-group">
            <label for="unite">Unité</label>
            <input type="text" name="unite" class="form-control" id="unite" value="{{$depense->unite}}" disabled>
        </div>
        <div class="form-group">
            <label for="pu">P.U</label>
            <input type="number" name="pu" class="form-control" id="pu" value="{{$depense->pu}}" disabled>
        </div>
        <div class="form-group">
            <label for="frais_livraison">Frais</label>
            <input type="number" name="frais_livraison" class="form-control" id="frais_livraison" value="{{$depense->frais_livraison}}" disabled>
        </div>
        <div class="form-group">
            <label for="mode_paiement">Mode de paiement</label>
            <select name="mode_paiement" class="form-control" id="mode_paiement_edit" onchange="is_credit_edit(this);" disabled>
                @if($depense->mode_paiement == 'comptant')
                    <option value="comptant" selected>Comptant</option>
                    <option value="credit">Crédit</option>
                @else
                    <option value="comptant">Comptant</option>
                    <option value="credit" selected>Crédit</option>
                @endif
            </select>
        </div>

        <div id="is_credit_edit" class="form-group">
            @if($depense->mode_paiement == 'credit')
                <div class="form-group">
                     <label for="montant_credit">Montant crédit</label>
                     <input type="number" name="montant_credit" class="form-control" id="montant_credit" value="{{$depense->montant_credit}}" disabled>
                </div>
                <div class="form-group">
                    <label>Date d'echéance crédit :</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                       <input type="text" class="form-control" name="date_credit" value="{{date_format($depense->date_credit, 'd/m/Y')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask disabled>
                    </div>
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" class="form-control" id="commentaire" disabled>{{$depense->commentaire}}</textarea>
        </div>
    </div>
    <!-- /.card-body -->
</form>
