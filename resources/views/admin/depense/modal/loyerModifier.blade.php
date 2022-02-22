
<form action="{{route('loyer.update' , ['loyer' => $loyer->id])}}" role="form" id="form-modifier-loyer" method="POST">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="montant">Montant:</label>
            <input type="text" name="montant" class="form-control" id="montant" placeholder="Montant" value='{{$loyer->montant}}' required>
        </div>
        <div class="form-group">
                    @php
                        $date_debut = (date("m", strtotime($loyer->date_debut)))."-".(date("Y", strtotime($loyer->date_debut)));
                    @endphp
            <label for="date">Date d'application :</label>
            <select class="form-control" name="date" id="date" disabled>
                @foreach(liste_date_loyer() as $date_loyer)
                    <option  value="{{$date_loyer['data']}}" {{ $date_debut == $date_loyer['data'] ? 'selected' : ''}}>{{$date_loyer['label']}}</option>
                @endforeach
            </select>
        </div>
        
    </div>
    <!-- /.card-body -->
</form>