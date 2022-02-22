<div class="modal-header modal-header-danger">
    <h4 class="modal-title">Supprimer livraison {{$livraison->numero_bl}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('livraison.delete', ['livraison' => $livraison->id])}}" role="form" id="form-supprimer-livraison" method="POST">
        @csrf
        @method('delete')
        <div class="card-body">
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
                <label>Date de livraison :</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" name="date_livraison" value="{{date_format($livraison->date_livraison, 'd/m/Y')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask disabled>
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                <label for="numero_bl">Numéro Bon de livraison</label>
                <input type="text" name="numero_bl" value="{{$livraison->numero_bl}}" class="form-control" id="numero_bl"
                       placeholder="Numéro BL" disabled>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité (max: {{$produit->quantiteDisponible()+$livraison->quantite}})</label>
                <input type="number" name="quantite" value="{{$livraison->quantite}}" class="form-control" id="quantite"
                       placeholder="Quantité" max="{{$produit->quantiteDisponible()+$livraison->quantite}}" disabled>
            </div>
            <div class="form-group">
                <label for="commentaire">Commentaire</label>
                <textarea class="form-control" name="commentaire" id="commentaire"
                          placeholder="Commentaire..." disabled>{{$livraison->commentaire}}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-supprimer-livraison" class="btn btn-danger float-right">Supprimer</button>
</div>
