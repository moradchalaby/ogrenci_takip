<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AKMESCİD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/{{ Auth::user()->kullanici_resim }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                <li class="nav-header">MISCELLANEOUS</li>
                <li class="nav-item">
                    <a href="/takvim" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            ANA SAYFA

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('routes.index') }}" class="nav-link {{ active('routes.index') }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            ROUTES

                        </p>


                    </a>
                </li>

                @can('idari', 'idari')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-gear"></i>
                            <p>
                                İDARİ
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        @endcan
                        @can('yetkili', 'idarihoca')
                            <li class="nav-item">
                                <a href="{{ route('idarihoca.index') }}"
                                    class="nav-link {{ active('idarihoca.index') }}">
                                    <i class="fa-solid fa-row nav-icon"></i>
                                    <p>İdari Hocalar</p>
                                </a>
                            </li>
                        @endcan
                        @can('yetkili', 'personel')
                            <li class="nav-item">
                                <a href="{{ route('personel.index') }}" class="nav-link {{ active('personel.index') }}">
                                    <i class="fa-solid fa-people-group nav-icon"></i>
                                    <p>Hocalar</p>
                                </a>
                            </li>
                        @endcan
                        @can('yetkili', 'birim')
                            <li class="nav-item">
                                <a href="{{ route('birim.index') }}" class="nav-link {{ active('birim.index') }}">
                                    <i class="fa-solid fa-address-card nav-icon"></i>
                                    <p>Birimler</p>
                                </a>
                            </li>
                        @endcan
                        @can('yetkili', '/birimhoca')
                            <li class="nav-item">
                                <a href="{{ route('birimhoca.index') }}"
                                    class="nav-link {{ active('birimhoca.index') }}">
                                    <i class="fa-solid fa-row nav-icon"></i>
                                    <p>Birim Sorumluları</p>
                                </a>
                            </li>
                        @endcan
                        @can('yetkili', 'idari')
                            <li class="nav-header">HOCALAR</li>
                        @endcan
                        @can('yetkili', '/hafizlikhoca')
                            <li class="nav-item">
                                <a href="{{ route('hafizlikhoca.index') }}"
                                    class="nav-link {{ active('hafizlikhoca.index') }}">
                                    <i class="fa-solid fa-row nav-icon"></i>
                                    <p>Hafızlık Hocaları</p>
                                </a>
                            </li>
                        @endcan
                        @can('yetkili', '/ihtisashoca')
                            <li class="nav-item">
                                <a href="{{ route('ihtisashoca.index') }}"
                                    class="nav-link {{ active('ihtisashoca.index') }}">
                                    <i class="fa-solid fa-row nav-icon"></i>
                                    <p>İhtisas Hocaları</p>
                                </a>
                            </li>
                        @endcan
                        @can('yetkili', '/bekarhoca')
                            <li class="nav-item">
                                <a href="{{ route('bekarhoca.index') }}"
                                    class="nav-link {{ active('bekarhoca.index') }}">
                                    <i class="fa-solid fa-row nav-icon"></i>
                                    <p>Bekar Hocalar</p>
                                </a>
                            </li>
                        @endcan
                        @can('yetkili', '/muhtelifhoca')
                            <li class="nav-item">
                                <a href="{{ route('muhtelifhoca.index') }}"
                                    class="nav-link {{ active('muhtelifhoca.index') }}">
                                    <i class="fa-solid fa-row nav-icon"></i>
                                    <p>Muhtelif Hocalar</p>
                                </a>
                            </li>
                        @endcan
                        @can('yetkili', '/teknikhoca')
                            <li class="nav-item">
                                <a href="{{ route('teknikhoca.index') }}"
                                    class="nav-link {{ active('teknikhoca.index') }}">
                                    <i class="fa-solid fa-row nav-icon"></i>
                                    <p>Teknik Personel</p>
                                </a>
                            </li>
                        @endcan




                        @can('idari', 'idari')
                        </ul>
                    </li>
                @endcan
                @can('egitim', 'egitim')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-gear"></i>
                            <p>
                                Eğitim
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        @endcan
                        @can('yetkili', 'ogrenci')
                            <li class="nav-item">
                                <a href="{{ route('ogrenci.index') }}" class="nav-link {{ active('ogrenci.index') }}">
                                    <i class="fa-solid fa-row nav-icon"></i>
                                    <p>Tüm Öğrenci Listesi </p>
                                </a>
                            </li>
                        @endcan

                        @can('yetkili', 'hafizlik')
                            <li class="nav-item">
                                <a href="{{ route('hafizlik.index') }}"
                                    class="nav-link {{ active('hafizlik.index') }}">
                                    <i class="fa-solid fa-row nav-icon"></i>
                                    <p>Tüm Öğrenci Hafızlık Listesi </p>
                                </a>
                            </li>
                        @endcan


                        @can('egitim', 'egitim')
                        </ul>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>
