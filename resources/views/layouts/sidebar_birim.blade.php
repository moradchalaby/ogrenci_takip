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

                @switch($birim->birim_ad)
                    @case('İHTİSAS')
                        @php
                            $link = 'ihtisas';
                        @endphp
                    @break

                    @case('PROJE')
                        @php  $link = 'proje'; @endphp
                    @break

                    $

                    @default
                        @php $link = 'birim'; @endphp
                @endswitch


                <i class="fas fa-angle-left right"></i>

            </p>
        </a>
        <ul class="nav nav-treeview">

            <li class="nav-header text-bold font-italic">

                EĞİTİM <i class="fa-solid fa-row nav-icon"></i>
            </li>

            @can('yet', 'birimogrenci,ihtisasogrenci,projeogrenci')
                <li class="nav-item">



                    <a href="{{ route($link . 'ogrenci.index', $birim->birim_id) }}"
                        class="nav-link {{ active($link . 'ogrenci..index') }}">
                        <i class="fa-solid fa-row nav-icon"></i>
                        <p>Öğrenci Listesi </p>
                    </a>

                </li>
            @endcan

            @can('yet', 'birimhafizlik,ihtisashafizlik,projehafizlik')
                <li class="nav-item">
                    <a href="{{ route($link . 'hafizlik.index', $birim->birim_id) }}"
                        class="nav-link {{ active($link . 'hafizlik.index') }}">
                        <i class="fa-solid fa-row nav-icon"></i>
                        <p>Öğrenci Hafızlık Listesi </p>
                    </a>
                </li>
            @endcan
            @can('yet', 'birimhocahafizlik,ihtisashocahafizlik,projehocahafizlik')
                <li class="nav-item">
                    <a href="{{ route($link . 'hocahafizlik.index', $birim->birim_id) }}"
                        class="nav-link {{ active($link . 'hocahafizlik.index') }}">
                        <i class="fa-solid fa-row nav-icon"></i>
                        <p>Hoca Hafızlık Rapor </p>
                    </a>
                </li>
            @endcan

        </ul>
    </li>
@endforeach
