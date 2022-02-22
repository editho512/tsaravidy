@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | Production</title>
@endsection

@section('styles')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <style>
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background-color: #28a745;
        }

    </style>

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper teste" style="min-height: inherit!important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 mb-3">
                        <h1>Productions <a class="btn btn-success float-right" href="{{route('commande.show', ['commande' => $commande->id])}}"> <i class="fa fa-arrow-alt-circle-left"></i> Retour</a></h1>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-dark"><i class="fas fa-cube"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total</span>
                                        <h3 class="info-box-number">{{nombre($produit->quantiteProduit())}}</h3>
                                    </div>
                                    <span class="float-right"><a class="bg-success" href data-toggle="modal" data-target="#modal-default"><i class="fas fa-2x fa-plus-square bg-white"></i></a></span>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary"><i class="far fa-plus-square"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">A produire</span>
                                        <h3 class="info-box-number">{{nombre($reste)}}</h3>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                                
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Quantité disponible</span>
                                        <h3 class="info-box-number">{{nombre($produit->quantiteDisponible())}}</h3>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-orange"><i class="fas fa-wind"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">En cours de séchage</span>
                                        <h3 class="info-box-number">{{nombre($produit->quantiteEnSechage())}}</h3>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-gradient-info"><i class="fas fa-shipping-fast"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Livrer</span>
                                        <h3 class="info-box-number">{{nombre($produit->quantiteLivrer())}}</h3>
                                    </div>
                                    <span class="float-right"><a class="bg-success" href data-toggle="modal" data-target="#modal-default-livraison"><i class="fas fa-2x fa-plus-square bg-white"></i></a></span>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="far fa-times-circle"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Casse</span>
                                        <h3 class="info-box-number">{{nombre($produit->casseTotal())}}</h3>
                                    </div>
                                    <!-- /.info-box-content -->
                                    <span class="float-right"><a class="bg-success" href data-toggle="modal" data-target="#modal-casse"><i class="fas fa-2x fa-plus-square bg-white"></i></a></span>

                                </div>
                                <!-- /.info-box -->
                            </div>
                            @can("viewAny" , auth()->user())
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-gradient-gray"><i class="fas fa-dollar-sign"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Revient moyen</span>
                                        <h3 class="info-box-number">{{format_prix($produit->revientMoyen())}}</h3>
                                        
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-gradient-maroon"><i class="fas fa-dollar-sign"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Coût total production</span>
                                        <h3 class="info-box-number">{{format_prix($produit->coutTotalProduction())}}</h3>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                                
                            @endcan
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
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link" href="#information"
                                                            data-toggle="tab">Information générale</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link active" href="#production"
                                                            data-toggle="tab">Production</a></li>
                                    {{--<li class="nav-item"><a class="nav-link" href="#casse"
                                                            data-toggle="tab">Casse</a></li>--}}
                                    <li class="nav-item"><a class="nav-link" href="#livraison"
                                                            data-toggle="tab">Livraison</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane" id="information">
                                        <!-- About Me Box -->
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Commande {{$commande->numero_bc}}</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <strong><i class="fas fa-user mr-1"></i> Client</strong>

                                                <p class="text-muted">
                                                    {{$commande->user}}
                                                </p>

                                                <hr>

                                                <strong><i class="fas fa-boxes mr-1"></i> Produit</strong>

                                                <p class="text-muted">{{$formule->name}}</p>
                                                <p class="text-muted">Estimation par cycle : {{nombre($formule->quantite)}}</p>
                                                <p class="text-muted">Estimation réel par cycle : {{nombre($produit->estimationParCycle())}}</p>
                                                <p class="text-muted">Estimation réel par cycle incluant la casse : {{nombre($produit->estimationParCycleAvecCasse())}}</p>
                                                <p class="text-muted">Total produit : {{nombre($produit->quantiteProduit()).' / '.nombre($produit->quantite)}}</p>
                                                <p class="text-muted">Total Livrer : {{nombre($produit->quantiteLivrer()).' / '.nombre($produit->quantite)}}</p>
                                                <hr>
                                                @can("viewAny" , auth()->user())

                                                <strong><i class="fas fa-clipboard-list mr-1"></i> Formule</strong>

                                                <div class="text-muted table-responsive">
                                                    <table id="" class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Designation</th>
                                                                <th>Unité</th>
                                                                <th>Quantité matière prémière</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($formule->variations as $variation)
                                                            <tr>
                                                                <td>{{$variation->matiere->name}}</td>
                                                                <td>{{$variation->matiere->unite}}</td>
                                                                <td>{{$variation->valeur}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <hr>
                                                @endcan

                                                {{--<strong><i class="far fa-file-alt mr-1"></i> Revient</strong>

                                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>--}}
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="active tab-pane" id="production">
                                        <div class="card">
                                            <div class="card-header card-header-success">
                                                <h3 class="card-title">Commande {{$commande->numero_bc}}</h3>
                                                <button class="btn btn-default float-right" data-toggle="modal" data-target="#modal-default">Ajouter une production</button>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example2" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Designation</th>
                                                        <th>Produit</th>
                                                        <th>Cycle</th>
                                                        <th>Quantité</th>
                                                        <th>Casse</th>
                                                        <th>Production</th>
                                                        <th>Disponibilité</th>
                                                        @can("viewAny" , auth()->user())
                                                        <th>Action</th>
                                                        @endcan
                                                        <th>Commantaire</th>
                                                        @can("viewAny" , auth()->user())
                                                        <th>Revient</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(isset($productions))
                                                        @foreach($productions as $production)
                                                            <tr>
                                                                <td>{{$produit->name}}</td>
                                                                <td>{{$formule->name}}</td>
                                                                <td>{{nombre($production->nombre_cycle)}}</td>
                                                                <td>{{nombre($production->quantite)}}</td>
                                                                <td>{{nombre($production->nombre_casse)}}</td>
                                                                <td>{{$production->date_production}}</td>
                                                                <td>{{$production->date_available}}</td>
                                                                @can("viewAny" , auth()->user())
                                                                <td class="text-center">
                                                                    {{--<a href="{{route("commande.show", ['commande' => $commande->id])}}"><i class="fa fa-eye"></i></a>--}}&nbsp;&nbsp;&nbsp;
                                                                    <a href id="{{$production->id}}" data-toggle="modal" data-target="#modal-production" onclick="getDataProduction(this.id)"><i class="fa fa-edit"></i></a>
                                                                    <a href id="{{$production->id}}" data-toggle="modal" data-target="#modal-production-delete" onclick="getDataProductionDelete(this.id)"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                                @endcan
                                                                <td>{{$production->commentaire}}</td>
                                                                @can("viewAny" , auth()->user())
                                                                <td>{{$production->revient}}</td>
                                                                @endcan
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Produit</th>
                                                        <th>Formule</th>
                                                        <th>Cycle</th>
                                                        <th>Quantité</th>
                                                        <th>Casse</th>
                                                        <th>Production</th>
                                                        <th>Disponibilité</th>
                                                        @can("viewAny" , auth()->user())
                                                        <th>Action</th>
                                                        @endcan
                                                        <th>Commantaire</th>
                                                        @can("viewAny" , auth()->user())
                                                        <th>Revient</th>
                                                        @endcan
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                    {{--<div class="tab-pane" id="casse">

                                    </div>--}}

                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="livraison">
                                        <div class="card">
                                            <div class="card-header card-header-info">
                                                <h3 class="card-title">Commande {{$commande->numero_bc}}</h3>
                                                <button class="btn btn-default float-right" data-toggle="modal" data-target="#modal-default-livraison">Ajouter une livraison</button>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example3" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Numéro BL</th>
                                                        <th>Quantité</th>
                                                        <th>Commantaire</th>
                                                        @can("viewAny" , auth()->user())
                                                        <th>Action</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(isset($livraisons))
                                                        @foreach($livraisons as $livraison)
                                                            <tr>
                                                                <td>{{date_format($livraison->date_livraison, 'Y-m-d')}}</td>
                                                                <td>{{$livraison->numero_bl}}</td>
                                                                <td>{{nombre($livraison->quantite)}}</td>
                                                                <td>{{$livraison->commentaire}}</td>
                                                                @can("viewAny" , auth()->user())
                                                                <td class="text-center">
                                                                    {{--<a href="{{route("commande.show", ['commande' => $commande->id])}}"><i class="fa fa-eye"></i></a>--}}&nbsp;&nbsp;&nbsp;
                                                                    <a href id="{{$livraison->id}}" data-toggle="modal" data-target="#modal-livraison" onclick="getDataLivraison(this.id)"><i class="fa fa-edit"></i></a>
                                                                    <a href id="{{$livraison->id}}" data-toggle="modal" data-target="#modal-livraison-delete" onclick="getDataLivraisonDelete(this.id)"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                                @endcan
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Numéro BL</th>
                                                        <th>Quantité</th>
                                                        <th>Commantaire</th>
                                                        @can("viewAny" , auth()->user())
                                                        <th>Action</th>
                                                        @endcan
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.card -->
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
                    <h4 class="modal-title">Ajout une production</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('commande.produit.create')}}" role="form" id="form-ajout-produit" method="POST">
                        @csrf
                        <input type="hidden" name="produit_id" value="{{$produit->id}}">
                        <div class="card-body">
                            <!-- Date dd/mm/yyyy -->
                            <div class="form-group">
                                <label>Date de production :</label>
                                <div class="input-group">
                                    <div class="input-group date" id="date_production" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date_production" name="date_production" required/>
                                        <div class="input-group-append" data-target="#date_production" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="nombre_cycle">Nombre cycle</label>
                                <input type="text" name="nombre_cycle" class="form-control" id="nombre_cycle"
                                       placeholder="Nombre total de cycle pour la production" required>
                            </div>
                            <div class="form-group">
                                <label for="quantite">Quantité (max: {{$produit->quantiteAProduire()}})</label>
                                <input type="number" name="quantite" class="form-control" id="quantite"
                                       placeholder="Quantité" max="{{$produit->quantiteAProduire()}}" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_casse">Nombre casse</label>
                                <input type="number" name="nombre_casse" class="form-control" id="nombre_casse" value="0"
                                       placeholder="Nombre de produit cassé" required>
                            </div>
                            <div class="form-group">
                                <label for="date_available">Durée séchage (heure)</label>
                                <input  type="number" name="date_available" class="form-control" id="date_available" {{auth()->user()->is_admin() === false ? "disabled" : "" }}
                                       placeholder="Temps estimatif de séchage en heure." value="24" required>
                            </div>
                            <div class="form-group">
                                <label for="commentaire">Commentaire</label>
                                <textarea class="form-control" name="commentaire" id="commentaire"
                                          placeholder="Commentaire..."></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-ajout-produit" class="btn btn-success float-right">Enregistrer
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter produit -->
   
    <!--.modal Modifier produit -->
    <div class="modal fade" id="modal-production">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-modif-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier produit -->

    <!--.modal Supprimer produit -->
    <div class="modal fade" id="modal-production-delete">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-supprimer-body">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Supprimer produit -->

    <!-- /.modal ajouter livraison -->
    <div class="modal fade" id="modal-default-livraison">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajout livraison</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('livraison.create')}}" role="form" id="form-ajout-livraison" method="POST">
                        @csrf
                        <input type="hidden" name="produit_id" value="{{$produit->id}}">
                        <div class="card-body">
                            <!-- Date dd/mm/yyyy -->
                            @if(empty($produit->quantiteDisponible()))
                                <div class="form-group">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-ban"></i> Attention!</h5>
                                        Il n'y a aucun produit disponible à la livraison.
                                        <ul>
                                            <li>Quantité disponible : 0</li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
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
                            <div class="form-group">
                                <label for="numero_bl">Numéro Bon de livraison</label>
                                <input type="text" name="numero_bl" class="form-control" id="numero_bl"
                                       placeholder="Numéro BL" required>
                            </div>
                            <div class="form-group">
                                <label for="quantite">Quantité (max: {{$produit->quantiteDisponible()}})</label>
                                <input type="number" name="quantite" class="form-control" id="quantite"
                                       placeholder="Quantité" max="{{$produit->quantiteDisponible()}}" required>
                            </div>
                            <div class="form-group">
                                <label for="commentaire">Commentaire</label>
                                <textarea class="form-control" name="commentaire" id="commentaire"
                                          placeholder="Commentaire..."></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    @if(!empty($produit->quantiteDisponible()))
                        <button type="submit" form="form-ajout-livraison" class="btn btn-success float-right">Enregistrer</button>
                    @endif
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter livraison -->

    <!--.modal Modifier livraison -->
    <div class="modal fade" id="modal-livraison">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-modif-body-livraison">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal modifier livraison -->

    <!--.modal Supprimer livraison -->
    <div class="modal fade" id="modal-livraison-delete">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-supprimer-body-livraison">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Supprimer livraison -->

    <!-- /.modal ajouter Casse -->
    <div class="modal fade" id="modal-casse">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h4 class="modal-title">Ajout de casse</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('commande.casse.update')}}" role="form" id="form-ajout-casse" method="POST">
                        @csrf
                        <input type="hidden" name="produit_id" value="{{$produit->id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre_casse">Nombre casse</label>
                                <input type="number" name="nombre_casse" class="form-control" id="nombre_casse" value="0"
                                       placeholder="Nombre de produit cassé" required>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" form="form-ajout-casse" class="btn btn-success float-right">Enregistrer
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ajouter produit -->
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('assets/adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- page script -->
    <script>

        $(function () {

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'});
            //Money Euro
            $('[data-mask]').inputmask();

            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": true,
                language: { url: "{{asset('assets/json/json_fr_fr.json')}}" }
            });

            $('#example2').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": true,
                "responsive": true,
                language: { url: "{{asset('assets/json/json_fr_fr.json')}}" }
            });

            $('#example3').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": true,
                language: { url: "{{asset('assets/json/json_fr_fr.json')}}" }
            });

            $('#date_production').datetimepicker({
                format: 'L',
                locale: 'fr',
            });

            $('#date_livraison').datetimepicker({
                format: 'L',
                locale: 'fr',
            });

        });

        function getDataProduction(production_id) {

            $('#modal-modif-body').empty();

            $.ajax({
                url: "{{ url('commande/produit/modifier/production') }}/" + production_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body').html(data);
                    $('[data-mask]').inputmask();
                    $('#date_production_edit').datetimepicker({
                        format: 'L',
                        locale: 'fr',
                    });
                }
            });

        }

        function getDataProductionDelete(production_id) {

            $('#modal-supprimer-body').empty();

            $.ajax({
                url: "{{ url('commande/produit/supprimer/production') }}/" + production_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-supprimer-body').html(data);
                }
            });

        }

        function getDataLivraison(livraison_id) {

            $('#modal-modif-body-livraison').empty();

            $.ajax({
                url: "{{ url('livraison/modifier') }}/" + livraison_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-modif-body-livraison').html(data);
                    $('[data-mask]').inputmask();
                    $('#date_livraison_edit').datetimepicker({
                        format: 'L',
                        locale: 'fr',
                    });
                }
            });

        }

        function getDataLivraisonDelete(livraison_id) {

            $('#modal-supprimer-body-livraison').empty();

            $.ajax({
                url: "{{ url('livraison/supprimer') }}/" + livraison_id,
                method: 'GET',
                success: function (data) {
                    $('#modal-supprimer-body-livraison').html(data);
                }
            });

        }

    </script>
@endsection

