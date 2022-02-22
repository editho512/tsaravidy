<div class="modal-header modal-header-primary">
    <h4 class="modal-title">Modifier produit {{$produit->name}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form action="{{route('commande.update', ['produit' => $produit->id])}}" role="form" id="form-modifier-produit" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Designation</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Designation" value="{{$produit->name}}" required>
            </div>
            <div class="form-group">
                <label for="quantite">Formule</label>
                <select class="form-control" name="" id="" disabled>
                    <option value="">{{$produit->formule->name}}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" name="quantite" class="form-control" id="quantite" placeholder="Quantité" value="{{$produit->quantite}}" required>
            </div>
            <div class="form-group">
                <label for="pu_vente">P.U</label>
                <input type="number" name="pu_vente" class="form-control" id="pu_vente" placeholder="Prix unitaire" value="{{$produit->pu_vente}}" required>
            </div>
            <div class="form-group">
                <label for="remise">Rémise</label>
                <div class="row">
                    <div class="col-sm-8">
                        <input type="number" name="remise" class="form-control" id="remise" placeholder="Rémise" value={{isset($reduction[0]->valeur) == true ? $reduction[0]->valeur : ''}} >
                    </div>
                    <div class="col-sm-4" style="text-align: right;">
                        <input type="checkbox" name="is_percent" id="" {{(isset($reduction[0]->is_percent) && $reduction[0]->is_percent == true )? 'checked' : ''}}>
                        <span>(en %)</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="quantite">Coût essence :</label>
                <input type="number" class="form-control" id="cout_essence" name="cout_essence" placeholder="Coût essence" value="{{$produit->cout_essence}}" >
            </div>
            <div class="form-group">
                <label for="quantite">Coût salarial :</label>
                <input type="number" class="form-control" id="cout_salarial" name="cout_salarial" placeholder="Coût salarial" value="{{$produit->cout_salarial}}" >
            </div>
            <div class="form-group">
                <label for="quantite">Coût livraison :</label>
                <input type="number" class="form-control" id="cout_livraison" name="cout_livraison" placeholder="Coût livraison" value="{{$produit->cout_livraison}}" >
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" placeholder="Description complète">{{$produit->description}}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-modifier-produit" class="btn btn-primary float-right">Sauvegarder</button>
</div>
