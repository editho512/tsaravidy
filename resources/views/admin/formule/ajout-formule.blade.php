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
                        <h1>Ajouter un produit</h1>
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

                        <!-- general form elements -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Produit</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('post.add.single.formule')}}" role="form" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Designation</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Designation formule" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="dimension">Dimension</label>
                                        <input type="text" class="form-control" id="dimension" name="dimension" placeholder="Dimension produit" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantite">Quantité</label>
                                        <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Estimation nombre par cycle" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantite">Coût essence :</label>
                                        <input type="number" class="form-control" id="cout_essence" name="cout_essence" placeholder="Coût essence" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantite">Coût salarial :</label>
                                        <input type="number" class="form-control" id="cout_salarial" name="cout_salarial" placeholder="Coût salarial" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantite">Coût livraison :</label>
                                        <input type="number" class="form-control" id="cout_livraison" name="cout_livraison" placeholder="Coût livraison" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Description complète"></textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success float-right">Enregistrer</button>
                                </div>
                            </form>
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
        });

    </script>
@endsection

