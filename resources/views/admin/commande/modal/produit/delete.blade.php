<div class="modal-header modal-header-danger">
    <h4 class="modal-title">Supprimer produit {{$produit->name}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('commande.produit.delete', ['produit' => $produit->id])}}" role="form" id="form-supprimer-produit" method="POST">
        @csrf
        @method('delete')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Designation</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Designation" value="{{$produit->name}}" disabled>
            </div>
            <div class="form-group">
                <label for="quantite">Formule</label>
                <select class="form-control" name="" id="" disabled>
                    <option value="">{{$produit->formule->name}}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" name="quantite" class="form-control" id="quantite" placeholder="Quantité" value="{{$produit->quantite}}" disabled>
            </div>
            <div class="form-group">
                <label for="pu_vente">P.U</label>
                <input type="number" name="pu_vente" class="form-control" id="pu_vente" placeholder="Prix unitaire" value="{{$produit->pu_vente}}" disabled>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" placeholder="Description complète" disabled>{{$produit->description}}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-supprimer-produit" class="btn btn-danger float-right">Supprimer</button>
</div>
