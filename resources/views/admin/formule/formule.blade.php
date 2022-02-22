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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background: #007bff;color: white">
                                <h3 class="card-title">Produit</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Dimension</th>
                                        <th>Quantité (estimation)</th>
                                        <th>Coût essence</th>
                                        <th>Coût salarial</th>
                                        <th>Coût livraison</th>
                                        <th>Description</th>
                                        @can("viewAny" , auth()->user())
                                        <th>Statut</th>
                                        <th>Action</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($formules))
                                        @foreach($formules as $formule)
                                            <tr>
                                                <td>{{$formule->name}}</td>
                                                <td>{{$formule->dimension}}</td>
                                                <td>{{nombre($formule->quantite)}}</td>
                                                <td>{{format_prix($formule->cout_essence)}}</td>
                                                <td>{{format_prix($formule->cout_salarial)}}</td>
                                                <td>{{format_prix($formule->cout_livraison)}}</td>
                                                <td>{{$formule->description}}</td>
                                                @can("viewAny" , auth()->user())
                                                <td>
                                                    @if($formule->variations->isEmpty())
                                                        <span class="badge bg-danger">0 matière première</span>
                                                    @else
                                                        <span class="badge bg-success">{{nombre($formule->variations->count())}} matière première</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route("formule.show", ['formule' => $formule->id])}}"><i class="fa fa-eye"></i></a>
                                                    <a href id="{{$formule->id}}" data-toggle="modal" data-target="#modal-formule" onclick="getDataFormule(this.id)"><i class="fa fa-edit"></i></a>
                                                    <a href id="{{$formule->id}}" data-toggle="modal" data-target="#modal-formule-delete" onclick="getDataFormuleDelete(this.id)"><i class="fa fa-trash"></i></a>
                                                </td>
                                                @endcan
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Dimension</th>
                                        <th>Quantité (estimation)</th>
                                        <th>Coût essence</th>
                                        <th>Coût salarial</th>
                                        <th>Coût livraison</th>
                                        <th>Description</th>
                                        @can("viewAny" , auth()->user())
                                        <th>Statut</th>
                                        <th>Action</th>
                                        @endcan
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
    <!-- /.modal modif formule -->
    <div class="modal fade" id="modal-formule">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 class="modal-title">Modifier produit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-modif-body">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-modif-formule" class="btn btn-primary float-right">Sauvegarder</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modif formule -->

    <!-- /.modal supprimer formule -->
    <div class="modal fade" id="modal-formule-delete">
        <div class="modal-dialog">
            <div class="modal-content"  id="modal-supprimer-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal supprimer formule -->
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

        function getDataFormule(formule_id) {

            $('#modal-modif-body').empty();

            $.ajax({
                url: "{{ url('formule/modifier') }}/" + formule_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body').html(data);
                }
            });

        }

        function getDataFormuleDelete(formule_id) {

            $('#modal-supprimer-body').empty();

            $.ajax({
                url: "{{ url('formule/supprimer') }}/" + formule_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-supprimer-body').html(data);
                }
            });

        }

    </script>
@endsection

