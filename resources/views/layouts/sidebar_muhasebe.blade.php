<li class="nav-item">
    @can('yet', 'muhasebe')
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-gear"></i>
            <p>
                MUHASEBE
                <i class="fas fa-angle-left right"></i>

            </p>
        </a>
    @endcan
    <ul class="nav nav-treeview">


        @can('yet', 'muhasebe')
            <li class="nav-item">
                <a href="{{ route('muhasebe.index',Auth::id()) }}" class="nav-link {{ active('muhasebe.index') }}">
                    <i class="fa-solid fa-people-group nav-icon"></i>
                    <p>Makbuzlar</p>
                </a>
            </li>
        @endcan
            @can('yet', 'kasa')
                <li class="nav-item">
                    <a href="{{ route('kasa.index',Auth::id()) }}" class="nav-link {{ active('kasa.index') }}">
                        <i class="fa-solid fa-people-group nav-icon"></i>
                        <p>Kasa</p>
                    </a>
                </li>
            @endcan
            @can('yet', 'ogrenciodeme')
                <li class="nav-item">
                    <a href="{{ route('muhasebe.ogrenci',Auth::id()) }}" class="nav-link {{ active('muhasebe.ogrenci') }}">
                        <i class="fa-solid fa-people-group nav-icon"></i>
                        <p>Öğrenci Ödeme</p>
                    </a>
                </li>
            @endcan
            @can('yet', 'hocaodeme')
                <li class="nav-item">
                    <a href="{{ route('muhasebe.hoca',Auth::id()) }}" class="nav-link {{ active('muhasebe.hoca') }}">
                        <i class="fa-solid fa-people-group nav-icon"></i>
                        <p>Hoca Ödeme</p>
                    </a>
                </li>
            @endcan
            @can('yet', 'root')
                <li class="nav-item">
                    <a href="{{ route('makbuzset.index') }}" class="nav-link {{ active('makbuzset.index') }}">
                        <i class="fa-solid fa-people-group nav-icon"></i>
                        <p>Muhasebe Ayar</p>
                    </a>
                </li>
            @endcan




    </ul>
</li>
