<div class="modal-header modal-header-danger">
    <h4 class="modal-title">Supprimer production {{$production->produit->name}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('commande.production.delete', ['production' => $production->id])}}" role="form" id="form-supprimer-production" method="POST">
        @csrf
        @method('delete')
        <div class="card-body">
            <div class="form-group">
                <label for="">Formule</label>
                <input type="text" name="" class="form-control" id="" placeholder="Formule" value="{{$production->produit->formule->name}}" disabled>
            </div>
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
                <label>Date de production :</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" name="date_production" value="{{date_format($production->date_production, 'd/m/Y H:i')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy HH:MM" data-mask disabled>
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                <label for="">Nombre cyble</label>
                <input type="text" name="" class="form-control" id=""
                       placeholder="Nombre total de cycle pour la production" value="{{$production->nombre_cycle}}" disabled>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" name="quantite" class="form-control" id="quantite"
                       placeholder="Quantité" value="{{$production->quantite}}" disabled>
            </div>
            <div class="form-group">
                <label for="nombre_casse">Nombre casse</label>
                <input type="number" name="nombre_casse" class="form-control" id="nombre_casse" value="{{$production->nombre_casse}}"
                       placeholder="Nombre de produit cassé" disabled>
            </div>
            <div class="form-group">
                <label for="date_available">Durée séchage (heure)</label>
                <input type="number" name="date_available" class="form-control" id="date_available"
                       placeholder="Temps estimatif de séchage en heure." value="{{$production->date_production->diffInHours($production->date_available)}}" disabled>
            </div>
            <div class="form-group">
                <label for="commentaire">Commentaire</label>
                <textarea class="form-control" name="commentaire" id="commentaire" disabled>{{$production->commentaire}}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-supprimer-production" class="btn btn-danger float-right">Supprimer</button>
</div>
