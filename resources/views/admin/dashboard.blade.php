@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | Dashboard</title>
@endsection

@section('styles')
    <style>
        .scaler { transition: all .2s ease-in-out; }
        .scaler:hover { 
            transform: scale(1.09); 
            -webkit-transform: scale(1.09);
            -moz-transform: scale(1.09);
            -o-transform: scale(1.09);
            transform: scale(1.09);
        }

    </style>
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
                        <h1>Tableau de bord</h1>
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
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Chiffre d'affaires</h3>
                                        <div class="card-tools">
                                           
                                          <!-- Buttons, labels, and many other things can be placed here! -->
                                          <!-- Here is a label for example -->
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <div class="card-body" style="min-height: 200px">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div>
                                                    <canvas id="gainChart"  ></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="min-width:175px;">
                                                <div class="info-box mb-3 " style="background-color:rgba(254, 169, 42 , 0.4);border:solid 3px rgba(254, 169, 42 , 0.2)">
                                                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                      
                                                    <div class="info-box-content">
                                                      <span class="info-box-text">Chiffre d'affaire</span>
                                                      <span class="info-box-number" id="chiffre_affaire_total">{{gain_total_dashboard($chiffre_affaire)}}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <div class="info-box mb-3 " style= "{{$gain > 0 ? 'background-color:rgba(0, 123, 255 , 0.4);border:solid 3px rgba(0, 123, 255 , 0.2' : 'background-color:rgba(220, 53, 69 , 0.8);border:solid 3px rgba(220, 53, 69 , 1'}}">
                                                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                      
                                                    <div class="info-box-content">
                                                      <span class="info-box-text">Gain</span>
                                                      <span class="info-box-number" id="gain_total">{{gain_total_dashboard($gain , false, false, $Rent)}}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-6 gain_date">
                                                 <!-- Date dd/mm/yyyy -->
                                                     <div class="input-group">
                                                         <div class="input-group date" id="gain_debut" data-target-input="nearest">
                                                             <input autocomplete="off" type="text" class="form-control datetimepicker-input" data-target="#gain_debut" placeholder="Début" name="gain_debut"  required/>
                                                             <div class="input-group-append" data-target="#gain_debut" data-toggle="datetimepicker">
                                                                 <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 <!-- /Date dd/mm/yyyy -->
   
                                            </div>
                                            <div class="col-sm-6 gain_date">
                                             <!-- Date dd/mm/yyyy -->
                                                 <div class="input-group">
                                                     <div class="input-group date" id="gain_fin" data-target-input="nearest">
                                                         <input autocomplete="off" type="text" class="form-control datetimepicker-input " data-target="#gain_fin" placeholder="Fin" name="gain_fin"  required/>
                                                         <div class="input-group-append" data-target="#gain_fin" data-toggle="datetimepicker">
                                                             <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             <!-- /Date dd/mm/yyyy -->
                                             </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-outline card-info" style="min-height: 530px">
                                    <div class="card-header">
                                        <h3 class="card-title">Productions et livraisons</h3>
                                        <div class="card-tools">
                                           
                                          <!-- Buttons, labels, and many other things can be placed here! -->
                                          <!-- Here is a label for example -->
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <div class="card-body" >
                                        <div>
                                            <canvas id="productionChart"  ></canvas>
                                        </div>
                                    </div>
                                    <div class="card-footer" >
                                        <div class="row">
                                            <div class="col-sm-6 production_date">
                                                 <!-- Date dd/mm/yyyy -->
                                                     <div class="input-group">
                                                         <div class="input-group date" id="production_debut" data-target-input="nearest">
                                                             <input autocomplete="off" type="text" class="form-control datetimepicker-input" data-target="#production_debut" placeholder="Début" name="production_debut"  required/>
                                                             <div class="input-group-append" data-target="#production_debut" data-toggle="datetimepicker">
                                                                 <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 <!-- /Date dd/mm/yyyy -->
   
                                            </div>
                                            <div class="col-sm-6 gain_date">
                                             <!-- Date dd/mm/yyyy -->
                                                 <div class="input-group">
                                                     <div class="input-group date" id="production_fin" data-target-input="nearest">
                                                         <input autocomplete="off" type="text" class="form-control datetimepicker-input " data-target="#production_fin" placeholder="Fin" name="production_fin"  required/>
                                                         <div class="input-group-append" data-target="#production_fin" data-toggle="datetimepicker">
                                                             <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             <!-- /Date dd/mm/yyyy -->
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="card card-outline card-danger" style="min-height: 530px">
                                    <div class="card-header">
                                        <h3 class="card-title">Dépenses</h3>
                                        <div class="card-tools">
                                           
                                          <!-- Buttons, labels, and many other things can be placed here! -->
                                          <!-- Here is a label for example -->
                                          <span class="badge badge-danger" id="depense_total">{{ isset($depense_total->montant_total) ? format_prix($depense_total->montant_total) : format_prix(0)}}</span>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                        <a class="nav-item nav-link active"  id="content_card-principal" style="color:#7a8381" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Par type</a>
                                        <a class="nav-item nav-link "  id="content_card-secondaire" style="color:#7a8381;" data-toggle="tab" href="#nav-secondary" role="tab" aria-controls="nav-home" aria-selected="true">Mensuele</a>

                                    </div>
                                    <div class=" tab-content " id="nav-tabContent" style="margin-left">
                                        <div class="tab-pane fade show active " id="nav-home" role="tabpanel" aria-labelledby="content_card-principal" style="padding:1% !important;">
                                            
                                            <div class="card-body" >
                                                <div>
                                                    <canvas id="depenseChart"  ></canvas>
                                                </div>
                                                  
                                            </div>
                                            <div class="card-footer" style="margin-top: 27px;">
                                               <div class="row">
                                                   <div class="col-sm-6 depense_date">
                                                        <!-- Date dd/mm/yyyy -->
                                                            <div class="input-group">
                                                                <div class="input-group date" id="date_depense_debut" data-target-input="nearest">
                                                                    <input autocomplete="off" type="text" class="form-control datetimepicker-input" data-target="#date_depense_debut" placeholder="Début" name="date_depense_debut"  required/>
                                                                    <div class="input-group-append" data-target="#date_depense_debut" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!-- /Date dd/mm/yyyy -->
          
                                                   </div>
                                                   <div class="col-sm-6 depense_date">
                                                    <!-- Date dd/mm/yyyy -->
                                                        <div class="input-group">
                                                            <div class="input-group date" id="date_depense_fin" data-target-input="nearest">
                                                                <input autocomplete="off" type="text" class="form-control datetimepicker-input " data-target="#date_depense_fin" placeholder="Fin" name="date_depense_fin"  required/>
                                                                <div class="input-group-append" data-target="#date_depense_fin" data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- /Date dd/mm/yyyy -->
                                                    </div>
                                               </div>
                                            </div>
                                            
                                        </div>
                                            
                                        
                                        <div class="tab-pane  fade show active"  id="nav-secondary" role="tabpanel" aria-labelledby="content_card-secondaire" style="padding:1% !important;position: absolute; top: -10000px">
                                            <div class="card-body"  >
                                                <div >
                                                    <canvas id='depenseSecondaryChart'  ></canvas>
                                                </div>
                                            </div>
                                            <div class="card-footer" style="margin-top: 27px;">
                                                <div class="row">
                                                    <div class="col-sm-12 " style="text-align: center;">
                                                        <span id="btn-chart_depense_left" style="font-size:230%;color:rgba(220, 53, 69 , 0.3);margin-right:5%" class="fas fa-arrow-alt-circle-left scaler"></span>
                                                        <span  id="btn-chart_depense_right" style="font-size:230%;color:rgba(220, 53, 69 , 0.3);margin-left:5%;" class="fas fa-arrow-alt-circle-right scaler"></span>
                                                     </div>
                                                    
                                                </div>
                                             </div>
                                        </div>
                                        
                                      
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" >
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-outline card-info" >
                                    <div class="card-header">
                                        <h3 class="card-title">Général </h3>
                                        <div class="card-tools">
                                           
                                            <!-- Buttons, labels, and many other things can be placed here! -->
                                            <!-- Here is a label for example -->
                                            <span class="badge badge-info" id="general_total">{{gain_total_dashboard($chiffre_affaire)}}</span>
          
                                          </div>

                                        <div class="card-tools">
                                           
                                          <!-- Buttons, labels, and many other things can be placed here! -->
                                          <!-- Here is a label for example -->
        
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <div class="card-body" style="max-height: 400px">
                                        <div>
                                            <canvas id="generalChart" width="80" height="80" ></canvas>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-outline card-info" style="min-height: 998px">
                                    <div class="card-header">
                                        <h3 class="card-title">Stocks </h3>
                                        <div class="card-tools">
                                           
                                          <!-- Buttons, labels, and many other things can be placed here! -->
                                          <!-- Here is a label for example -->
                                          <span class="badge badge-info" >{{$max_stock["stock"]}}</span>
        
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <div class="card-body" >
                                       @if (isset($stock_disponible) && count($stock_disponible) > 0)
                                           @foreach ($stock_disponible as $key => $stock)
                                          
                                            <!-- small box -->
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                <h3>{{nombre($stock["stock"])}}</h3>
                                
                                                <p>{{ucfirst($key)}}</p>
                                                </div>
                                                <div class="icon">
                                                <i class="fas fa-warehouse"></i>
                                                </div>
                                                <div class="small-box-footer" style="">{!! "<b>". $stock["cycle"]."</b>".( $stock["cycle"] < 2 ? " cycle" : " cycles") !!} </i></div>
                                            </div>
                    
                                           @endforeach
                                       @else
                                       <div class="info-box mb-3 bg-info">
                                            <span class="info-box-icon"><i class="fas fa-bell"></i></span>
                            
                                            <div class="info-box-content" style="text-align">
                                             <span class="info-box-text">Rupture de stock</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                       @endif
                                        
                                        
                                    </div>
                                    <div class="card-footer" >
                                        <h6 style="text-align:center;color:#7a8381 !important;" >Stock et cycle</h6>
                                    </div>
                                </div>

                            </div>

                        </div>
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
@php
    
