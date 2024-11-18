<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $title ?? 'SAPA' }}</title>

  {{-- Icons --}}
  {{--
  <link rel="shortcut icon" href="{{ asset('/static/utils/logo/sapa-icon.png') }}"> --}}

  <!-- Fonts -->
  {{--
  <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
  {{--
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}

  <!-- Styles -->
  {{-- @stack('styles') --}}
  {{-- @vite(['resources/css/dashboard.css', 'resources/css/components/components.css', 'resources/css/views/views.css',
  --}}
  {{-- 'resources/css/utils/utils.css']) --}}
  {{-- @vite(['resources/scss/app.scss', 'resources/scss/components/components.scss']) --}}

  <!-- CDN -->
  {{-- <script src="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script> --}}

  <!-- Scripts -->
  {{-- @stack('scripts') --}}
  {{-- @vite(['resources/js/admin.js']) --}}
  {{-- @livewireStyles --}}
</head>
<style>
  table {
    width: 100%;
    border-collapse: collapse;
  }

  table,
  th,
  tr,
  td {
    border: 1px solid black;
  }

  th,
  td {
    padding: 8px;
    text-align: left;
    vertical-align: top;
  }

  .row_header {
    background-color: #f2f2f2;
  }

  .center {
    text-align: center;
  }

  .start {
    text-align: start;
  }

  .center_xy {
    vertical-align: middle;
    text-align: center
  }
</style>

<body>
  <div class="center">
    <h4 class="title_pdf">LAPORAN SPM REKAP DINAS BIDANG KESEHATAN TAHUN 2024</h4>
    <h4 class="title_pdf">DINAS KESEHATAN KABUPATEN KEPAHIANG</h4>

    <table>
        <thead>
            <tr class="row_header">
                <th class="center" rowspan="2">No</td>
                <th class="center" rowspan="2">Indikator</td>
                <th class="center" rowspan="2">Sasaran</td>
                <th class="center" rowspan="2">target</td>
                <th class="center" colspan="11">Realisasi</th>
            </tr>
            <tr class="row_header">
                <th class="center">Tw 1</th>
                <th class="center">Tw 2</th>
                <th class="center">Tw 1 S.d TW 2</th>

                <th class="center">Tw 3</th>
                <th class="center">Tw 1 S.d TW 3</th>

                <th class="center">Tw 1</th>
                <th class="center">Tw 1 S.d TW 4</th>

                <th class="center">% TW 1</th>
                <th class="center">% TW 2</th>
                <th class="center">% TW 3</th>
                <th class="center">% TW 4</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->indikator }}</td>
                    <td>{{ $item->target }}</td>
                    <td>100%</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_1_fisik }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_2_fisik }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_1_fisik + $item->realisasiSubKegiatan->tw_2_fisik }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_3_fisik }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_1_fisik + $item->realisasiSubKegiatan->tw_3_fisik }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_4_fisik }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_1_fisik + $item->realisasiSubKegiatan->tw_4_fisik }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_1_fisik/$item->target * 100 }}%</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_2_fisik/$item->target * 100 }}%</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_3_fisik/$item->target * 100 }}%</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_4_fisik/$item->target * 100 }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>

</html>
