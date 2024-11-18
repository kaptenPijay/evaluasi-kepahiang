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
    <h4 class="title_pdf">LAPORAN STANDAR PELAYANAN MINIMAL (SPM) BIDANG KESEHATAN </h4>
    <h4 class="title_pdf">TAHUN ANGGARAN 2024</h4>

    <table>
        <thead>
            <tr class="row_header">
                <th class="center" rowspan="3">No</td>
                <th class="center" rowspan="3">Indikator</td>
                <th class="center" rowspan="3">Sasaran</td>
                <th class="center" rowspan="3">Anggaran</td>
                <th class="center" colspan="16">Realisasi</th>
                <th class="center" colspan="4" rowspan="2">Realisasi S.d Tw II</th>
            </tr>
            <tr class="row_header">
                <th class="center" colspan="4">Tw I</th>
                <th class="center" colspan="4">Tw II</th>
                <th class="center" colspan="4">Tw III</th>
                <th class="center" colspan="4">Tw IV</th>
            </tr>
            <tr class="row_header">
                <th class="center">Capaian</th>
                <th class="center">%</th>
                <th class="center">Realisasi Anggaran</th>
                <th class="center">%</th>

                <th class="center">Capaian</th>
                <th class="center">%</th>
                <th class="center">Realisasi Anggaran</th>
                <th class="center">%</th>

                <th class="center">Capaian</th>
                <th class="center">%</th>
                <th class="center">Realisasi Anggaran</th>
                <th class="center">%</th>

                <th class="center">Capaian</th>
                <th class="center">%</th>
                <th class="center">Realisasi Anggaran</th>
                <th class="center">%</th>

                <th class="center">Capaian</th>
                <th class="center">%</th>
                <th class="center">Realisasi Anggaran</th>
                <th class="center">%</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->indikator }}</td>
                    <td>{{ $item->target }}</td>
                    <td>Rp. {{ number_format($item->anggaran, 0, ',', '.') }}</td>
                    {{-- tw 1 --}}
                    <td>{{ $item->target }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_1_fisik/$item->target * 100 }}%</td>
                    <td>Rp. {{ number_format($item->realisasiSubKegiatan->tw_1_anggaran,0,',','.') }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_1_anggaran/$item->anggaran * 100 }}%</td>
                    {{-- tw 2 --}}
                    <td>{{ $item->target }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_2_fisik/$item->target * 100 }}%</td>
                    <td>Rp. {{ number_format($item->realisasiSubKegiatan->tw_2_anggaran,0,',','.') }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_2_anggaran/$item->anggaran * 100 }}%</td>
                    {{-- tw 3 --}}
                    <td>{{ $item->target }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_3_fisik/$item->target * 100 }}%</td>
                    <td>Rp. {{ number_format($item->realisasiSubKegiatan->tw_3_anggaran,0,',','.') }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_3_anggaran/$item->anggaran * 100 }}%</td>
                    {{-- tw 4 --}}
                    <td>{{ $item->target }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_4_fisik/$item->target * 100 }}%</td>
                    <td>Rp. {{ number_format($item->realisasiSubKegiatan->tw_4_anggaran,0,',','.') }}</td>
                    <td>{{ $item->realisasiSubKegiatan->tw_4_anggaran/$item->anggaran * 100 }}%</td>

                    <td>{{ $item->realisasiSubKegiatan->tw_1_fisik + $item->realisasiSubKegiatan->tw_2_fisik }}</td>
                    <td>{{ (($item->realisasiSubKegiatan->tw_1_fisik + $item->realisasiSubKegiatan->tw_2_fisik)/$item->target) * 100 }}%</td>
                    <td>Rp. {{ number_format($item->realisasiSubKegiatan->tw_1_anggaran + $item->realisasiSubKegiatan->tw_2_anggaran,0,',','.') }}</td>
                    <td>{{ (($item->realisasiSubKegiatan->tw_1_anggaran + $item->realisasiSubKegiatan->tw_2_anggaran)/$item->anggaran) * 100 }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>

</html>
