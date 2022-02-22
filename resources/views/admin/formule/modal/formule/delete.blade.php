<div class="modal-header modal-header-danger">
    <h4 class="modal-title">Supprimer produit "{{$formule->name}}"</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('formule.single.delete', ['formule' => $formule->id])}}" role="form" id="form-supprimer-formule" method="POST">
        @csrf
        @method('delete')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Designation</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$formule->name}}" disabled>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité (estimation)</label>
                <input type="text" name="quantite" class="form-control" id="quantite" value="{{$formule->quantite}}" disabled>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" disabled>{{$formule->description}}</textarea>
            </div>
        </div>
        @if($formule->isInUse())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Attention!</h5>
                Cette formule est utilisé dans les produits suivantes :

                <ul>
                    @foreach($formule->produits as $produit)
                        <li>{{$produit->name.' - BC n° '.$produit->commande->numero_bc}}</li>
                    @endforeach
                </ul>

            </div>
    @endif
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    @if(!$formule->isInUse())
        <button type="submit" form="form-supprimer-formule" class="btn btn-danger float-right">Supprimer</button>
    @endif
</div>
