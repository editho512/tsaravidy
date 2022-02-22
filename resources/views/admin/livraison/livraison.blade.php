@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | Livraison</title>
@endsection

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

@endsection
@section('content')
   
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper teste" style="min-height: inherit!important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Livraison</h1>
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
                            <div class="card-header">
                                <h3 class="card-title">Liste des livraisons</h3>
                                <button class="btn btn-success float-right" id="ajouter-livraions" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span>&nbsp;Ajouter</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            
                                <table  id="livraisons" class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th>Numéro BL</th>
                                            <th>Numéro BC</th>
                                            <th>Client</th>
                                            <th>date de livraison</th>
                                            <th style="text-align: center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($livraisons) === true && $livraisons->count() > 0)
                                            @foreach ($livraisons as $livraison)

                                                <tr>
                                                    <td>{{$livraison->numero_bl}}</td>
                                                    <td>{{$livraison->numero_bc}}</td>
                                                    <td>{{$livraison->user}}</td>
                                                    <td>{{date("d-m-Y", strtotime($livraison->date_livraison))}}</td>
                                                    <td class="row">
                                                        <div class="col-sm-12" style="text-align: center;">
                                                            <a href="#" class="voir-bon_livraison" data-url = "{{route('livraison.bon_livraison' , ['livraison' => $livraison->id])}}"  data-download = "{{route('livraison.download', ['livraison' => $livraison->id])}}">
                                                                <span class="fa fa-eye"></span>
                                                            </a>
                                                            <a href="#" class="modifier-bon_livraison"  data-show = "{{route('livraison.modifier_bon_livraison', ['livraison' => $livraison->id])}}" >
                                                                <span class="fa fa-edit"></span>
                                                            </a>
                                                            <a href="#" class="supprimer-bon_livraison" data-url="{{route('livraison.delete_bon_livraison', ['livraison' => $livraison->id])}}"  data-show = "{{route('livraison.supprimer_bon_livraison', ['livraison' => $livraison->id])}}" >
                                                                <span class="fa fa-trash"></span>
                                                            </a>
                                                        </div>

                                                    </td>
                                                </tr>
                                                
                                            @endforeach
                                        @else

                                            <tr>
                                                <td colspan=4 style="text-align: center;" >
                                                        <p>Aucun livraison dans la liste</p>
                                                </td>
                                            </tr>
                                            
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Numero BL</th>
                                            <th>Numéro BC</th>
                                            <th>Client</th>
                                            <th>date de livraison</th>
                                            <th style="text-align: center">Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                      
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
    <!-- /.modal ajouter livraison -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog " style="min-width:70% !important;">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Livrer une commande</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('livraison.ajouter')}}" role="form" id="form-ajout-livraison" method="POST">
                        @csrf
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">

                                <h3 class="profile-username text-center">Information général:</h3>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="row mt-1">
                                            <div class="col-md-4">
                                                <label for="adresse">Adresse :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="adresse" name="adresse" class="form-control" value="{{isset($info->adresse) ? $info->adresse : 'Rue de commerce Ampasiamazava'}}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-4">
                                                <label for="phone">Téléphone :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="phone" name="phone" class="form-control" value="{{isset($info->telephone) ? $info->telephone : '+261 32 71 979 15'}}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-4">
                                                <label for="mail">Email :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="mail" name="mail" class="form-control" value="{{isset($info->email) ? $info->email : 'hismaljee@gmail.com'}}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-4">
                                                <label for="nif">NIF :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="nif" name="nif" class="form-control" value="{{isset($info->nif) ? $info->nif : '123 456 789 0258'}}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-4">
                                                <label for="stat">STAT :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="stat" name="stat" class="form-control" value="{{isset($info->stat) ? $info->stat : '987 654 321'}}" required>
                                            </div>
                                        </div>
                                        

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mt-1">
                                            <div class="col-md-4">
                                                <label for="rcs">RCS :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="rcs" name="rcs" class="form-control" value="{{isset($info->rcs) ? $info->rcs : '028546'}}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label for="commande">Commande :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="commande" id="livraison_commande" class="form-control" autocomplete="off">
                                                    <option value=0>Numero de BC</option>
                                                    @if (isset($commandes) === true && $commandes->count() > 0)
                                                        @foreach ($commandes as $commande)
                                                            <option value={{$commande->id}}>{{$commande->numero_bc}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2" style="display: none;">
                                            <div class="col-md-4">
                                                <label for="client">Client :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="client" name="client" id="livraison_client" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2" >
                                            <div class="col-md-4">
                                                <label for="client">Numéro BL :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="numero_bl" name="numero_bl" id="" class="form-control" placeholder="Numéro BL" required>
                                            </div>
                                        </div>

                                        <!-- Date dd/mm/yyyy -->
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label>Date de livraison :</label>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="input-group date" id="date_livraison" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#date_livraison" name="date_livraison"  required/>
                                                    <div class="input-group-append" data-target="#date_livraison" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- Date dd/mm/yyyy -->

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card-body -->
                        
                        <div id="livraison_bl_body">

                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4" style="text-align: right !important;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span>Commentaire :</span>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="commentaire" id="commentaire" class="form-control" cols="30" rows="2" placeholder="Votre commentaire" autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer row" style="text-align: right !important;">
                    <button type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">Fermer</button>
                    <button type="button" id="btn-ajout-livraison" class="btn btn-success float-right">Enregistrer</button>
                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter commandes -->

    <!-- /.modal voir livraison -->
    <div class="modal fade" id="modal-voir-bon_livraison">
        <div class="modal-dialog " style="min-width:70% !important;">
            <div class="modal-content">
                <div class="modal-header modal-header-default">
                    <h4 class="modal-title">Bon de livraison</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:3% !important;">
                    
                </div>
                <div class="modal-footer row" style="text-align: right !important;">
                    <button type="button" class="btn btn-default" style="display: none;" data-dismiss="modal">Fermer</button>
                    <a href="">
                        <button type="button" id="btn-voir-livraison" class="btn btn-info float-right">Download</button>
                    </a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal voir livraison -->

    <!-- /.modal modifier livraison -->
    <div class="modal fade" id="modal-modifier-bon_livraison">
        <div class="modal-dialog " style="min-width:70% !important;">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 class="modal-title">Modifier le bon de livraison</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:3% !important;">
                    
                </div>
                <div class="modal-footer row" style="text-align: right !important;">
                    <button type="button" class="btn btn-default" style="display: none;" data-dismiss="modal">Fermer</button>
                    <button type="button" id="btn-modifier-livraison" class="btn btn-primary float-right">Modifier</button>
                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier livraison -->

    <!-- /.modal supprimer livraison -->
    <div class="modal fade" id="modal-supprimer-bon_livraison">
        <div class="modal-dialog " style="min-width:70% !important;">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <h4 class="modal-title">Supprimer le bon de livraison</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:3% !important;">
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <a href="">
                        <button type="button" id="btn-supprimer-livraison" class="btn btn-danger float-right">Supprimer</button>
                    </a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier livraison -->

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


            $("#livraisons").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                language: { url: "{{asset('assets/json/json_fr_fr.json')}}" }
            });
           
        });

        $(document).on("click", ".modal .close", function(e){
            let status = $(this).attr("action");

            if(status === "reload"){

                location.reload(); 

            }
        })

        $(document).on("click", "#ajouter-livraions", function(e){
            $("#numero_bl , #date_livraison input , #commentaire").val("");
            $("#livraison_commande").val(0).change();
            $("#modal-default .modal-body .res").remove();  
            $("#modal-default form").show(100);
            $("#modal-default #btn-voir-livraison").parent().remove();
            $("#modal-default #btn-ajout-livraison").show(100);

        })

        $(document).on("click", "#btn-modifier-livraison", function(e){
            let modal = $(this).parent().parent().parent().parent();

            let url = "{{route('livraison.modifier')}}";

            let adresse = $(".modal-body #modifier_adresse").val();
            let phone = $(".modal-body #modifier_phone").val();
            let email = $(".modal-body #modifier_mail").val();
            let id_commande = $(".modal-body #modifier_livraison_commande option:selected").val();
            let numero_bl = $(".modal-body #modifier_numero_bl").val();
            let date_livraison = $("#modifier_date_livraison input").val();

            let nif = $(".modal-body #modifier_nif").val();
            let stat = $(".modal-body #modifier_stat").val();
            let rcs = $(".modal-body #modifier_rcs").val();


            let liste_produit = [];
            let etat = true;
            //Verification des champs obligatoires
            etat = etat == false ? false : is_empty($(".modal-body #modifier_adresse"), adresse);
            etat = etat == false ? false : is_empty($(".modal-body #modifier_phone"), phone );
            etat = etat == false ? false : is_empty($(".modal-body #modifier_mail"), email);
            etat = etat == false ? false : is_empty($(".modal-body #modifier_numero_bl"), numero_bl);
            etat = etat == false ? false : is_empty($(".modal-body #modifier_date_livraison input"), date_livraison );
            etat = etat == false ? false : is_empty($(".modal-body #modifier_nif"), nif);
            etat = etat == false ? false : is_empty($(".modal-body #modifier_stat"), stat);
            etat = etat == false ? false : is_empty($(".modal-body #modifier_rcs"), rcs);

            //Aucun champs obligatoir n'es vide.
            $(".liste-produit").each(function(index){
                let id = $(this).attr("data-id");
                let quantite = $(this).find(".quantite input").val();
                let dispo = $(this).find(".quantite input").attr("data-dispo");
                if(parseFloat(dispo) < parseFloat(quantite)){
                    etat = false;
                    $(this).find(".quantite input").addClass("is-invalid");
                }else{
                    liste_produit.push({id : id , value : quantite});
                    $(this).find(".quantite input").removeClass("is-invalid");
                }
            })
          
            if(etat === true){

                let dataPost = {
                        _token : "{{ csrf_token() }}",
                        title : {
                            adresse : adresse,
                            phone : phone,
                            email : email,
                            id_commande : id_commande,
                            numero_bl : numero_bl,
                            date_livraison : date_livraison,
                            commentaire : $('#modifier_commentaire').val(),
                            nif : nif,
                            stat : stat,
                            rcs : rcs
                        },
                        content : liste_produit
                    };

                    $.post(url, dataPost, dataType = "HTML").done(function(data){

                        if(data === "0"){
                            $(".quantite input").addClass("is-invalid");
                        }else{

                            if(data.url != undefined){
                                retour_bl(data, modal);
                            }
                            //location.reload(); 
                        }


                    })

                
            }
        });

        $(document).on("click", ".supprimer-bon_livraison", function(e){
            let url = $(this).attr("data-show");
            let url_delete = $(this).attr("data-url");

            $("#btn-supprimer-livraison").parent().attr("href", url_delete);

            $("#modal-supprimer-bon_livraison").modal("show");
            
            $.get(url, {}, dataType="HTML").done(function (data) {
                $("#modal-supprimer-bon_livraison .modal-body").html(data);
            })
        });

        $(document).on("click", ".modifier-bon_livraison", function(e){
            let url = $(this).attr("data-show");
           
            $("#modal-modifier-bon_livraison").modal("show");

            $.get(url, {}, dataType="HTML").done(function (data) {
                $("#modal-modifier-bon_livraison .modal-body").html(data);
            })
        });

        $(document).on("click", ".voir-bon_livraison", function(e){
            $("#modal-voir-bon_livraison").modal("show");
            let url = $(this).attr("data-url");
            let download = $(this).attr("data-download");

            $("#btn-voir-livraison").parent().attr("href", download);

            $.get(url, {}, dataType="HTML").done(function(data){

                $("#modal-voir-bon_livraison .modal-body").html(data);

            });
        });

        $(document).on("click", "#btn-ajout-livraison", function (e) {

            let modal = $(this).parent().parent().parent().parent();


            let url = "{{ route('livraison.ajouter') }}";

            let adresse = $(".modal-body #adresse").val();
            let phone = $(".modal-body #phone").val();
            let email = $(".modal-body #mail").val();
            let id_commande = $(".modal-body #livraison_commande option:selected").val();
            let numero_bl = $(".modal-body #numero_bl").val();
            let date_livraison = $("#date_livraison input").val();

            let nif = $(".modal-body #nif").val();
            let stat = $(".modal-body #stat").val();
            let rcs = $(".modal-body #rcs").val();


            let liste_produit = [];
            let etat = true;
            //Verification des champs obligatoires
            etat = etat == false ? false : is_empty($(".modal-body #adresse"), adresse);
            etat = etat == false ? false : is_empty($(".modal-body #phone"), phone );
            etat = etat == false ? false : is_empty($(".modal-body #mail"), email);
            etat = etat == false ? false : is_empty($(".modal-body #numero_bl"), numero_bl);
            etat = etat == false ? false : is_empty($(".modal-body #date_livraison input"), date_livraison );
            etat = etat == false ? false : is_empty($(".modal-body #nif"), nif);
            etat = etat == false ? false : is_empty($(".modal-body #stat"), stat);
            etat = etat == false ? false : is_empty($(".modal-body #rcs"), rcs);



            //Aucun champs obligatoir n'es vide.
            $(".liste-produit").each(function(index){
                            let id = $(this).attr("data-id");
                            let quantite = $(this).find(".quantite input").val();
                            let dispo = $(this).find(".quantite input").attr("data-dispo");
                            if(parseFloat(dispo) < parseFloat(quantite)){
                                etat = false;
                                $(this).find(".quantite input").addClass("is-invalid");
                            }else{
                                liste_produit.push({id : id , value : quantite});
                                $(this).find(".quantite input").removeClass("is-invalid");
                            }
                        })

          
            if(etat === true){

                let dataPost = {
                    _token : "{{ csrf_token() }}",
                    title : {
                        adresse : adresse,
                        phone : phone,
                        email : email,
                        id_commande : id_commande,
                        numero_bl : numero_bl,
                        date_livraison : date_livraison,
                        commentaire : $('#commentaire').val(),
                        nif : nif,
                        stat : stat,
                        rcs : rcs
                    },
                    content : liste_produit
                };

                $.post(url, dataPost, dataType = "HTML").done(function(data){

                    if(data === "0"){
                        $(".quantite input").addClass("is-invalid");
                    }else{

                        if(data.url != undefined){
                            retour_bl(data, modal);
                        }
                        //location.reload(); 
                    }
                })
            }
        })

        $(document).on("change", "#livraison_commande", function () {
            
            let value = $(this).find("option:selected").val();

            if(value == 0){
                
                $("#livraison_client").parent().parent().hide(200);
                $("#livraison_bl_body").html("");
                $("#btn-ajout-livraison").attr("disabled", true);

            }else{

                $("#btn-ajout-livraison").removeAttr("disabled");

                let url = "{{route('livraison.commande')}}" + "/" + value;

                $.get(url, {}, dateType="JSON").done(function (data) {

                    if(data.commande.user != undefined){
                        $("#livraison_client").val(data.commande.user).parent().parent().show(200);
                    }

                    $("#livraison_bl_body").html(data.data);
                })

            }
        })

    function retour_bl(data, modal){
        
        $.get(data.url, {}, dataType = "HTML").done(function (donnee) {
                modal.find("form").hide();
                modal.find(".modal-body").append("<div class='res'>"+donnee+"</div>");  
                let class_button = modal.find(".modal-footer button").last().attr("class").split(" ");

                modal.find(".modal-footer button").last().hide();


                let button = '<a href="'+ data.download +'"><button type="button" id="btn-voir-livraison" class="btn '+class_button[1]+' float-right">Download</button></a>';
                modal.find(".modal-footer").append(button);
                                
                modal.find(".close").attr("action", "reload");
                                
            })
    }

    

    </script>
@endsection

