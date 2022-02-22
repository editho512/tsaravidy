@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | Commande</title>
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
                        <h1>Commandes</h1>
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
                                <h3 class="card-title">Commande</h3>
                                <button class="btn btn-success float-right" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span>&nbsp;Ajouter</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date livraison</th>
                                        <th>Client</th>
                                        <th>Numéro BC</th>
                                        <th>Produits</th>
                                        <th>Date commande</th>
                                        <th>Date paiement</th>
                                        <th>Statut</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($commandes))
                                        @foreach($commandes as $commande)
                                            <tr >
                                                <td>{{date_format($commande->date_livraison, 'Y-m-d')}}</td>
                                                <td>{{$commande->user}}</td>
                                                <td>{{$commande->numero_bc}}</td>
                                                <td>
                                                    @if(!$commande->produits->isEmpty())
                                                        @foreach($commande->produits as $p)
                                                            <span class="badge badge-dark">{{$p->name}}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>{{date_format($commande->created_at, 'Y-m-d')}}</td>
                                                <td>{{date_format($commande->date_paiement, 'Y-m-d')}}</td>
                                                <td class="text-center" @if($commande->date_livraison < \Carbon\Carbon::now() && !$commande->isCommandeComplete())style="background-color: #dc3545;color: white"@elseif($commande->date_livraison->diffInDays(\Carbon\Carbon::now()) < 7 && !$commande->isCommandeComplete())style="background-color: darkorange;color: white"@endif>
                                                    @if(!$commande->isCommandeComplete())
                                                        @if($commande->produits->isEmpty())
                                                            <span class="badge bg-danger">initié </span> &nbsp;&nbsp;&nbsp;<i class="fa fa-info-circle" title="Ajouter des produits"></i>
                                                        @else
                                                            <span class="badge bg-primary">en cours</span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-success">terminée</span>
                                                    @endif
                                                </td>
                                                <td>{{$commande->description}}</td>
                                                <td class="text-center">
                                                    <a href="{{route("commande.show", ['commande' => $commande->id])}}"><i class="fa fa-eye"></i></a>
                                                    @can("viewAny" , auth()->user())
                                                    <a href id="{{$commande->id}}" data-toggle="modal" data-target="#modal-commande" onclick="getDataCommande(this.id)"><i class="fa fa-edit"></i></a>
                                                    <a href id="{{$commande->id}}" data-toggle="modal" data-target="#modal-commande-delete" onclick="getDataCommandeDelete(this.id)"><i class="fa fa-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Date livraison</th>
                                        <th>Client</th>
                                        <th>Numéro BC</th>
                                        <th>Produits</th>
                                        <th>Date commande</th>
                                        <th>Date paiement</th>
                                        <th>Statut</th>
                                        <th>Description</th>
                                        <th>Action</th>
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


@endsection

@section('modals')
    <!-- /.modal ajouter commandes -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajouter une commande</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('post.add.single.commande')}}" role="form" id="form-ajout-commande" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="client">Client</label>
                                <input type="text" name="user" class="form-control" id="client" placeholder="Nom client ou société" required>
                            </div>
                            <div class="form-group">
                                <label for="numero_bc">Numéro BC</label>
                                <input type="text" name="numero_bc" class="form-control" id="numero_bc" placeholder="Bon de commande n°" required>
                            </div>
                            <!-- Date dd/mm/yyyy -->
                            <div class="form-group">
                                <label>Date de livraison :</label>
                                <div class="input-group">
                                    <div class="input-group date" id="date_livraison" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date_livraison" name="date_livraison" required/>
                                        <div class="input-group-append" data-target="#date_livraison" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- Date dd/mm/yyyy -->

                            <div class="form-group">
                                <label>Date de paiement :</label>

                                <div class="input-group">
                                    <div class="input-group date" id="date_paiement" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date_paiement" name="date_paiement" required/>
                                        <div class="input-group-append" data-target="#date_paiement" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea  class="form-control" name="description" id="description" placeholder="Description de la commande"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-ajout-commande" class="btn btn-success float-right">Enregistrer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter commandes -->

    <!-- /.modal modif commande -->
    <div class="modal fade" id="modal-commande">
        <div class="modal-dialog">
            <div class="modal-content"  id="modal-modif-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modif commande -->

    <!-- /.modal supprimer commande -->
    <div class="modal fade" id="modal-commande-delete">
        <div class="modal-dialog">
            <div class="modal-content"  id="modal-supprimer-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal supprimer commande -->
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
                language: { url: "{{asset('assets/json/json_fr_fr.json')}}" }
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                language: { url: "{{asset('assets/json/json_fr_fr.json')}}" }
            });

            $('#date_livraison').datetimepicker({
                format: 'L',
                locale: 'fr',
            });

            $('#date_paiement').datetimepicker({
                format: 'L',
                locale: 'fr',
            });
        });

        function getDataCommande(commande_id) {

            $('#modal-modif-body').empty();

            $.ajax({
                url: "{{ url('commande/modifier') }}/" + commande_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body').html(data);
                    $('[data-mask]').inputmask();
                    $('#date_livraison_edit').datetimepicker({
                        format: 'L',
                        locale: 'fr',
                    });

                    $('#date_paiement_edit').datetimepicker({
                        format: 'L',
                        locale: 'fr',
                    });
                }
            });

        }

        function getDataCommandeDelete(commande_id) {

            $('#modal-supprimer-body').empty();

            $.ajax({
                url: "{{ url('commande/supprimer') }}/" + commande_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-supprimer-body').html(data);
                }
            });

        }

    </script>
@endsection

