<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users-gear"></i>
        <p>


            PROJE




            <i class="fas fa-angle-left right"></i>

        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-header text-bold font-italic">

            EĞİTİM <i class="fa-solid fa-row nav-icon"></i>
        </li>

        @can('yetkili', 'projeogrenci')
            <li class="nav-item">

                <a href="{{ route('projeogrenci.index') }}" class="nav-link {{ active('projeogrenci.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Öğrenci Listesi </p>
                </a>

            </li>
        @endcan

        @can('yetkili', 'projehafizlik')
            <li class="nav-item">
                <a href="{{ route('projehafizlik.index') }}" class="nav-link {{ active('projehafizlik.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Öğrenci Hafızlık Listesi </p>
                </a>
            </li>
        @endcan


    </ul>
</li>
