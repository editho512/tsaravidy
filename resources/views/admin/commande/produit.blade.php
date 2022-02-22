@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | Produit</title>
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Produits</h1>
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
                    @if(isset($produits) && !$produits->isEmpty())
                        <div class="col-6">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">

                                    <h3 class="profile-username text-center">Commande {{$commande->user}}</h3>

                                    <p class="text-muted text-center">{{$commande->numero_bc}}</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        @foreach($produits as $produit)
                                        <li class="list-group-item">
                                            <b>{{$produit->name}}</b> <a class="float-right">{{nombre($produit->quantiteProduit())}}/{{nombre($produit->quantite)}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-6">
                            <!-- Profile Image -->
                            <div class="card card-info card-outline">
                                <div class="card-body box-profile">

                                    <h3 class="profile-username text-center">Livraison {{$commande->user}}</h3>

                                    <p class="text-muted text-center">{{$commande->numero_bc}}</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        @foreach($produits as $produit)
                                            <li class="list-group-item">
                                                <b>{{$produit->name}}</b> <a class="float-right">{{nombre($produit->quantiteLivrer())}}/{{nombre($produit->quantite)}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background: #007bff;color: white">
                                <h3 class="card-title">Commande : {{$commande->numero_bc}}</h3>
                                <button class="btn btn-default float-right" data-toggle="modal" data-target="#modal-default">Ajouter produit</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Formule</th>
                                        <th>Quantité</th>
                                        <th>P.U</th>
                                        <th>Montant</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($produits))
                                        @foreach($produits as $produit)
                                            <tr>
                                                <td>{{$produit->name}}</td>
                                                <td>{{$produit->formule->name}}</td>
                                                <td>{{nombre($produit->quantite)}}</td>
                                                <td>{{format_prix($produit->pu_vente)}}</td>
                                                <td>{{format_prix($produit->montant)}}</td>
                                                <td>{{$produit->description}}</td>
                                                <td class="text-center">
                                                    <a href="{{route("commande.produit.show", ['produit' => $produit->id])}}"><i class="fa fa-eye"></i></a>
                                                    @can("viewAny" , auth()->user())
                                                    <a href id="{{$produit->id}}" data-toggle="modal" data-target="#modal-produit" onclick="getDataProduit(this.id)"><i class="fa fa-edit"></i></a>
                                                    <a href id="{{$produit->id}}" data-toggle="modal" data-target="#modal-produit-delete" onclick="getDataProduitDelete(this.id)"><i class="fa fa-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
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


@endsection

@section('modals')
    <!-- /.modal ajouter produit -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajout produit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('commande.create')}}" role="form" id="form-ajout-produit" method="POST">
                        @csrf
                        <input type="hidden" name="commande_id" value="{{$commande->id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Designation</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Designation" required>
                            </div>
                            <div class="form-group">
                                <label for="formule_id">Produit</label>
                                <select class="form-control" name="formule_id" id="formule_id" required>
                                    @if(!$formules->isEmpty())
                                        @foreach($formules as $formule)
                                            <option value="{{$formule->id}}">{{$formule->name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">Indisponible</option>
                                    @endif

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantite">Quantité</label>
                                <input type="number" name="quantite" class="form-control" id="quantite" placeholder="Quantité" required>
                            </div>
                            <div class="form-group">
                                <label for="pu_vente">P.U</label>
                                <input type="number" name="pu_vente" class="form-control" id="pu_vente" placeholder="Prix unitaire" required>
                            </div>
                            <div class="form-group">
                                <label for="remise">Rémise</label>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="number" name="remise" class="form-control" id="remise" placeholder="Rémise" >
                                    </div>
                                    <div class="col-sm-4" style="text-align: right;">
                                        <input type="checkbox" name="is_percent" id="" checked>
                                        <span>(en %)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description complète"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-ajout-produit" class="btn btn-success float-right">Enregistrer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter produit -->

    <!--.modal Modifier produit -->
    <div class="modal fade" id="modal-produit">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-modif-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier produit -->

    <!--.modal Supprimer produit -->
    <div class="modal fade" id="modal-produit-delete">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-supprimer-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Supprimer produit -->
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


            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "searching": false,
                "paging": false,
                "ordering": false,
                "info": false,
                language: { url: "{{asset('assets/json/json_fr_fr.json')}}" }
            });
        });

        function getDataProduit(produit_id) {

            $('#modal-modif-body').empty();

            $.ajax({
                url: "{{ url('commande/produit') }}/" + produit_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body').html(data);
                    $('[data-mask]').inputmask();
                }
            });

        }

        function getDataProduitDelete(produit_id) {

            $('#modal-supprimer-body').empty();

            $.ajax({
                url: "{{ url('commande/produit/supprimer') }}/" + produit_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-supprimer-body').html(data);
                }
            });

        }

    </script>
@endsection

