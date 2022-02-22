<div class="modal-header modal-header-primary">
    <h4 class="modal-title">Modifier Matière "{{$matiere->name}}"</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('matiere.update', ['matiere' => $matiere->id])}}" role="form" id="form-modifier-matiere" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="">Designation</label>
                <input type="text" name="name" class="form-control" id="" placeholder="Designation" value="{{$matiere->name}}">
            </div>
            <div class="form-group">
                <label for="unite">Unité</label>
                <input type="text" name="unite" class="form-control" id="unite"
                       placeholder="Unité" value="{{$matiere->unite}}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description"
                          placeholder="Description...">{{$matiere->description}}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-modifier-matiere" class="btn btn-primary float-right">Sauvegarder</button>
</div>
