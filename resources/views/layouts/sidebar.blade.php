<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('routes.index') }}" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AKMESCİD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->kullanici_resim }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                <li class="nav-header">AKMESCİD</li>
                <li class="nav-item">
                    <a href="/takvim" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            ANA SAYFA

                        </p>
                    </a>
                </li>
                @can('root', 'root')
                    <li class="nav-item">
                        <a href="{{ route('routes.index') }}" class="nav-link {{ active('routes.index') }}">
                            <i class="nav-icon fas fa-way"></i>
                            <p>
                                ROUTES

                            </p>


                        </a>
                    </li>
                @endcan
                @can('root', 'root')
                    <li class="nav-item">
                        <a href="{{ route('root.index') }}" class="nav-link {{ active('root.index') }}">
                            <i class="nav-icon fas fa-person"></i>
                            <p>ROLLER</p>
                        </a>
                    </li>
                @endcan


                    @include('layouts.sidebar_idare')

                @can('parent', 'muhasebe')
                    @include('layouts.sidebar_muhasebe')
                @endcan


                @can('parent', 'projehafizlik,ihtisassorumlu,birimsorumlu')
                    @include('layouts.sidebar_birim')
                @endcan



                {{-- @endcan --}}
                {{-- @include('layouts.sidebar_muhasebe') --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>
