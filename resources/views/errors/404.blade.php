@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | Page introuvable</title>
@endsection

@section('styles')

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>404 Page introuvable</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('commande')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">404 Page introuvable</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-warning"> 404</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page introuvable.</h3>

                    <p>
                        Nous n'avons pas trouvé la page que vous recherchiez.
                        En attendant, vous pouvez <a href="{{route('commande')}}"> revenir au tableau de bord </a>.
                    </p>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')

@endsection
