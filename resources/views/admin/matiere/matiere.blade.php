@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | Matiere première</title>
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
                        <h1>Stock Matière première</h1>
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
                                <h3 class="card-title">Matière première</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Unité</th>
                                        <th>Description</th>
                                        <th>Quantité</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($matieres))
                                        @foreach($matieres as $matiere)
                                            <tr>
                                                <td>{{$matiere->name}}</td>
                                                <td>{{$matiere->unite}}</td>
                                                <td>{{$matiere->description}}</td>
                                                <td>{{nombre($matiere->stockDisponible()).' '.$matiere->unite}}</td>
                                                <td class="text-center">
                                                    <a href="{{route("matiere.show", ['matiere' => $matiere->id])}}"><i class="fa fa-eye"></i></a>
                                                    @can("viewAny" , auth()->user())
                                                    <a href id="{{$matiere->id}}" data-toggle="modal" data-target="#modal-matiere" onclick="getDataMatiere(this.id)"><i class="fa fa-edit"></i></a>
                                                    <a href id="{{$matiere->id}}" data-toggle="modal" data-target="#modal-matiere-delete" onclick="getDataMatiereDelete(this.id)"><i class="fa fa-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Unité</th>
                                        <th>Description</th>
                                        <th>Quantité</th>
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
    <!--.modal Modifier Matiere -->
    <div class="modal fade" id="modal-matiere">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-modif-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier Matiere -->

    <!--.modal Supprimer Matiere -->
    <div class="modal fade" id="modal-matiere-delete">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-supprimer-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Supprimer Matiere -->
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

        function getDataMatiere(matiere_id) {

            $('#modal-modif-body').empty();

            $.ajax({
                url: "{{ url('matiere/single') }}/" + matiere_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body').html(data);
                }
            });

        }

        function getDataMatiereDelete(matiere_id) {

            $('#modal-supprimer-body').empty();

            $.ajax({
                url: "{{ url('matiere/single/delete') }}/" + matiere_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-supprimer-body').html(data);
                }
            });

        }

    </script>
@endsection