@endphp

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

            $('#date_depense_fin , #date_depense_debut , #gain_fin , #gain_debut , #production_debut , #production_fin ').datetimepicker({
                    format: 'YYYY-MM-DD',
                    locale: 'fr'
                    
                });
        });

        //------------------------------ Charts pour général

        const data_general =  {
                        labels: [
                            'Gain',
                            'Coût essence',
                            'Coût salarial',
                            'Coût livraison',
                            'Coût Matériel',
                            'Loyer'
                        ],
                        datasets: [{
                            label: 'My First Dataset',
                            data: [{{$general['gain'] > 0 ? $general['gain'] : 0}}, {{$general['cout_essence']}}, {{$general['cout_salarial']}}, {{$general['cout_livraison']}}, {{$general['revient_moyen']}}, {{$general['loyer']}}],
                            backgroundColor: [
                            'rgb(54, 162, 235)',
                            '#17a2b8',
                            'rgb(255, 205, 86)',
                            'green',
                            '#9579d1',
                            'purple'
                            ],
                            hoverOffset: 4
                        }]
                    };
        const config_general = {
                            type: 'pie',
                            data: data_general,
                            options: {
                                responsive: true,
                                plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Chart.js Pie Chart'
                                    }
                                } 
                                
                            },
                        };

        var myChartgeneral = new Chart(
            document.getElementById('generalChart'),
            config_general
        );
        
         //------------------------------Charts pour gain

        const labels_gain = [ {{gain_dashboard($gain, true)}}];
        const data_gain = {
                        labels: labels_gain,
                        datasets: [
                                    {
                                    label: 'Gain selon type de parpaing',
                                    backgroundColor: "{{ $gain > 0 ? 'rgba(0, 123, 255 , 0.4)' : 'rgba(220, 53, 69 , 0.8)'}}",
                                    borderColor: "{{ $gain > 0 ? 'rgba(0, 123, 255 , 0.4)' : 'rgba(220, 53, 69 , 0.4)'}}",
                                    data: [ {{gain_dashboard($gain)}}],
                                },
                                {
                                    label: "chiffre d'affaire selon type parpaing",
                                    backgroundColor: 'rgba(254, 169, 42 , 0.4)',
                                    borderColor: 'rgba(254, 169, 42 , 0.4)',
                                    data: [ {{gain_dashboard($chiffre_affaire)}}],
                                }
                        ]
                    };

        const config_gain = {
                        type: 'line',
                        data: data_gain,
                        options: {
                            responsive : true ,
                            maintainAspectRatio : false	,
                            aspectRatio : 1 ,
                            tooltips: {
                                enabled: true,
                                mode: 'single',
                                callbacks: {
                                    label: function(tooltipItems, data) { 
                                        return new Intl.NumberFormat('de-DE').format(tooltipItems.yLabel) + ' Ar : ' + tooltipItems.xLabel;
                                    }
                                }
                            }
                        }
                    };

        var myChartgain = new Chart(
            document.getElementById('gainChart'),
            config_gain
        );

        //------------------------------Charts pour production
        const labels_production = [ {{produit_dashboard($commande , $produit )}}];
        const data_production = {
                        labels: labels_production,
                        datasets: [
                               /* {
                                    label: 'Quantité à produire selon type ',
                                    backgroundColor: 'rgba(23, 162, 184 , 0.1)',
                                    borderColor: 'rgb(23, 162, 184)',
                                    data: [ {{produit_dashboard($commande , $produit, true)}}],
                                },*/
                                {
                                    label: 'Quantité à livrer selon type ',
                                    backgroundColor: 'rgba(114, 09, 183 , 0.1)',
                                    borderColor: 'rgb(114, 09, 183)',
                                    data: [ {{livraison_dashboard($commande , $produit_avalaible , $livraison)}}],
                                },
                                {
                                    label: 'Quantité produit selon type ',
                                    backgroundColor: 'rgba(247, 37, 133, 0.1)',
                                    borderColor: 'rgb(247, 37, 133)',
                                    data: [ {{lister_chart($productions)}}],
                                },
                                {
                                    label: 'Quantité livré selon type ',
                                    backgroundColor: 'rgba(101, 109, 74 , 0.1)',
                                    borderColor: 'rgb(101, 109, 74)',
                                    data: [ {{lister_chart($livraisons)}}],
                                }
                        ]
                    };
        const config_production = {
                        type: 'line',
                        data: data_production,
                        options: {
                            responsive : true ,
                            maintainAspectRatio : false	,
                            aspectRatio : 1,
                            tooltips: {
                                enabled: true,
                                mode: 'single',
                                callbacks: {
                                    label: function(tooltipItems, data) { 
                                        return new Intl.NumberFormat('de-DE').format(tooltipItems.yLabel) + ' : ' + tooltipItems.xLabel ;
                                    }
                                }
                            }
                        }
                    };

        var myChartProduction = new Chart(
            document.getElementById('productionChart'),
            config_production
        );

        //-------------------------------------- Charts pour depense
        const labels_depense = [ {{depense_dashboard($depense)}}];
        const data_depense = {
                        labels: labels_depense,
                        datasets: [{
                            label: 'Montant selon type de dépense ({{Config::get('constants.devise')}})',
                            backgroundColor: 'rgba(220, 53, 69 , 0.3)',
                            borderColor: 'rgb(220, 53, 69)',
                            data: [ {{depense_dashboard($depense , true)}}],
                        }]
                    };

        const config_depense = {
                        type: 'bar',
                        data: data_depense,
                        options: {
                            responsive : true ,
                            maintainAspectRatio : false	,
                            aspectRatio : 1 ,
                            tooltips: {
                                enabled: true,
                                mode: 'single',
                                callbacks: {
                                    label: function(tooltipItems, data) { 
                                        return new Intl.NumberFormat('de-DE').format(tooltipItems.yLabel) + ' Ar : ' + tooltipItems.xLabel;
                                    }
                                }
                            }
                        }
                    };

        var myChart = new Chart(
            document.getElementById('depenseChart'),
            config_depense
        );
        
        //--------------------------------- Charts pour depense périodique
       
        let labels_depense_periodique = [ {{depense_periodique($depense_periodique , true)}}];
        let data_depense_periodique = {
                            labels: labels_depense_periodique,
                            datasets: [{
                                label: 'Montant dépense mensuel ({{Config::get('constants.devise')}})',
                                backgroundColor: 'rgba(220, 53, 69 , 0.3)',
                                borderColor: 'rgb(220, 53, 69)',
                                data: [ {{depense_periodique($depense_periodique )}}],
                            }]
                        };

        let config_depense_periodique = {
                            type: 'bar',
                            data: data_depense_periodique,
                            options: {
                                responsive : true ,
                                maintainAspectRatio : false	,
                                aspectRatio : 1 ,
                                tooltips: {
                                enabled: true,
                                mode: 'single',
                                callbacks: {
                                    label: function(tooltipItems, data) { 
                                        return new Intl.NumberFormat('de-DE').format(tooltipItems.yLabel) + ' Ar : ' + tooltipItems.xLabel ;
                                    }
                                }
                            }
                            }
                        };
        

        var myChartDepense = new Chart(
                document.getElementById('depenseSecondaryChart'),
                config_depense_periodique
            );

        $(document).on("click", "#content_card-secondaire", function(e){
            $("#nav-home").removeClass("active");
            $("#nav-secondary").css("position","relative").css("top","0px");

        })

        // ------------ Production et livraison ---------------//
        $(document).on("click, focusout" , "#production_debut , #production_fin " , function(e){

            let debut = $("#production_debut").find("input").val();
            let fin = $("#production_fin").find("input").val() ;
            let date_debut = debut != "" ? new Date(debut) : "";
            let date_fin = fin != "" ? new Date(fin) : "";
             // verifier si la date de fin que l'utilisateur a saisi n'est pas antérieur à celle du début.
             let error_date =   ( ( date_debut instanceof Date && !isNaN(date_debut.valueOf()) && date_fin instanceof Date && !isNaN(date_fin.valueOf()) ) && date_debut > date_fin  ) ? true : false;
            
            $("#production_fin input").removeClass("is-invalid");

            if( error_date == false ){

                let dataPost = {
                    _token : "{{ csrf_token() }}",
                    debut : debut , 
                    fin : fin
                };

                $.post( '{{route("dashboard_production_liste")}}' , dataPost , dataType = "JSON" ).done(function(data){

                        let label = Object.entries(data["label"]);
                        //let aProduire = Object.entries(data["aProduire"]);
                        let aLivrer = Object.entries(data["aLivrer"]);
                        let productions = Object.entries(data["productions"]);
                        let livraisons = Object.entries(data["livraisons"]);

                        if(data["total_gain"] != undefined){
                            $("#gain_total").html(data["total_gain"]);
                        }
                        if(data["total_chiffre_affarie"] != undefined){
                            $("#chiffre_affaire_total , #general_total ").html(data["total_chiffre_affarie"]);
                        }


                        if(label.length > 0){
                            // vider les anciens données
                            myChartProduction.data.labels = [];
                            myChartProduction.data.datasets[0].data = [];
                            myChartProduction.data.datasets[1].data = [];
                            myChartProduction.data.datasets[2].data = [];
                            //myChartProduction.data.datasets[3].data = [];
                            myChartProduction.update();

                            label.forEach(function(e , i){
                               
                                myChartProduction.data.labels[i] = label[i][1];
                                
                                //myChartProduction.data.datasets[0].data[i] = ( aProduire[i] != undefined && aProduire[i][1] != undefined ) ? aProduire[i][1] : 0;
                                myChartProduction.data.datasets[0].data[i] = ( aLivrer[i] != undefined && aLivrer[i][1] != undefined ) ? aLivrer[i][1] : 0;

                                
                                
                                myChartProduction.data.datasets[1].data[i] = ( productions[i] != undefined && productions[i][1] != undefined ) ? productions[i][1] : 0;
                                myChartProduction.data.datasets[2].data[i] = ( livraisons[i] != undefined && livraisons[i][1] != undefined  )? livraisons[i][1] : 0;
                              
                                myChartProduction.update();
                            })
                        }
                        else{
                            removeData(myChartProduction);
                        }

                });

            }else if( error_date) {

                $("#production_fin input").addClass("is-invalid");
                
            }
            

        })

        // ------------ Evenement pour chiffre d'affaire -----------
        $(document).on("click, focusout" , "#gain_debut , #gain_fin" , function(e){
            let debut = $("#gain_debut").find("input").val();
            let fin = $("#gain_fin").find("input").val() ;
            let date_debut = debut != "" ? new Date(debut) : "";
            let date_fin = fin != "" ? new Date(fin) : "";

            // verifier si la date de fin que l'utilisateur a saisi n'est pas antérieur à celle du début.
            let error_date =   ( ( date_debut instanceof Date && !isNaN(date_debut.valueOf()) && date_fin instanceof Date && !isNaN(date_fin.valueOf()) ) && date_debut > date_fin  ) ? true : false;
            $("#gain_fin input").removeClass("is-invalid");
            
            if( error_date == false ){

                let dataPost = {
                    _token : "{{ csrf_token() }}",
                    debut : debut , 
                    fin : fin
                };
                
                $.post( '{{route("dashboard_gain_liste")}}' , dataPost , dataType = "JSON" ).done(function(data){
                    let backgroundColor = 'rgba(0, 123, 255 , 0.4)';
                    let borderColor = 'rgba(0, 123, 255 , 0.2)';

                    if(data["total_gain_original"] < 0){
                         backgroundColor = 'rgba(220, 53, 69 , 0.4)';
                         borderColor = 'rgba(220, 53, 69 , 0.8)'
                    }

                    myChartgain.data.datasets[0].backgroundColor = backgroundColor;
                    myChartgain.data.datasets[0].borderColor = borderColor;
                    $("#gain_total").parent().parent().css("background-color" , backgroundColor).css("border-color" , borderColor);

                        let chiffre_affaire = Object.entries(data["chiffre_affaire"]);
                        console.log("--------->", chiffre_affaire);
                        let gain = Object.entries(data["gain"]);
                        if(data["total_gain"] != undefined){
                            $("#gain_total").html(data["total_gain"]);
                        }
                        if(data["total_chiffre_affarie"] != undefined){

                            $("#chiffre_affaire_total , #general_total ").html(data["total_chiffre_affarie"]);  
                                                  }
                        if(chiffre_affaire.length > 0){
                            // vider les anciens données
                            myChartgain.data.labels = [];
                            myChartgain.data.datasets[0].data = [];
                            myChartgain.data.datasets[1].data = [];
                            myChartgain.update();
                           

                            gain.forEach(function(e , i){
                                myChartgain.data.labels[i] = e[0];
                                myChartgain.data.datasets[0].data[i] = e[1];
                                myChartgain.data.datasets[1].data[i] = chiffre_affaire[i][1];
                              
                                myChartgain.update();
                            })
                            
                        }
                        else{
                            removeData(myChartgain);
                        }

                        console.log(myChartgeneral.data.datasets[0].data);
                            //myChartgeneral.data.labels = []
                            myChartgeneral.data.datasets[0].data[0] = data['total_gain_original'] < 0 ? 0 : data['total_gain_original'];
                            myChartgeneral.data.datasets[0].data[1] = data['cout_essence'];
                            myChartgeneral.data.datasets[0].data[2] = data['cout_salarial'];
                            myChartgeneral.data.datasets[0].data[3] = data['cout_livraison'];
                            myChartgeneral.data.datasets[0].data[4] = data['revient_moyen'];
                            myChartgeneral.data.datasets[0].data[5] = data['daily_rent'] * data['days_numbre'];

                            myChartgeneral.update();
                        
                   
                });

            }else if( error_date) {

                $("#gain_fin input").addClass("is-invalid");
               
            }
        });

        // ------------- Evenement pour depense
        var debut_periode_depense = 0;
        
        $(document).on("click", "#btn-chart_depense_left", function(e){
            // Pour afficher les dépense périodique les plus anciennes
            debut_periode_depense++;
            get_periodique_depense(debut_periode_depense);
        });

        $(document).on("click", "#btn-chart_depense_right", function(e){
            // Pour afficher les dépense périodique les plus recentes
            if(debut_periode_depense > 0){
                debut_periode_depense--;
            }
            get_periodique_depense(debut_periode_depense);
        });

        $(document).on("click, focusout" , "#date_depense_debut , #date_depense_fin" , function(e){
            let debut = $("#date_depense_debut").find("input").val();
            let fin = $("#date_depense_fin").find("input").val() ;
            let date_debut = debut != "" ? new Date(debut) : "";
            let date_fin = fin != "" ? new Date(fin) : "";

            // verifier si la date de fin que l'utilisateur a saisi n'est pas antérieur à celle du début.
            let error_date =   ( ( date_debut instanceof Date && !isNaN(date_debut.valueOf()) && date_fin instanceof Date && !isNaN(date_fin.valueOf()) ) && date_debut > date_fin  ) ? true : false;
            $("#date_depense_fin input").removeClass("is-invalid");
            
            if( error_date == false  ){

                let dataPost = {
                    _token : "{{ csrf_token() }}",
                    debut : debut , 
                    fin : fin
                };
                
                $.post( '{{route("dashboard_depense_liste")}}' , dataPost , dataType = "JSON" ).done(function(data){

                    $("#depense_total").html(data.depense_total);

                    if(data.depense.length > 0){
                        // vider les anciens données
                        myChart.data.labels = [];
                        myChart.data.datasets[0].data = [];
                        myChart.update();

                        data.depense.forEach(function(e , i){

                            myChart.data.labels[i] = e.type;
                            myChart.data.datasets[0].data[i] = e.montant_total;
                            myChart.update();
                        })
                        
                    }else{

                        removeData(myChart);
                    }
                });

            }else if( error_date) {

                $("#date_depense_fin input").addClass("is-invalid");
               
            }
            
        });

        // functions
        function removeData(chart) {
            let data_remove_int = setInterval(() => {
                if(chart.data.labels.length > 0){
                    chart.data.labels.pop();
                    chart.data.datasets.forEach((dataset) => {
                    dataset.data.pop();
                });
                    chart.update();
                }else{
                    clearInterval(data_remove_int);
                }

            }, 200);
        }

        function get_periodique_depense(debut) {
            var url_depense_periodique = "{{ route('depense_periodique') }}"+"/"+debut;
            $.ajax(url_depense_periodique , {} , dataType = "JSON").done(function(data){
                console.log(data.length);
                if(data.length == 0){
                    debut_periode_depense--;
                }
                
                myChartDepense.data.labels = [];
                myChartDepense.data.datasets[0].data = [];
                myChartDepense.update();

                data.forEach(function(e , i){

                    myChartDepense.data.labels[i] = e.mois+" "+e.annee;
                    myChartDepense.data.datasets[0].data[i] = e.montant_total;
                    myChartDepense.update();
                });
            })
        }


    </script>
@endsection

