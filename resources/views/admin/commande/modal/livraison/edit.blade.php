<div class="modal-header modal-header-primary">
    <h4 class="modal-title">Modifier livraison {{$livraison->numero_bl}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('livraison.update', ['livraison' => $livraison->id])}}" role="form" id="form-modifier-livraison" method="POST">
        @csrf
        <div class="card-body">
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
                <label>Date de livraison :</label>

                <div class="input-group">
                    <div class="input-group date" id="date_livraison_edit" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#date_livraison_edit" name="date_livraison" value="{{date_format($livraison->date_livraison, 'd/m/Y')}}" required/>
                        <div class="input-group-append" data-target="#date_livraison_edit" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label for="numero_bl">Numéro Bon de livraison</label>
                <input type="text" name="numero_bl" value="{{$livraison->numero_bl}}" class="form-control" id="numero_bl"
                       placeholder="Numéro BL" required>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité (max: {{$produit->quantiteDisponible()+$livraison->quantite}})</label>
                <input type="number" name="quantite" value="{{$livraison->quantite}}" class="form-control" id="quantite"
                       placeholder="Quantité" max="{{$produit->quantiteDisponible()+$livraison->quantite}}" required>
            </div>
            <div class="form-group">
                <label for="commentaire">Commentaire</label>
                <textarea class="form-control" name="commentaire" id="commentaire"
                          placeholder="Commentaire...">{{$livraison->commentaire}}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-modifier-livraison" class="btn btn-primary float-right">Sauvegarder</button>
</div>
