<div class="modal-header modal-header-danger">
    <h4 class="modal-title">Supprimer Matière "{{$matiere->name}}"</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('matiere.single.delete', ['matiere' => $matiere->id])}}" role="form" id="form-supprimer-matiere" method="POST">
        @csrf
        @method('delete')
        <div class="card-body">
            <div class="form-group">
                <label for="">Designation</label>
                <input type="text" name="name" class="form-control" id="" placeholder="Designation" value="{{$matiere->name}}" disabled>
            </div>
            <div class="form-group">
                <label for="unite">Unité</label>
                <input type="text" name="unite" class="form-control" id="unite"
                       placeholder="Unité" value="{{$matiere->unite}}" disabled>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" disabled>{{$matiere->description}}</textarea>
            </div>
        </div>
        @if($matiere->isInUse())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Attention!</h5>
                Cette matière prémière est utilisé dans les formules suivantes :

                <ul>
                    @foreach($matiere->formuleInUse() as $formule)
                        <li>{{$formule->name}}</li>
                    @endforeach
                </ul>

            </div>
        @endif
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    @if(!$matiere->isInUse())
        <button type="submit" form="form-supprimer-matiere" class="btn btn-danger float-right">Supprimer</button>
    @endif
</div>
