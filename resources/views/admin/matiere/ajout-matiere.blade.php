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
                        <h1>Ajouter un Matière première</h1>
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
                                <h3 class="card-title">Matière première</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('post.add.single.matiere')}}" role="form" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Designation</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Designation matière première" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="unite">Unité</label>
                                        <input type="text" class="form-control" id="unite" name="unite" placeholder="Unité" required>
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
    <!-- /.modal ajouter commandes -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajouter un achat de matière première</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('matiere.create')}}" role="form" id="form-ajout-matiere" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Designation</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Designation" required>
                            </div>
                            <div class="form-group">
                                <label for="numero_bl">Numéro BL</label>
                                <input type="text" name="numero_bl" class="form-control" id="numero_bl" placeholder="Bon de livraison n°" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" name="type" class="form-control" id="type" placeholder="Type de dépense" required>
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
                                <input type="number" name="frais_livraison" class="form-control" id="frais_livraison" placeholder="Frais de livraison" required>
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
                    <button type="submit" form="form-ajout-matiere" class="btn btn-success float-right">Enregistrer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter commandes -->

    <!--.modal Modifier commandes -->
    <div class="modal fade" id="modal-modif-matiere">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 class="modal-title">Modifier un achat matière première</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-modif-body">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-modif-matiere" class="btn btn-primary float-right">Enregistrer</button>
                </div>
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

        function getDataMatiere(matiere_id) {

            $('#modal-modif-body').empty();

            $.ajax({
                url: "{{ url('matiere') }}/" + matiere_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body').html(data);
                    $('[data-mask]').inputmask();
                }
            });

        }

    </script>
@endsection

