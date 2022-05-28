@can('idari', 'idari')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-gear"></i>
            <p>
                İDARE
                <i class="fas fa-angle-left right"></i>

            </p>
        </a>
        <ul class="nav nav-treeview">
        @endcan
        @can('yetkili', 'idarihoca')
            <li class="nav-item">
                <a href="{{ route('idarihoca.index') }}" class="nav-link {{ active('idarihoca.index') }}">
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
        @can('yetkili', '/birimsorumlu')
            <li class="nav-item">
                <a href="{{ route('birimsorumlu.index') }}" class="nav-link {{ active('birimsorumlu.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Birim Sorumluları</p>
                </a>
            </li>
        @endcan
        @can('yetkili', 'idari')
            <li class="nav-header text-bold font-italic">

                PERSONEL <i class="fa-solid fa-row nav-icon"></i>
            </li>
        @endcan
        @can('yetkili', '/hafizlikhoca')
            <li class="nav-item">
                <a href="{{ route('hafizlikhoca.index') }}" class="nav-link {{ active('hafizlikhoca.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Hafızlık Hocaları</p>
                </a>
            </li>
        @endcan
        @can('yetkili', '/ihtisashoca')
            <li class="nav-item">
                <a href="{{ route('ihtisashoca.index') }}" class="nav-link {{ active('ihtisashoca.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>İhtisas Hocaları</p>
                </a>
            </li>
        @endcan
        @can('yetkili', '/bekarhoca')
            <li class="nav-item">
                <a href="{{ route('bekarhoca.index') }}" class="nav-link {{ active('bekarhoca.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Bekar Hocalar</p>
                </a>
            </li>
        @endcan
        @can('yetkili', '/birimhoca')
            <li class="nav-item">
                <a href="{{ route('birimhoca.index') }}" class="nav-link {{ active('birimhoca.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Birim Hocaları</p>
                </a>
            </li>
        @endcan
        @can('yetkili', '/muhtelifhoca')
            <li class="nav-item">
                <a href="{{ route('muhtelifhoca.index') }}" class="nav-link {{ active('muhtelifhoca.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Muhtelif Hocalar</p>
                </a>
            </li>
        @endcan
        @can('yetkili', '/teknikhoca')
            <li class="nav-item">
                <a href="{{ route('teknikhoca.index') }}" class="nav-link {{ active('teknikhoca.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Teknik Personel</p>
                </a>
            </li>
        @endcan




        @can('idari', 'idari')
        @endcan
        @can('egitim', 'egitim')
            <li class="nav-header text-bold font-italic">

                EĞİTİM <i class="fa-solid fa-row nav-icon"></i>
            </li>
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
                <a href="{{ route('hafizlik.index') }}" class="nav-link {{ active('hafizlik.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Tüm Öğrenci Hafızlık Listesi </p>
                </a>
            </li>
        @endcan


        @can('egitim', 'egitim')
        </ul>
    </li>
@endcan
