@extends('layouts.main')

@section('title')
    <title>{{env('APP_NAME')}} | 500 Error Page</title>
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
                        <h1>500 Error Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">500 Error Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-danger">500</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Un problème est survenu.</h3>

                    <p>
                        Nous travaillerons à résoudre ce problème tout de suite.
                        En attendant, vous pouvez <a href="{{route('commande')}}"> revenir au tableau de bord </a>.
                    </p>

                </div>
            </div>
            <!-- /.error-page -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')

@endsection
