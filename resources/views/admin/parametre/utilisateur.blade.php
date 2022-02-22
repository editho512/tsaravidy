@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | Utilisateurs</title>
@endsection

@section('styles')

@endsection
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper teste" style="min-height: inherit!important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Paramètre</h1>
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
                            <div class="card-header" >
                                <h3 class="card-title">Utilisateurs</h3>
                                <button class="btn  float-right" style="background: #007bff;color:white;" data-toggle="modal" id="nouveau-utilisateur" data-target="#modal-ajouter-utilisateur"><span class="fa fa-plus"></span>&nbsp;Ajouter</button>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="utilisateurs" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Rôle(s)</th>
                                        <th>Ville</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($users))
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ucwords($user->name)}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>
                                                    <p>
                                                       @if (@unserialize($user->role) == true)
                                                            @foreach (unserialize($user->role) as $item)
                                                                {{$item.($loop->last === false ? ", ": "")}}
                                                            @endforeach
                                                     
                                                            
                                                        @else
                                                          Aucun 
                                                        
                                                       @endif  
                                                    </p>
                                                </td>
                                                <td>{{$user->ville}}</td>
                                                <td class="text-center" >
                                                    <!--<a href="{{route("matiere.show", ['matiere' => $user->id])}}"><i class="fa fa-eye"></i></a>-->
                                                    <a data-link_update = "{{route("utilisateurs.update" , ["user" => $user->id])}}" data-link = "{{route("utilisateurs.edit" , ["user" => $user->id])}}" href="#" class="modifier-utilisateur"  ><i class="fa fa-edit"></i></a>
                                                    <a data-link_delete = "{{route("utilisateurs.delete" , ["user" => $user->id])}}"  href="#" class="supprimer-utilisateur"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Société</th>
                                        <th>Ville</th>
                                        <th>Actions</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
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

    <!---- modal pour ajouter utilisateurs --->
    <div class="modal fade" id="modal-ajouter-utilisateur">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajouter un utilisateur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-ajouter-utilisateur">
                    <form action="#" method="post" id="form-ajouter-utilisateur">
                        @csrf
                     
                        <input type="hidden" name="id" id="id" value=0>
                        <div class="row mt-2">
                            <div class="col-sm-4">
                                <label for="name">Nom</label>
                            </div>
                            <div class="col-sm-8 byUser">
                                <input type="text" name="name" id="name" value=""  placeholder="Nom" class="form-control" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="col-sm-8 byUser">
                                <input type="text" name="email" value="" id="email" placeholder="email" class="form-control" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="ville">Ville</label>
                            </div>
                            <div class="col-sm-8 byUser">
                                <input type="text" name="ville" id="ville" placeholder="Ville" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="adresse">Adresse</label>
                            </div>
                            <div class="col-sm-8 byUser">
                                <input type="text" name="adresse" id="adresse" placeholder="Adresse" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="role">Rôle</label>
                            </div>
                            <div class="col-sm-8">
                                <select name="role[]" class="form-control select" style="width:100%;" id="addrole" multiple>
                                   @foreach (droit() as $droit)
                                       <option value="{{$droit}}">{{$droit}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        
                            <div class="row mt-1">
                                <div class="col-sm-4">
                                    <label for="adresse">Password</label>
                                </div>
                                <div class="col-sm-8 byUser">
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4">
                                    <label for="adresse">Confirmation</label>
                                </div>
                                <div class="col-sm-8 byUser">
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmation" class="form-control">
                                </div>
                            </div>

                      

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="button" id="button-ajouter-utilisateur" class="float-right btn btn-success">Ajouter</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!---- / modal pour ajouter utilisateurs-->

    <!---- modal pour modification utilisateurs --->
    <div class="modal fade" id="modal-modifier-utilisateur">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 class="modal-title">Modifier un utilisateur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-modifier-utilisateur">
                    <form action="#" method="post" id="form-modifier-utilisateur">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" id="id" value=0>
                        <div class="row mt-2">
                            <div class="col-sm-4">
                                <label for="name">Nom</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="name" id="name" placeholder="Nom" class="form-control" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="email" id="email" placeholder="email" class="form-control" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="ville">Ville</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="ville" id="ville" placeholder="Ville" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="adresse">Adresse</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="adresse" id="adresse" placeholder="Adresse" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="role">Rôle</label>
                            </div>
                            <div class="col-sm-8">
                                <select name="role[]" class="form-control select" style="width:100%;" id="role" multiple>
                                   @foreach (droit() as $droit)
                                       <option value="{{$droit}}">{{$droit}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4 mb-4">
                            <div class="col-sm-8">
                                <label for="role">Modifier le mots de passe</label>
                            </div>
                            <div class="col-sm-4 pt-2">
                                <input type="checkbox" name="edit_password" id="edit_password" autocomplete="off">
                            </div>
                        </div>
                        <div id="edit-password" style="display: none;">

                            <div class="row mt-1">
                                <div class="col-sm-4">
                                    <label for="adresse">Password</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4">
                                    <label for="adresse">Confirmation</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmation" class="form-control">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="button" id="button-modifier-utilisateur" class="float-right btn btn-primary">Modifier</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!---- / modal pour modification utilisateurs-->
    <!---- modal pour suppression d'utilisateur --->
    <div class="modal fade" id="modal-supprimer-utilisateur">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <h4 class="modal-title">Supprimer un utilisateur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-supprimer-utilisateur">
                    <form action="#" method="POST" id="form-supprimer-utilisateur">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" id="id" value=0>
                        <div class="row mt-2">
                            <div class="col-sm-4">
                                <label for="name">Nom</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="name" id="name" placeholder="Nom" class="form-control" >
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="email" id="email" placeholder="email" class="form-control" >
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="ville">Ville</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="ville" id="ville" placeholder="Ville" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="adresse">Adresse</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="adresse" id="adresse" placeholder="Adresse" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <label for="role">Rôle</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="role" id="role" placeholder="Rôle" class="form-control">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-supprimer-utilisateur" class="float-right btn btn-danger">Supprimer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal pour suppression d'utilisateur -->
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
    <script src="{{asset('js/select2.js')}}"></script>

    <!-- page script -->
    <script>
        $(function () {

            $("#utilisateurs").DataTable({
                "responsive": true,
                "autoWidth": true,
                "searching": true,
                "paging": false,
                "ordering": true,
                "info": false,
            });

            $("#role").select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Rôles'
                }
            });

            $("#addrole").select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Rôles'
                }
            });

            $(document).on("click", ".modifier-utilisateur" , function(e){
                $(".invalid-feedback").hide();
                $(".is-invalid").removeClass("is-invalid");
                $("#edit_password").prop("checked", false).trigger("change");

                $("#modal-modifier-utilisateur").modal("show");
                let url = $(this).attr("data-link");

                let url_update = $(this).attr("data-link_update");
                $("#form-modifier-utilisateur").attr("action" , url_update);

                $.get( url , {} , dataType = "JSON").done(function(data){
                    console.log(data);
                    $("#modal-modifier-utilisateur #name").val(data.user.name);
                    $("#modal-modifier-utilisateur #email").val(data.user.email);
                    $("#modal-modifier-utilisateur #ville").val(data.user.ville);
                    $("#modal-modifier-utilisateur #adresse").val(data.user.adresse);
                    $("#modal-modifier-utilisateur #role ").select2('val', data.user.role);

                });
            })

            $(document).on("click", ".supprimer-utilisateur" , function(e){
                $("#modal-supprimer-utilisateur").modal("show");
                
                let url = $(this).prev().attr("data-link");

                let url_delete = $(this).attr("data-link_delete");
                $("#form-supprimer-utilisateur").attr("action" , url_delete);

                $.get( url , {} , dataType = "JSON").done(function(data){

                    $("#modal-supprimer-utilisateur #name").val(data.user.name).prop("disabled", true);
                    $("#modal-supprimer-utilisateur #email").val(data.user.email).prop("disabled", true);
                    $("#modal-supprimer-utilisateur #ville").val(data.user.ville).prop("disabled", true);
                    $("#modal-supprimer-utilisateur #adresse").val(data.user.adresse).prop("disabled", true);

                    let donnee = "";
                    $.each(data.user.role , function(i, e){
                       donnee +=  ( i == 0 ? "": ", " ) + e ;
                       $("#modal-supprimer-utilisateur #role").val( donnee);
                    })
                    $("#modal-supprimer-utilisateur #role").prop("disabled", true);
                });
            })

            $(document).on("change", "#role" , function(){
                console.log($(this).val());
            })
        });

        $(document).ready(function () {

            $(document).on("click", "#nouveau-utilisateur", function (e) {
                $(".invalid-feedback").hide();
                $(".is-invalid").removeClass("is-invalid");
                $(".byUser input").val("");
            })

            $(document).on("change","#edit_password", function (e) {
                let val = $(this).prop('checked');
                if(val === true){
                    $("#edit-password").show(250);
                }else{
                    $("#edit-password").hide(250);
                }
            })

            $(document).on("click", "#button-ajouter-utilisateur", function (e) {
                e.preventDefault();
                let url = "{{route('utilisateur.creer')}}" ;
                let dataPost = $('#form-ajouter-utilisateur').serialize();
                console.log(dataPost);
                $.post(url, dataPost, dataType = "JSON").done(function (data) {
                   console.log(data);
                   if(data["success"] != undefined){
                    location.reload();
                   }

                   // nom
                   if(data["name"] != undefined){
                       $("#form-ajouter-utilisateur #name").addClass("is-invalid").next().html(data["name"]).show(300);
                   }else{
                        $("#form-ajouter-utilisateur #name").removeClass("is-invalid").next().html("").hide(300);
                   }

                   //mots de passe
                   if(data["password"] != undefined){
                       $("#form-ajouter-utilisateur #password").addClass("is-invalid").next().html(data["password"]).show(300);
                   }else{
                        $("#form-ajouter-utilisateur #password").removeClass("is-invalid").next().html("").hide(300);
                   }

                   // email
                   if(data["email"] != undefined){
                       $("#form-ajouter-utilisateur #email").addClass("is-invalid").next().html(data["email"]).show(300);
                       
                   }else{
                        $("#form-ajouter-utilisateur #email").removeClass("is-invalid").next().html("").hide(300);
                   }
                    
                })
            })

            $(document).on("click","#button-modifier-utilisateur", function (e) {
                e.preventDefault();
                let url = $("#form-modifier-utilisateur").attr("action");
                let dataPost = $('#form-modifier-utilisateur').serialize();
                console.log(dataPost);
                $.post(url, dataPost, dataType = "JSON").done(function (data) {
                   console.log(data);
                   if(data["success"] != undefined){
                    location.reload();
                   }

                   // nom
                   if(data["name"] != undefined){
                       $("#form-modifier-utilisateur #name").addClass("is-invalid").next().html(data["name"]).show(300);
                   }else{
                        $("#form-modifier-utilisateur #name").removeClass("is-invalid").next().html("").hide(300);
                   }

                   //mots de passe
                   if(data["password"] != undefined){
                       $("#form-modifier-utilisateur #password").addClass("is-invalid").next().html(data["password"]).show(300);
                   }else{
                        $("#form-modifier-utilisateur #password").removeClass("is-invalid").next().html("").hide(300);
                   }

                   // email
                   if(data["email"] != undefined){
                       $("#form-modifier-utilisateur #email").addClass("is-invalid").next().html(data["email"]).show(300);
                       
                   }else{
                        $("#form-modifier-utilisateur #email").removeClass("is-invalid").next().html("").hide(300);
                   }
                    
                })
            })
        })

        
    </script>
@endsection
