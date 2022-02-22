<form action="{{route('formule.single.update', ['formule' => $formule->id])}}" role="form" id="form-modif-formule" method="POST">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">Designation</label>
            <input type="text" name="name" class="form-control" id="name" value="{{$formule->name}}" placeholder="Designation formule" required>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="text" name="quantite" class="form-control" id="quantite" value="{{$formule->quantite}}" placeholder="Estimation nombre par cycle" required>
        </div>
        <div class="form-group">
            <label for="quantite">Coût essence :</label>
            <input type="number" class="form-control" id="cout_essence" name="cout_essence" placeholder="Coût essence" value="{{$formule->cout_essence}}" required>
        </div>
        <div class="form-group">
            <label for="quantite">Coût salarial :</label>
            <input type="number" class="form-control" id="cout_salarial" name="cout_salarial" placeholder="Coût salarial" value="{{$formule->cout_salarial}}" required>
        </div>
        <div class="form-group">
            <label for="quantite">Coût livraison :</label>
            <input type="number" class="form-control" id="cout_livraison" name="cout_livraison" placeholder="Coût livraison" value="{{$formule->cout_livraison}}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Description complète">{{$formule->description}}</textarea>
        </div>
    </div>
    <!-- /.card-body -->
</form>
