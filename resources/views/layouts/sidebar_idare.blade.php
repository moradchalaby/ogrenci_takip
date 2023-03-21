<li class="nav-item">
    @can('yetkili', 'idari')
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-gear"></i>
            <p>
                İDARE
                <i class="fas fa-angle-left right"></i>

            </p>
        </a>
    @endcan
    <ul class="nav nav-treeview">


        @can('yetkili', 'personel')
            <li class="nav-item">
                <a href="{{ route('personel.index') }}" class="nav-link {{ active('personel.index') }}">
                    <i class="fa-solid fa-people-group nav-icon"></i>
                    <p>PERRSONEL</p>
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



        <li class="nav-header text-bold font-italic">

            EĞİTİM <i class="fa-solid fa-row nav-icon"></i>
        </li>

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
        @can('yetkili', 'hafizlik')
            <li class="nav-item">
                <a href="{{ route('hocahafizlik.index') }}" class="nav-link {{ active('hocahafizlik.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Hafızlık Hoca Rapor </p>
                </a>
            </li>
        @endcan


    </ul>
</li>
