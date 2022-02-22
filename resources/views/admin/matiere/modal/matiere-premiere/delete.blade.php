<form action="{{route('matiere.premiere.delete', ['matierePremiere' => $matierePremiere->id])}}" role="form" id="form-supprimer-matiere-premiere" method="POST">
    @csrf
    @method('delete')
    <input type="hidden" name="matiere" value="{{$matierePremiere->id}}">
    <div class="card-body">
        <div class="form-group">
            <label for="numero_bl">Numéro BL</label>
            <input type="text" name="numero_bl" class="form-control" id="numero_bl" value="{{$matierePremiere->numero_bl}}" disabled>
        </div>
        <div class="form-group">
            <label for="fournisseur">Fournisseur</label>
            <input type="text" name="fournisseur" class="form-control" id="fournisseur" value="{{$matierePremiere->fournisseur}}" disabled>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" class="form-control" id="quantite" value="{{$matierePremiere->quantite}}" disabled>
        </div>
        <div class="form-group">
            <label for="quantite_dispo">Quantité dispo</label>
            <input type="number" name="quantite_dispo" class="form-control" id="quantite_dispo" value="{{$matierePremiere->quantite_dispo}}" disabled>
        </div>
        <div class="form-group">
            <label for="pu">P.U</label>
            <input type="number" name="pu" class="form-control" id="pu" value="{{$matierePremiere->pu}}" disabled>
        </div>
        <div class="form-group">
            <label for="frais_livraison">Frais</label>
            <input type="number" name="frais_livraison" class="form-control" id="frais_livraison" value="{{$matierePremiere->frais_livraison}}" disabled>
        </div>
        <div class="form-group">
            <label for="mode_paiement">Mode de paiement</label>
            <select name="mode_paiement" class="form-control" id="mode_paiement_edit" onchange="is_credit_edit(this);" disabled>
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
                     <input type="number" name="montant_credit" class="form-control" id="montant_credit" value="{{$matierePremiere->montant_credit}}" disabled>
                </div>
                <div class="form-group">
                    <label>Date d'echéance crédit :</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                       <input type="text" class="form-control" name="date_credit" value="{{date_format($matierePremiere->date_credit, 'd/m/Y')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask disabled>
                    </div>
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" class="form-control" id="commentaire" disabled>{{$matierePremiere->commentaire}}</textarea>
        </div>
    </div>
    <!-- /.card-body -->
</form>
