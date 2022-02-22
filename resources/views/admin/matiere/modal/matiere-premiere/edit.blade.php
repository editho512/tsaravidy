<form action="{{route('matiere.premiere.update', ['matierePremiere' => $matierePremiere->id])}}" role="form" id="form-modif-matiere-edit" method="POST">
    @csrf
    <input type="hidden" name="matiere" value="{{$matierePremiere->id}}">
    <div class="card-body">
        <div class="form-group">
            <label for="numero_bl">Numéro BL</label>
            <input type="text" name="numero_bl" class="form-control" id="numero_bl" value="{{$matierePremiere->numero_bl}}" placeholder="Bon de livraison n°" required>
        </div>
        <div class="form-group">
            <label for="fournisseur">Fournisseur</label>
            <input type="text" name="fournisseur" class="form-control" id="fournisseur" value="{{$matierePremiere->fournisseur}}" placeholder="Fournisseur" required>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" class="form-control" id="quantite" value="{{$matierePremiere->quantite}}" placeholder="Quantité" required>
        </div>
        <div class="form-group">
            <label for="quantite_dispo">Quantité dispo</label>
            <input type="number" name="quantite_dispo" class="form-control" id="quantite_dispo" value="{{$matierePremiere->quantite_dispo}}" placeholder="Quantité disponible" required>
        </div>
        <div class="form-group">
            <label for="pu">P.U</label>
            <input type="number" name="pu" class="form-control" id="pu" value="{{$matierePremiere->pu}}" placeholder="Prix unitaire" required>
        </div>
        <div class="form-group">
            <label for="frais_livraison">Frais</label>
            <input type="number" name="frais_livraison" class="form-control" id="frais_livraison" value="{{$matierePremiere->frais_livraison}}" placeholder="Frais de livraison" required>
        </div>
        <div class="form-group">
            <label for="mode_paiement">Mode de paiement</label>
            <select name="mode_paiement" class="form-control" id="mode_paiement_edit" onchange="is_credit_edit(this);" required>
                @if($matierePremiere->mode_paiement == 'comptant')
                    <option value="comptant" selected>Comptant</option>
                    <option value="credit">Crédit</option>
                @else
                    <option value="comptant">Comptant</option>
                    <option value="credit" selected>Crédit</option>
                @endif
            </select>
        </div>

        <div id="is_credit_edit" class="form-group">
            @if($matierePremiere->mode_paiement == 'credit')
                <div class="form-group">
                     <label for="montant_credit">Montant crédit</label>
                     <input type="number" name="montant_credit" class="form-control" id="montant_credit" value="{{$matierePremiere->montant_credit}}" placeholder="Montant du crédit" required>
                </div>
                <div class="form-group">
                    <label>Date d'echéance crédit :</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                       <input type="text" class="form-control" name="date_credit" value="{{date_format($matierePremiere->date_credit, 'd/m/Y')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                    </div>
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" class="form-control" id="commentaire" placeholder="Votre commentaire ici...">{{$matierePremiere->commentaire}}</textarea>
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
