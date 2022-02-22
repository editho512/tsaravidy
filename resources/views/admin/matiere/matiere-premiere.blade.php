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
                    <div class="col-sm-6 mb-3">
                        <h1>Matière première : {{$matiere->name}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Quantité disponible</span>
                                        <h3 class="info-box-number">{{nombre($all_quantite_dispo).' '.$matiere->unite}}</h3>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary"><i class="fas fa-dollar-sign"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Prix unitaire actuel</span>
                                        <h3 class="info-box-number">{{format_prix($matiere->prixCourant())}}</h3>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        </div>
                        <!-- /.row -->
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
                                <h3 class="card-title">{{ucwords($matiere->name)}}</h3>
                                <button class="btn btn-success float-right" data-toggle="modal" data-target="#modal-default">Ajouter</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Designation</th>
                                        <th>Numéro BL</th>
                                        <th>Fournisseur</th>
                                        <th>Qte Achat</th>
                                        <th>Qte Dispo</th>
                                        <th>Unité</th>
                                        <th>P.U</th>
                                        <th>Montant</th>
                                        <th>Frais de livraison</th>
                                        <th>Mode paiement</th>
                                        @can("viewAny" , auth()->user())
                                        <th>Action</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($stocks))
                                        @foreach($stocks as $stock)
                                            <tr>
                                                <td>{{$stock->created_at}}</td>
                                                <td>{{$matiere->name}}</td>
                                                <td>{{$stock->numero_bl}}</td>
                                                <td>{{$stock->fournisseur}}</td>
                                                <td>{{nombre($stock->quantite)}}</td>
                                                <td>{{nombre($stock->quantite_dispo)}}</td>
                                                <td>{{$matiere->unite}}</td>
                                                <td>{{format_prix($stock->pu)}}</td>
                                                <td>{{format_prix($stock->montant)}}</td>
                                                <td>{{format_prix($stock->frais_livraison)}}</td>
                                                <td>{{$stock->mode_paiement}}</td>
                                                @can("viewAny" , auth()->user())
                                                <td>
                                                    <a href data-toggle="modal" id="{{$stock->id}}" data-target="#modal-modif-matiere-stock" onclick="getDataMatiereStock(this.id)"><i class="fa fa-edit"></i></a>
                                                    <a href data-toggle="modal" id="{{$stock->id}}" data-target="#modal-supprimer-matiere-stock" onclick="getDataMatiereStockDelete(this.id)"><i class="fa fa-trash"></i></a>
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
                                        <th>Fournisseur</th>
                                        <th>Qte Achat</th>
                                        <th>Qte Dispo</th>
                                        <th>Unité</th>
                                        <th>P.U</th>
                                        <th>Montant</th>
                                        <th>Frais de livraison</th>
                                        <th>Mode paiement</th>
                                        @can("viewAny" , auth()->user())
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
    <!-- /.modal ajouter matiere premiere -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajouter un achat de {{$matiere->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('matiere.create')}}" role="form" id="form-ajout-matiere" method="POST">
                        @csrf
                        <input type="hidden" name="matiere_id" value="{{$matiere->id}}">
                        <input type="hidden" name="name" value="{{$matiere->name}}">
                        <div class="card-body">
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
    <!-- /.modal ajouter matiere premiere -->

    <!--.modal Modifier matiere premiere -->
    <div class="modal fade" id="modal-modif-matiere-stock">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 class="modal-title">Modifier un achat {{$matiere->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-modif-body">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-modif-matiere-edit" class="btn btn-primary float-right">Sauvegarder</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier  matiere premiere -->

    <!--.modal Modifier matiere premiere -->
    <div class="modal fade" id="modal-supprimer-matiere-stock">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <h4 class="modal-title">Supprimer achat "{{$matiere->name}}"</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-supprimer-body">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-supprimer-matiere-premiere" class="btn btn-danger float-right">Supprimer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier  matiere premiere -->
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

        function getDataMatiereStock(matiere_id) {

            $('#modal-modif-body').empty();

            $.ajax({
                url: "{{ url('matiere-premiere') }}/" + matiere_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body').html(data);
                    $('[data-mask]').inputmask();
                }
            });

        }

        function getDataMatiereStockDelete(matiere_id) {

            $('#modal-supprimer-body').empty();

            $.ajax({
                url: "{{ url('matiere-premiere/supprimer') }}/" + matiere_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-supprimer-body').html(data);
                    $('[data-mask]').inputmask();
                }
            });

        }

    </script>
@endsection

