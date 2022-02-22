@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | Depense</title>
@endsection

@section('styles')

@endsection
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@section('content')
   
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper teste" style="min-height: inherit!important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Depenses</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                  <a class="nav-item nav-link {{ (isset($tabActive) === true && $tabActive == 'depense' )  ? 'active' : ''}}" id="nav-depense-tab"  data-toggle="tab" href="#nav-depense" role="tab" aria-controls="nav-depense" aria-selected="true">Depense</a>
                                  <a class="nav-item nav-link {{ (isset($tabActive) === true && $tabActive == 'loyer' )  ? 'active' : ''}}" id="nav-loyer-tab"  data-toggle="tab" href="#nav-loyer" role="tab" aria-controls="nav-loyer" aria-selected="false">Loyer</a>
                                </div>
                              </nav>
                              <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade {{ (isset($tabActive) === true && $tabActive == 'depense' )  ? 'show active' : ''}}" id="nav-depense" role="tabpanel" aria-labelledby="nav-depense-tab">
                                    <div class="card-header">
                                        <h3 class="card-title">Frais divers</h3>
                                        <button class="float-right btn btn-success" id="btn-modal-default" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span>&nbsp;Ajouter</button>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Designation</th>
                                                <th>Numéro BL</th>
                                                <th>Type</th>
                                                <th>Fournisseur</th>
                                                <th>Quantité</th>
                                                <th>Unité</th>
                                                <th>P.U</th>
                                                <th>Montant</th>
                                                <th>Frais de livraison</th>
                                                <th>Mode paiement</th>
                                                @can("viewAny" , auth()->user())
                                                <th>Actions</th>
                                                @endcan
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($depenses))
                                                @foreach($depenses as $depense)
                                                    <tr>
                                                        <td>{{$depense->created_at}}</td>
                                                        <td>{{$depense->name}}</td>
                                                        <td>{{$depense->numero_bl}}</td>
                                                        <td>{{$depense->type}}</td>
                                                        <td>{{$depense->fournisseur}}</td>
                                                        <td>{{ nombre($depense->quantite)}}</td>
                                                        <td>{{$depense->unite}}</td>
                                                        <td >{{ format_prix($depense->pu)}}</td>
                                                        <td>{{ format_prix($depense->montant)}}</td>
                                                        <td>{{ format_prix($depense->frais_livraison)}}</td>
                                                        <td>{{$depense->mode_paiement}}</td>
                                                        @can("viewAny" , auth()->user())
                                                        <td>
                                                            <a href data-toggle="modal" id="{{$depense->id}}" data-target="#modal-modif-depense" onclick="getDataDepense(this.id)"><i class="fa fa-edit"></i></a>
                                                            <a href data-toggle="modal" id="{{$depense->id}}" data-target="#modal-supprimer-depense" onclick="getDataDepenseDelete(this.id)"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                        @endcan
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Designation</th>
                                                <th>Numéro BL</th>
                                                <th>Type</th>
                                                <th>Fournisseur</th>
                                                <th>Quantité</th>
                                                <th>Unité</th>
                                                <th>P.U</th>
                                                <th>Montant</th>
                                                <th>Frais de livraison</th>
                                                <th>Mode paiement</th>
                                                @can("viewAny" , auth()->user())
                                                <th>Actions</th>
                                                @endcan
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <div class="tab-pane fade {{ (isset($tabActive) === true && $tabActive == 'loyer' )  ? 'show active' : ''}}" id="nav-loyer" role="tabpanel" aria-labelledby="nav-loyer-tab">
                                    <div class="card-header">
                                        <h3 class="card-title">Loyer mensuel</h3>
                                        <button class="float-right btn btn-success" id="btn-modal-loyer" data-toggle="modal" data-target="#modal-loyer"><span class="fa fa-plus"></span>&nbsp;Ajouter</button>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Entrer en vigueur</th>
                                                <th>Montant</th>
                                                @can("viewAny" , auth()->user())
                                                <th style="text-align:center;">Actions</th>
                                                @endcan
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($loyers))
                                                @foreach($loyers as $loyer)
                                                    <tr>
                                                        <td>{{mois(date("m", strtotime($loyer->date_debut)))." ".date("Y", strtotime($loyer->date_debut)) }}</td>
                                                        
                                                        <td>{{ format_prix($loyer->montant)}}</td>
                                                        @can("viewAny" , auth()->user())
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-sm-12" style="text-align: center;">
                                                                    <a alt='Modifier le loyer' href="#" onclick="modifierLoyer('{{route('loyer.edit.show', ['loyer' => $loyer->id])}}')" data-toggle="modal" data-target="#modal-loyer-modifier"><span class='fa fa-cog'></span></a>
                                                                    <a alt='Supprimer le loyer' href="#" onclick="supprimerLoyer('{{route('loyer.delete.show', ['loyer' => $loyer->id])}}')" data-toggle="modal" data-target="#modal-supprimer-loyer" ><span class='fa fa-trash'></span></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @endcan
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Entrer en vigueur</th>
                                                <th>Montant</th>
                                                @can("viewAny" , auth()->user())
                                                <th style="text-align:center;">Actions</th>
                                                @endcan
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                              </div>
                            
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('modals')
    <!-- /.modal ajouter commandes -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajouter une depense</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('depense.create')}}" role="form" id="form-ajout-depense" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Designation</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Designation" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option selected value=0 >Choisissez un type de dépense</option>
                                    @foreach($types as $type)
                                        <option  value="{{$type}}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="type_content"></div>
                            <div class="form-group">
                                <label for="numero_bl">Numéro BL</label>
                                <input type="text" name="numero_bl" class="form-control" id="numero_bl" placeholder="Bon de livraison n°" required>
                            </div>
                            <div class="form-group">
                                <label for="fournisseur">Fournisseur</label>
                                <input type="text" name="fournisseur" class="form-control" id="fournisseur" placeholder="Fournisseur" required>
                            </div>
                            <div class="form-group">
                                <label for="quantite">Quantité</label>
                                <input type="number" name="quantite" class="form-control" id="quantite" placeholder="Quantité" required>
                            </div>
                            <div class="form-group">
                                <label for="unite">Unité</label>
                                <input type="text" name="unite" class="form-control" id="unite" placeholder="Unité" required>
                            </div>
                            <div class="form-group">
                                <label for="pu">P.U</label>
                                <input type="number" name="pu" class="form-control" id="pu" placeholder="Prix unitaire" required>
                            </div>
                            <div class="form-group">
                                <label for="frais_livraison">Frais</label>
                                <input type="number" name="frais_livraison" class="form-control" id="frais_livraison" placeholder="Frais de livraison" value="0" required>
                            </div>
                            <div class="form-group">
                                <label for="mode_paiement">Mode de paiement</label>
                                <select name="mode_paiement" class="form-control" id="mode_paiement" onchange="is_credit(this);" required>
                                    <option value="comptant">Comptant</option>
                                    <option value="credit">Crédit</option>
                                </select>
                            </div>
                            <div id="is_credit" class="form-group">

                            </div>
                            <div class="form-group">
                                <label for="commentaire">Commentaire</label>
                                <textarea name="commentaire" class="form-control" id="commentaire" placeholder="Votre commentaire ici..."></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-ajout-depense" class="float-right btn btn-success">Enregistrer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter commandes -->

    <!-- /.modal ajouter loyer -->
    <div class="modal fade" id="modal-loyer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajouter un loyer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('depense.loyer.create')}}" role="form" id="form-ajout-loyer" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="montant">Montant:</label>
                                <input type="text" name="montant" class="form-control" id="montant" placeholder="Montant" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date d'application :</label>
                                <select class="form-control" name="date" id="date" required>
                                    @foreach(liste_date_loyer() as $date_loyer)
                                        <option  value="{{$date_loyer['data']}}">{{$date_loyer['label']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-ajout-loyer" class="float-right btn btn-success">Enregistrer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter loyer -->

    <!-- /.modal modifier loyer -->
    <div class="modal fade" id="modal-loyer-modifier">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 class="modal-title">Modifier un loyer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-modifier-loyer" class="float-right btn btn-primary">Enregistrer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier loyer -->

    <!--.modal Supprimer loyer -->
    <div class="modal fade" id="modal-supprimer-loyer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <h4 class="modal-title">Supprimer une loyer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-supprimer-body">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-supprimer-loyer" class="float-right btn btn-danger">Supprimer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Supprimer commandes -->



    <!-- type content pour charge salarial mensuel -->
    <div id="content-charge_salarial">
            <input type="hidden" name="salaire" class="salarie_data" value="">
            <div class="form-group">
                <label for="nombre_salarie">Salarié :</label>
                <div id="salarie_formulaire">
                    <div class="row">
                        <div class="col-sm-6" style="padding-top:1%;">
                            <input type="text" placeholder="Nom du salarié" name="nom_salarie" class='form-control salariale' required>
                        </div>
                        <div class="col-sm-6" style="padding-top:1%;">
                            <input type="text" placeholder="Montant salaire" name="montant_salaire" class='form-control salariale' required>
                        </div>
                    </div>
                </div>
                <div class="mt-1 row">
                    <div class="col-sm-12" style="text-align:right;">
                        <button  type="button" class="btn btn-sm btn-salarie-moins" style="border:solid 1px rgba(147,155,162,0.8);color:rgba(147,155,162,0.8);display:none;"><span class="fa fa-minus"></span></button>

                        <button  type="button" class="btn btn-sm btn-salarie-plus" style="border:solid 1px rgba(147,155,162,0.8);color:rgba(147,155,162,0.8);"><span class="fa fa-plus"></span></button>
                    </div>
                </div>
            </div>

    </div>
    <!-- /type content pour charge salarial mensuel -->
    <!--.modal Modifier commandes -->
    <div class="modal fade" id="modal-modif-depense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 class="modal-title">Modifier une depense</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-modif-body">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-modif-depense" class="float-right btn btn-primary">Enregistrer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier commandes -->

    <!--.modal Supprimer commandes -->
    <div class="modal fade" id="modal-supprimer-depense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <h4 class="modal-title">Supprimer une depense</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-supprimer-body">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-supprimer-depense" class="float-right btn btn-danger">Supprimer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Supprimer commandes -->
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('assets/adminlte/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- page script -->
    <script>
        $(function () {

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
            //Money Euro
            $('[data-mask]').inputmask();


            $("#example1 , #example2 ").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [ { width: 80, targets: 7 } ],
                language: { url: "{{asset('assets/json/json_fr_fr.json')}}" }

            });
           
        });

        var nb_salarie_formulaire = 0;

        function is_credit(el) {
            if ($(el).val() == 'credit'){
               $('#is_credit').html('<div class="form-group">\n' +
                    '                                    <label for="montant_credit">Montant crédit</label>\n' +
                    '                                    <input type="number" name="montant_credit" class="form-control" id="montant_credit" placeholder="Montant du crédit" required>\n' +
                    '                                </div>\n' +
                    '                                <div class="form-group">\n' +
                    '                                    <label>Date d\'echéance crédit :</label>\n' +
                    '                                    <div class="input-group">\n' +
                    '                                        <div class="input-group-prepend">\n' +
                    '                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>\n' +
                    '                                        </div>\n' +
                    '                                        <input type="text" class="form-control" name="date_credit" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>\n' +
                    '                                    </div>\n' +
                    '                                </div>');
            }else{
                $('#is_credit').html('');
            }

            $('[data-mask]').inputmask();
        }

        function getDataDepense(depense_id) {

            $('#modal-modif-body').empty();

            $.ajax({
                url: "{{ url('depense') }}/" + depense_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body').html(data);

                    let charge_type = $("#modal-modif-body  #type option:selected").val();
                    maj_locative_form(charge_type);
                    

                    $('[data-mask]').inputmask();
                }
            });

        }

        function getDataDepenseDelete(depense_id) {

            $('#modal-supprimer-body').empty();

            $.ajax({
                url: "{{ url('depense/supprimer') }}/" + depense_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-supprimer-body').html(data);

                    let charge_type = $("#modal-supprimer-body #type").val();
                    maj_locative_form(charge_type);

                    $('[data-mask]').inputmask();
                    

                }
            });

        }

        $(document).on("change", '#type' , function(e){
            let value_type = $(this).find('option:selected').val();

            if(value_type == 'Charge salariale mensuelle'){ 
                    remise_zero_salarie();
                    $(".type_content").html($("#content-charge_salarial").html());
                   
            }

            maj_locative_form(value_type);
        });

        $(document).on("click", ".btn-salarie-plus" , function(e){
            _this = $(this).parent().parent().parent();
            nb_salarie_formulaire = _this.find("#salarie_formulaire .row").length + 1;
            console.log($('#salarie_formulaire_added-'+nb_salarie_formulaire));

            if(nb_salarie_formulaire > 1){
                $(".btn-salarie-moins").show(100);
            }
            let salarie_formulaire = _this.find("#salarie_formulaire").find(".row:first").html();

            _this.find("#salarie_formulaire")
                .append("<div id='salarie_formulaire_added-"+
                        nb_salarie_formulaire+"' class='row'>"+salarie_formulaire
                    +"</div>").find(".row:last input").val("");
            $(".type_content input").trigger("blur");

        })

        $(document).on("click", ".btn-salarie-moins" , function(e){
            _this = $(this).parent().parent().parent();
            nb_salarie_formulaire = _this.find("#salarie_formulaire .row").length;
            console.log($('#salarie_formulaire_added-'+nb_salarie_formulaire));
            _this.find('#salarie_formulaire_added-'+nb_salarie_formulaire).remove();

            if(nb_salarie_formulaire < 3){
                $(".btn-salarie-moins").hide(100);
            }
            $(".type_content input").trigger("blur");
        })

        $(document).on("blur", ".type_content input" , function(e){
            //Récuperation des données relative au salarié avant de l'ajouter dans un input de type hidden(caché) pour pouvoir l'envoyer en post sous format json
            let data_salarie = [];
            _this = $(this).parent().parent().parent().parent();
            _this.find('#salarie_formulaire .row').each(function(){

                let salarie_nom = $(this).find("input:first").val();

                let salarie_montant = $(this).find("input:last").val();

                if(salarie_montant != '' && salarie_nom != ''){

                    data_salarie.push({
                        salarie_nom : salarie_nom ,
                        salarie_montant : salarie_montant
                    });
                }
            })
            console.log(data_salarie);
            _this.parent().parent().parent().find(".salarie_data").val(JSON.stringify(data_salarie));
        })

        $(document).on("click", "#btn-modal-default" , function(){
            remise_zero_salarie();
            $("#modal-default  #type").change();
        })

        function remise_zero_salarie(){
            nb_salarie_formulaire = 0;
        }

        function maj_locative_form(value_type){
            $("#modal-default input:not(.salariale) , #modal-modif-depense input:not(.salariale) , #modal-supprimer-body input:not(.salariale) ").parent().show(300);
            

            if(value_type == 'Charge salariale mensuelle'){ 
                   
                    $("#modal-default input:not(.salariale) , #modal-modif-depense input:not(.salariale) , #modal-supprimer-body input:not(.salariale) ").removeAttr("required");
                    $("#numero_bl , #fournisseur , #quantite , #unite , #pu , #frais_livraison").val("").parent().hide(200);
            }
            else if(value_type == "Charge locative"){
                    $("#modal-default input , #modal-modif-depense input ").attr("required" , true);
                    $(".type_content").html("");
                    $("#modal-default #numero_bl , #modal-modif-depense #numero_bl , #modal-supprimer-body #numero_bl").attr("placeholder" , "Facture de location n°:").prev().html("Numéro de facture");
                    $("#modal-default #fournisseur , #modal-modif-depense #fournisseur , #modal-supprimer-body #fournisseur ").attr("placeholder" , "Propriétaire").prev().html("Propriétaire");
                    
            }
            else if(value_type == "Charge de maintenance machine"){
                    $("#modal-default input , #modal-modif-depense input ").attr("required" , true);
                    $("#modal-default #unite , #modal-modif-depense #unite , #modal-supprimer-body #unite").removeAttr("required").val("").parent().hide(200);
                    $("#modal-default #quantite , #modal-modif-depense #quantite , #modal-supprimer-body #quantite").removeAttr("required").val("").parent().hide(200);

                    $(".type_content").html("");
                    $("#modal-default #numero_bl , #modal-modif-depense #numero_bl , #modal-supprimer-body #numero_bl").attr("placeholder" , "Facture n°:").prev().html("Numéro de facture");
                    $("#modal-default #fournisseur , #modal-modif-depense #fournisseur , #modal-supprimer-body #fournisseur ").attr("placeholder" , "Fournisseur").prev().html("Fournisseur");
                    $("#modal-default #pu , #modal-modif-depense #pu , #modal-supprimer-body #pu ").attr("placeholder" , "Montant").prev().html("Montant");

            }
            else if(value_type == "Dépenses divers"){

                    $("#modal-default input , #modal-modif-depense input ").attr("required" , true);
                    $("#modal-default #unite , #modal-modif-depense #unite , #modal-supprimer-body #unite").removeAttr("required").val("").parent().hide(200);
                    $("#modal-default #quantite , #modal-modif-depense #quantite , #modal-supprimer-body #quantite").removeAttr("required").val("").parent().hide(200);

                    $(".type_content").html("");
                    $("#modal-default #numero_bl , #modal-modif-depense #numero_bl , #modal-supprimer-body #numero_bl").attr("placeholder" , "Facture n°:").prev().html("Numéro de facture");
                    $("#modal-default #fournisseur , #modal-modif-depense #fournisseur , #modal-supprimer-body #fournisseur ").attr("placeholder" , "Fournisseur").prev().html("Fournisseur");
                    $("#modal-default #pu , #modal-modif-depense #pu , #modal-supprimer-body #pu ").attr("placeholder" , "Montant").prev().html("Montant");


            }
            else if(value_type == "Agios"){

                    $("#modal-default input , #modal-modif-depense input ").attr("required" , true);
                    $("#modal-default #unite , #modal-modif-depense #unite , #modal-supprimer-body #unite ").removeAttr("required").val("").parent().hide(200);
                    $("#modal-default #quantite , #modal-modif-depense #quantite , #modal-supprimer-body #quantite").removeAttr("required").val("").parent().hide(200);

                    $(".type_content").html("");
                    $("#modal-default #numero_bl , #modal-modif-depense #numero_bl , #modal-supprimer-body #numero_bl").attr("placeholder" , "Facture n°:").prev().html("Numéro de facture");
                    $("#modal-default #fournisseur , #modal-modif-depense #fournisseur , #modal-supprimer-body #fournisseur ").attr("placeholder" , "Fournisseur").prev().html("Fournisseur");
                    $("#modal-default #pu , #modal-modif-depense #pu , #modal-supprimer-body #pu ").attr("placeholder" , "Montant").prev().html("Montant");


            }
            else if(value_type == "Carburant par semaine"){

                    $("#modal-default input , #modal-modif-depense input ").attr("required" , true);
                   
                    $(".type_content").html("");
                    $("#modal-default #numero_bl , #modal-modif-depense #numero_bl , #modal-supprimer-body #numero_bl").attr("placeholder" , "Facture n°:").prev().html("Numéro de facture");
                    $("#modal-default #fournisseur , #modal-modif-depense #fournisseur , #modal-supprimer-body #fournisseur ").attr("placeholder" , "Fournisseur").prev().html("Fournisseur");
                    $("#modal-default #pu , #modal-modif-depense #pu , #modal-supprimer-body #pu ").attr("placeholder" , "Montant").prev().html("Montant");


            }
            else{
                    $("#modal-default input , #modal-modif-depense input ").attr("required" , true);
                    $(".type_content").html("");
                    $("#numero_bl , #fournisseur , #quantite , #unite , #pu , #frais_livraison").parent().show(200);

                    $("#numero_bl").attr("placeholder" , "Bon de livraison n°").prev().html("Numéro BL");
                    $("#fournisseur").attr("placeholder" , "Fournisseur").prev().html("Fournisseur");
            }
        }

        function modifierLoyer(url) {
            $.get(url, {}, dateType = "HTML").done(function (data) {
                console.log(data);
                $("#modal-loyer-modifier .modal-body").html(data);
            });
        }

        function supprimerLoyer(url) {
            $.get(url, {}, dateType = "HTML").done(function (data) {
                console.log(data);
                $("#modal-supprimer-loyer .modal-body").html(data);
            });
        }

    </script>
@endsection

