<form action="{{route('depense.update', ['depense' => $depense->id])}}" role="form" id="form-modif-depense" method="POST">
    @csrf
    <input type="hidden" name="depense" id="depense_json" data-nb_salarie={{(isset($depense->salaries) && count($depense->salaries) > 0)?count($depense->salaries) : 0 }} value="{{$depense->id}}">
    <div class="card-body">
        <div class="form-group">
            <label for="name">Designation</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Designation" value="{{$depense->name}}" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" name="type" id="type" required>
                <option value="">Choisissez un type de dépense</option>
                @foreach($types as $type)
                    @if($depense->type == $type)
                        <option value="{{$type}}" selected>{{$type}}</option>
                    @else
                        <option value="{{$type}}">{{$type}}</option>
                    @endif
                @endforeach
            </select>
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
                                    <input type="text" value='{{$salarie->nom}}' placeholder="Nombre de salarié" name="nombre_salarie" class='form-control ' >
                                </div>
                                <div class="col-sm-6" style="padding-top:1%;">
                                    <input type="text" value='{{$salarie->montant}}' placeholder="Montant salaire" name="montant_salaire" class='form-control' >
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-1 row">
                        <div class="col-sm-12" style="text-align:right;">
                            <button  type="button" class="btn btn-sm btn-salarie-moins" style="border:solid 1px rgba(147,155,162,0.8);color:rgba(147,155,162,0.8);{{isset($depense->salaries) && count($depense->salaries) > 1 ? "" : "display:none;"}}"><span class="fa fa-minus"></span></button>

                            <button  type="button" class="btn btn-sm btn-salarie-plus" style="border:solid 1px rgba(147,155,162,0.8);color:rgba(147,155,162,0.8);"><span class="fa fa-plus"></span></button>
                        </div>
                    </div>
                </div>
            @else
                <input type="hidden" name="salaire" class="salarie_data" value="">
                <div class="form-group">
                    <label for="nombre_salarie">Salarié :</label>
                    <div id="salarie_formulaire">
                        <div class="row">
                            <div class="col-sm-6" style="padding-top:1%;">
                                <input type="text" placeholder="Nom du salarié" name="nom_salarie" class='form-control salariale' required>
                            </div>
                            <div class="col-sm-6" style="padding-top:1%;">
                                <input type="text" placeholder="Montant salaire" name="montant_salaire" class='form-control salariale' required>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1 row">
                        <div class="col-sm-12" style="text-align:right;">
                            <button  type="button" class="btn btn-sm btn-salarie-moins" style="border:solid 1px rgba(147,155,162,0.8);color:rgba(147,155,162,0.8);display:none;"><span class="fa fa-minus"></span></button>

                            <button  type="button" class="btn btn-sm btn-salarie-plus" style="border:solid 1px rgba(147,155,162,0.8);color:rgba(147,155,162,0.8);"><span class="fa fa-plus"></span></button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="numero_bl">Numéro BL</label>
            <input type="text" name="numero_bl" class="form-control" id="numero_bl" value="{{$depense->numero_bl}}" placeholder="Bon de livraison n°" required>
        </div>
        <div class="form-group">
            <label for="fournisseur">Fournisseur</label>
            <input type="text" name="fournisseur" class="form-control" id="fournisseur" value="{{$depense->fournisseur}}" placeholder="Fournisseur" required>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" class="form-control" id="quantite" value="{{$depense->quantite}}" placeholder="Quantité" required>
        </div>
        <div class="form-group">
            <label for="unite">Unité</label>
            <input type="text" name="unite" class="form-control" id="unite" value="{{$depense->unite}}" placeholder="Unité" required>
        </div>
        <div class="form-group">
            <label for="pu">P.U</label>
            <input type="number" name="pu" class="form-control" id="pu" value="{{$depense->pu}}" placeholder="Prix unitaire" required>
        </div>
        <div class="form-group">
            <label for="frais_livraison">Frais</label>
            <input type="number" name="frais_livraison" class="form-control" id="frais_livraison" value="{{$depense->frais_livraison}}" placeholder="Frais de livraison" required>
        </div>
        <div class="form-group">
            <label for="mode_paiement">Mode de paiement</label>
            <select name="mode_paiement" class="form-control" id="mode_paiement_edit" onchange="is_credit_edit(this);" required>
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
                     <input type="number" name="montant_credit" class="form-control" id="montant_credit" value="{{$depense->montant_credit}}" placeholder="Montant du crédit" required>
                </div>
                <div class="form-group">
                    <label>Date d'echéance crédit :</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                       <input type="text" class="form-control" name="date_credit" value="{{date_format($depense->date_credit, 'd/m/Y')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                    </div>
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" class="form-control" id="commentaire" placeholder="Votre commentaire ici...">{{$depense->commentaire}}</textarea>
        </div>
    </div>
    <!-- /.card-body -->
</form>
<script>

    function is_credit_edit(el) {
        if ($(el).val() == 'credit'){
            $('#is_credit_edit').html('<div class="form-group">\n' +
                '                                    <label for="montant_credit">Montant crédit</label>\n' +
                '                                    <input type="number" name="montant_credit" class="form-control" id="montant_credit" placeholder="Montant du crédit" required>\n' +
                '                                </div>\n' +
                '                                <div class="form-group">\n' +
                '                                    <label>Date d\'echéance crédit :</label>\n' +
                '                                    <div class="input-group">\n' +
                '                                        <div class="input-group-prepend">\n' +
                '                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>\n' +
                '                                        </div>\n' +
                '                                        <input type="text" class="form-control" name="date_credit" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>\n' +
                '                                    </div>\n' +
                '                                </div>');
        }else{
            $('#is_credit_edit').html('');
        }

        $('[data-mask]').inputmask();
    }
</script>

