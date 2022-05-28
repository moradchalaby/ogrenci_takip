<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users-gear"></i>
        <p>
            @can('yetkili', 'root')
                birimim
            @elsecan('birimsorumlu', 'birimsorumlu')
                {{ App\Models\Birim::where('birim_id', App\Models\Birimsorumlu::where('kullanici_id', Auth::user()->id)->first()->birim_id)->first()->birim_ad }}
            @endcan



            <i class="fas fa-angle-left right"></i>

        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-header text-bold font-italic">

            EĞİTİM <i class="fa-solid fa-row nav-icon"></i>
        </li>

        @can('yetkili', 'birimogrenci')
            <li class="nav-item">
                <a href="{{ route('birimogrenci.index') }}" class="nav-link {{ active('ogrenci.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Öğrenci Listesi </p>
                </a>
            </li>
        @endcan

        @can('yetkili', 'birimhafizlik')
            <li class="nav-item">
                <a href="{{ route('birimhafizlik.index') }}" class="nav-link {{ active('hafizlik.index') }}">
                    <i class="fa-solid fa-row nav-icon"></i>
                    <p>Öğrenci Hafızlık Listesi </p>
                </a>
            </li>
        @endcan


    </ul>
</li>
