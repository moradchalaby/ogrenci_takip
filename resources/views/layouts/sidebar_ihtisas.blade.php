@can('projesorumlu', 'projesorumlu')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-gear"></i>
            <p>


                İhtisas




                <i class="fas fa-angle-left right"></i>

            </p>
        </a>
        <ul class="nav nav-treeview">

            <li class="nav-header text-bold font-italic">

                EĞİTİM <i class="fa-solid fa-row nav-icon"></i>
            </li>
        @endcan
        @can('yetkili', 'ihtisasogrenci')
            <li class="nav-item">

                <a href="{{ route('ihtisas.index') }}" class="nav-link {{ active('ihtsasogrenci.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Öğrenci Listesi </p>
                </a>

            </li>
        @endcan

        @can('yetkili', 'ihtisashafizlik')
            <li class="nav-item">
                <a href="{{ route('ihtisashafizlik.index') }}" class="nav-link {{ active('ihtisashafizlik.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Öğrenci Hafızlık Listesi </p>
                </a>
            </li>
        @endcan

        @can('projesorumlu', 'projesorumlu')
        </ul>
    </li>
@endcan
