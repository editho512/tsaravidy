
<style>
    @media screen and (min-width: 576px) {
          #tableau_bord {
            display: none !important;
          }
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('commande')}}" class="brand-link">
        <img src="{{asset('assets/images/logo/logo-tsaravidy.jpg')}}" alt="Tsaravidy Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Problock V1.3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/images/avatars/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>
        <div class="user-panel  d-flex" id="tableau_bord" style="">
            <a style="@if(isset($active_dashboard_index))  color:white !important; @endif" href="{{route("dashboard")}}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i>&nbsp;&nbsp;Dashboard</a>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{--<li class="nav-item has-treeview @if(isset($active_dashboard_index)) menu-open @endif">
                    <a href="{{route('dashboard')}}" class="nav-link @if(isset($active_dashboard_index)) {{$active_dashboard_index}} @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            --}}{{--<i class="right fas fa-angle-left"></i>--}}{{--
                        </p>
                    </a>
                </li>--}}
                <li class="nav-item has-treeview @if(isset($active_commande_index)) menu-open @endif">
                    <a href="{{route('commande')}}" class="nav-link @if(isset($active_commande_index)) {{$active_commande_index}} @endif">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Commandes
                            {{--<i class="right fas fa-angle-left"></i>--}}
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview @if(isset($active_matiere_index) || isset($active_matiere_stock) || isset($active_matiere_ajout) || isset($active_matiere_single_add)) menu-open @endif">
                    <a href="#" class="nav-link @if(isset($active_matiere_index)|| isset($active_matiere_stock) || isset($active_matiere_ajout) || isset($active_matiere_single_add)) active @endif">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Matière permière
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('matiere')}}" class="nav-link @if(isset($active_matiere_index)) {{$active_matiere_index}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stock</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('add.single.matiere.view')}}" class="nav-link @if(isset($active_matiere_single_add)) {{$active_matiere_single_add}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ajout matière première</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(isset($active_formule_index) || isset($active_formule_stock) || isset($active_formule_ajout) || isset($active_formule_single_add)) menu-open @endif">
                    <a href="#" class="nav-link @if(isset($active_formule_index)|| isset($active_formule_stock) || isset($active_formule_ajout) || isset($active_formule_single_add)) active @endif">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Produits
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('formule')}}" class="nav-link @if(isset($active_formule_index)) {{$active_formule_index}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Produit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('add.single.formule.view')}}" class="nav-link @if(isset($active_formule_single_add)) {{$active_formule_single_add}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ajout produit</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview @if(isset($active_livraison_index)) menu-open @endif">
                    <a href="{{route('livraison.liste')}}" class="nav-link @if(isset($active_livraison_index)) {{$active_livraison_index}} @endif">
                        <i class="nav-icon fa fa-car"></i>
                        <p>
                            Livraison
                            {{--<i class="right fas fa-angle-left"></i>--}}
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview @if(isset($active_depense_index)) menu-open @endif">
                    <a href="{{route('depense')}}" class="nav-link @if(isset($active_depense_index)) {{$active_depense_index}} @endif">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Depense
                            {{--<i class="right fas fa-angle-left"></i>--}}
                        </p>
                    </a>
                </li>
                
               @can("viewAny" , auth()->user())
                <li class="nav-item has-treeview @if(isset($active_parametre_index) || isset($active_utilisateur) ) menu-open @endif">
                    <a href="#" class="nav-link @if(isset($active_parametre_index)|| isset($active_utilisateur) ) active @endif">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Paramètre
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('utilisateurs')}}" class="nav-link @if(isset($active_parametre_index)) {{$active_parametre_index}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
