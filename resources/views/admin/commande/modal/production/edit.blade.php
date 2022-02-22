<div class="modal-header modal-header-primary">
    <h4 class="modal-title">Modifier production {{$production->produit->name}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{route('commande.produit.update', ['production' => $production->id])}}" role="form" id="form-modifier-production" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="">Formule</label>
                <input type="text" name="" class="form-control" id="" placeholder="Formule" value="{{$production->produit->formule->name}}" disabled>
            </div>
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
                <label>Date de production :</label>
                <div class="input-group">
                    <div class="input-group date" id="date_production_edit" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#date_production_edit" name="date_production" value="{{date_format($production->date_production, 'd/m/Y')}}" required/>
                        <div class="input-group-append" data-target="#date_production_edit" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                <label for="">Nombre cycle</label>
                <input type="text" name="" class="form-control" id=""
                       placeholder="Nombre total de cycle pour la production" value="{{$production->nombre_cycle}}" disabled required>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité (max: {{$production->quantite+$production->produit->quantiteAProduire()}})</label>
                <input type="number" name="quantite" class="form-control" id="quantite"
                       placeholder="Quantité" value="{{$production->quantite}}" max="{{$production->quantite+$production->produit->quantiteAProduire()}}" required>
            </div>
            <div class="form-group">
                <label for="nombre_casse">Nombre casse</label>
                <input type="number" name="nombre_casse" class="form-control" id="nombre_casse" value="{{$production->nombre_casse}}"
                       placeholder="Nombre de produit cassé" required>
            </div>
            <div class="form-group">
                <label for="date_available">Durée séchage (heure)</label>
                <input type="number" name="date_available" class="form-control" id="date_available"
                       placeholder="Temps estimatif de séchage en heure." value="{{$production->date_production->diffInHours($production->date_available)}}" required>
            </div>
            <div class="form-group">
                <label for="commentaire">Commentaire</label>
                <textarea class="form-control" name="commentaire" id="commentaire"
                          placeholder="Commentaire...">{{$production->commentaire}}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" form="form-modifier-production" class="btn btn-primary float-right">Sauvegarder</button>
</div>
