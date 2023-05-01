<li class="nav-item">
    @can('yetkili', 'muhasebe')
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-gear"></i>
            <p>
                MUHASEBE
                <i class="fas fa-angle-left right"></i>

            </p>
        </a>
    @endcan
    <ul class="nav nav-treeview">


        @can('yetkili', 'muhasebe')
            <li class="nav-item">
                <a href="{{ route('muhasebe.index',Auth::id()) }}" class="nav-link {{ active('muhasebe.index') }}">
                    <i class="fa-solid fa-people-group nav-icon"></i>
                    <p>Makbuzlar</p>
                </a>
            </li>
        @endcan
            @can('yetkili', 'ogrenciodeme')
                <li class="nav-item">
                    <a href="{{ route('muhasebe.ogrenci',Auth::id()) }}" class="nav-link {{ active('muhasebe.ogrenci') }}">
                        <i class="fa-solid fa-people-group nav-icon"></i>
                        <p>Öğrenci Ödeme</p>
                    </a>
                </li>
            @endcan
            @can('yetkili', 'hocaodeme')
                <li class="nav-item">
                    <a href="{{ route('muhasebe.hoca',Auth::id()) }}" class="nav-link {{ active('muhasebe.hoca') }}">
                        <i class="fa-solid fa-people-group nav-icon"></i>
                        <p>Hoca Ödeme</p>
                    </a>
                </li>
            @endcan
            @can('yetkili', 'root')
                <li class="nav-item">
                    <a href="{{ route('makbuzset.index') }}" class="nav-link {{ active('makbuzset.index') }}">
                        <i class="fa-solid fa-people-group nav-icon"></i>
                        <p>Muhasebe Ayar</p>
                    </a>
                </li>
            @endcan




    </ul>
</li>
