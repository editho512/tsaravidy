<div class="modal-header modal-header-primary">
    <h4 class="modal-title">Modifier {{$formuleProduit->matiere->name.' ('.$formuleProduit->matiere->unite.')'}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('formule.update', ['formuleProduit' => $formuleProduit->id])}}" role="form" id="form-modifier-matiere" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="valeur">Quantité</label>
                <input type="number" name="valeur" class="form-control" id="valeur" placeholder="Quantité" value="{{$formuleProduit->valeur}}" step="any" required>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
    <form action="{{route('formule.destroy', ['formuleProduit' => $formuleProduit->id])}}" method="POST" id="form-supprimer-matiere" style="display: none">
        @csrf
        @method('DELETE')
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-supprimer-matiere" class="btn btn-danger float-right">Supprimer</button>
    <button type="submit" form="form-modifier-matiere" class="btn btn-primary float-right">Sauvegarder</button>
</div>
