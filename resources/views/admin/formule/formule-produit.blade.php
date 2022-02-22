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
                    <div class="col-sm-6 mb-3">
                        <h1>Produit :</h1>
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
                        <!-- Widget: user widget style 2 -->
                        <div class="card card-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-success">
                                <h3 class="widget-user-username">{{$formule->name}} <button class="btn btn-default float-right" data-toggle="modal" data-target="#modal-default">Ajouter</button></h3>
                                <h5 class="widget-user-desc">Estimation quantité : {{nombre($formule->quantite)}}</h5>
                            </div>
                            <div class="card-footer p-0">
                                @if(isset($variations) && !$variations->isEmpty())
                                    <ul class="nav flex-column">
                                        @foreach($variations as $variation)
                                            <li class="nav-item">
                                                <a href class="nav-link font-weight-bolder font-x-large"  data-toggle="modal" id="{{$variation->id}}" data-target="#modal-modif-formule-produit" onclick="getDataFormuleProduit(this.id)">
                                                    {{$variation->matiere->name.' ('.$variation->matiere->unite.')'}} <span class="float-right badge bg-danger ">{{$variation->valeur}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="nav flex-column text-center">
                                        <li class="nav-item m-3">Aucune matière première ajouté.</li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
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
    <!-- /.modal ajouter matiere -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajout matière première</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('formule.create')}}" role="form" id="form-ajout-matiere" method="POST">
                        @csrf
                        <input type="hidden" name="formule_id" value="{{$formule->id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="matiere_id">Matière première</label>
                                <select class="form-control" name="matiere_id" id="matiere_id" required>
                                    @if(!$matieres->isEmpty())
                                        @foreach($matieres as $matiere)
                                            <option value="{{$matiere->id}}">{{$matiere->name}} ({{$matiere->unite}})</option>
                                        @endforeach
                                    @else
                                        <option value="">Indisponible</option>
                                    @endif

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="valeur">Quantité</label>
                                <input type="number" name="valeur" class="form-control" id="valeur" placeholder="Quantité" step="any" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-ajout-matiere" class="btn btn-success float-right">Enregistrer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter matiere -->

    <!--.modal Modifier commandes -->
    <div class="modal fade" id="modal-modif-formule-produit">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-modif-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier commandes -->
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

        function getDataFormuleProduit(formule_produit_id) {

            $('#modal-modif-body').empty();

            $.ajax({
                url: "{{ url('formule/produit') }}/" + formule_produit_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body').html(data);
                    $('[data-mask]').inputmask();
                }
            });

        }

    </script>
@endsection

