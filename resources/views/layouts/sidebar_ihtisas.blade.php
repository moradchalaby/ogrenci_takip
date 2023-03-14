@can('root', 'ihtisassorumlu')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-gear"></i>
            <p>


                {{ App\Models\Birim::where('birim_ad', 'İHTİSAS')->get()[0]->birim_ad }}




                <i class="fas fa-angle-left right"></i>

            </p>
        </a>
        <ul class="nav nav-treeview">

            <li class="nav-header text-bold font-italic">

                EĞİTİM <i class="fa-solid fa-row nav-icon"></i>
            </li>
        @endcan


        @can('root', 'ihtisashafizlik')
            <li class="nav-item">
                <a href="{{ route('ihtisashafizlik.index', App\Models\Birim::where('birim_ad', 'İHTİSAS')->get()[0]->birim_id) }}"
                    class="nav-link {{ active('ihtisashafizlik.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Öğrenci Hafızlık Listesi </p>
                </a>
            </li>
        @endcan
        @can('root', 'ihtisashadis')
            <li class="nav-item">
                <a href="{{ route('ihtisashafizlik.index', App\Models\Birim::where('birim_ad', 'İHTİSAS')->get()[0]->birim_id) }}"
                    class="nav-link {{ active('ihtisashadis.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Öğrenci Hadis Listesi </p>
                </a>
            </li>
        @endcan
        @can('root', 'ihtisassorumlu')
            <li class="nav-header text-bold font-italic">

                SİSTEM <i class="fa-solid fa-row nav-icon"></i>
            </li>
        @endcan
        @can('root', 'ihtisasogrenci')
            <li class="nav-item">

                <a href="{{ route('ihtisasogrenci.index', App\Models\Birim::where('birim_ad', 'İHTİSAS')->get()[0]->birim_id) }}"
                    class="nav-link {{ active('ihtsasogrenci.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Öğrenci Listesi </p>
                </a>

            </li>
        @endcan
        @can('root', 'ihtisasders')
            <li class="nav-item">
                <a href="{{ route('ihtisashafizlik.index', App\Models\Birim::where('birim_ad', 'İHTİSAS')->get()[0]->birim_id) }}"
                    class="nav-link {{ active('ihtisashadis.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Dersler </p>
                </a>
            </li>
        @endcan
        @can('root', 'ihtisassinif')
            <li class="nav-item">
                <a href="{{ route('ihtisashafizlik.index', App\Models\Birim::where('birim_ad', 'İHTİSAS')->get()[0]->birim_id) }}"
                    class="nav-link {{ active('ihtisashadis.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Sınıflar </p>
                </a>
            </li>
        @endcan



        @can('ihtisassorumlu', 'ihtisassorumlu')
        </ul>
    </li>
@endcan
