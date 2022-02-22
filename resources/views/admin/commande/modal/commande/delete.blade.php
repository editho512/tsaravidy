<div class="modal-header modal-header-danger">
    <h4 class="modal-title">Supprimer commande : {{$commande->numero_bc}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('commande.single.delete', ['commande' => $commande->id])}}" role="form" id="form-supprimer-commande" method="POST">
        @csrf
        @method('delete')
        <div class="form-group">
            <label for="client">Client</label>
            <input type="text" name="user" class="form-control" id="client" value="{{$commande->user}}" placeholder="Nom client ou société" disabled>
        </div>
        <div class="form-group">
            <label for="numero_bc">Numéro BC</label>
            <input type="text" name="numero_bc" class="form-control" id="numero_bc" value="{{$commande->numero_bc}}" placeholder="Bon de commande n°" disabled>
        </div>
        <!-- Date dd/mm/yyyy -->
        <div class="form-group">
            <label>Date de livraison :</label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="text" class="form-control" name="date_livraison" value="{{date_format($commande->date_livraison, 'd/m/Y')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask disabled>
            </div>
            <!-- /.input group -->
        </div>
        <!-- Date dd/mm/yyyy -->
        <div class="form-group">
            <label>Date de paiement :</label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="text" class="form-control" name="date_paiement" value="{{date_format($commande->date_paiement, 'd/m/Y')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask disabled>
            </div>
            <!-- /.input group -->
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea  class="form-control" name="description" id="description" placeholder="Description de la commande" disabled>{{$commande->description}}</textarea>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-supprimer-commande" class="btn btn-danger float-right">Supprimer</button>
</div>
