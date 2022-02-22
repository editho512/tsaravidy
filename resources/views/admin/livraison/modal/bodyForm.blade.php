

<div class="card card-defalut card-outline">
    <div class="card-body box-profile">
        <div class="row">
            <div class="col-sm-12">
                <table id="body-form-livraison" class="table table-bordered table-striped dataTable dtr-inline">
                    <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Non-livrée</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <!--<th>Rémise</th>-->
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                            <tr class="liste-produit" data-id="{{$produit->id}}">
                                <td>{{$produit->name}}</td>
                                <td data-value="{{$produit->quantite}}" style="text-align: right;" >{{nombre($produit->quantite)}}</td>
                                <td data-value="{{$produit->pu_vente}}" style="text-align: right;" >{{format_prix($produit->pu_vente)}}</td>
                                <td class="quantite">
                                    <input type="text" data-dispo="{{$produit->dispo}}" class="form-control quantite-a-livree" placeholder="Quantité à livrer {{"( ".$produit->dispo. " disponible(s) )"}}">
                                </td>
                                <!--
                                <td >
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <input type="text"  class="form-control" placeholder="Rémise">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="checkbox" name="type_remise" id=""  checked>
                                        </div>
                                        <div class="col-sm-2">
                                            <span for="">(en %)</span>
                                        </div>
                                    </div>
                                </td>-->
                                <td>0 Ar</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<script>
    $("#body-form-livraison").DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                language: { url: "{{asset('assets/json/json_fr_fr.json')}}" }
            });

    $(document).on("keyup", ".quantite-a-livree", function () {
        let quantite = $(this).val();
        let montant = 0;
        let non_livree = $(this).attr("data-dispo");

        if(parseFloat(quantite) > parseFloat(non_livree)){
            $(this).addClass("is-invalid");
        }else{
            $(this).removeClass("is-invalid");
        }

        if(quantite != undefined && quantite != ""){
            let pu = $(this).parent().prev().attr("data-value");
            montant = parseFloat(pu) * parseFloat(quantite);
        }
            $(this).parent().next().html(montant+" Ar");
    })
</script>
