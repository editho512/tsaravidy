<div class="modal-header modal-header-primary">
    <h4 class="modal-title">Modifier commande : {{$commande->numero_bc}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('commande.single.update', ['commande' => $commande->id])}}" role="form" id="form-modif-commande" method="POST">
        @csrf
        <div class="form-group">
            <label for="client">Client</label>
            <input type="text" name="user" class="form-control" id="client" value="{{$commande->user}}" placeholder="Nom client ou société" required>
        </div>
        <div class="form-group">
            <label for="numero_bc">Numéro BC</label>
            <input type="text" name="numero_bc" class="form-control" id="numero_bc" value="{{$commande->numero_bc}}" placeholder="Bon de commande n°" required>
        </div>
        <!-- Date dd/mm/yyyy -->
        <div class="form-group">
            <label>Date de livraison :</label>

            <div class="input-group">
                <div class="input-group date" id="date_livraison_edit" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#date_livraison_edit" name="date_livraison" value="{{date_format($commande->date_livraison, 'd/m/Y')}}" required/>
                    <div class="input-group-append" data-target="#date_livraison_edit" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <!-- /.input group -->
        </div>
        <!-- Date dd/mm/yyyy -->
        <div class="form-group">
            <label>Date de paiement :</label>

            <div class="input-group">
                <div class="input-group date" id="date_paiement_edit" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#date_paiement_edit" name="date_paiement" value="{{date_format($commande->date_paiement, 'd/m/Y')}}" required/>
                    <div class="input-group-append" data-target="#date_paiement_edit" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <!-- /.input group -->
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea  class="form-control" name="description" id="description" placeholder="Description de la commande">{{$commande->description}}</textarea>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-modif-commande" class="btn btn-primary float-right">Sauvegarder</button>
</div>
