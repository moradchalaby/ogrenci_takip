@php
$user_birim = App\Models\Birim::leftJoin('birimhoca', 'birim.birim_id', '=', 'birimhoca.birim_id')
    ->select()
    ->where('birimhoca.kullanici_id', Auth::user()->id)
    ->get();

@endphp

@foreach ($user_birim as $birim)
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-gear"></i>
            <p>


                {{ $birim->birim_ad }}




                <i class="fas fa-angle-left right"></i>

            </p>
        </a>
        <ul class="nav nav-treeview">

            <li class="nav-header text-bold font-italic">

                EĞİTİM <i class="fa-solid fa-row nav-icon"></i>
            </li>

            @can('yetkili', 'birimogrenci')
                <li class="nav-item">

                    <a href="{{ route('birimogrenci.index', $birim->birim_id) }}"
                        class="nav-link {{ active('ogrenci.index') }}">
                        <i class="fa-solid fa-row nav-icon"></i>
                        <p>Öğrenci Listesi </p>
                    </a>

                </li>
            @endcan

            @can('yetkili', 'birimhafizlik')
                <li class="nav-item">
                    <a href="{{ route('birimhafizlik.index', $birim->birim_id) }}"
                        class="nav-link {{ active('hafizlik.index') }}">
                        <i class="fa-solid fa-row nav-icon"></i>
                        <p>Öğrenci Hafızlık Listesi </p>
                    </a>
                </li>
            @endcan


        </ul>
    </li>
@endforeach
