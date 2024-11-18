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
    <h4 class="title_pdf">EVALUASI PELAKSANAAN RENJA TRIWULAN {{$maxTw}} DINAS KESEHATAN KABUPATEN KEPAHIANG</h4>
    <h4 class="title_pdf">TAHUN ANGGARAN {{$tahun}}</h4>

    <table>
      <tr class="row_header">
        <td class="center">No</td>
        <td class="center">Sasaran Kada/Sasaran OPD/Program</td>
        <td class="center">Indikator Sasaran Kada/Sasaran OPD/Program</td>
        <td class="center">Target <br> ({{$tahun}})</td>
        <td class="center">Target Kinerja Triwulan</td>
        <td class="center">Realisasi Kinerja Triwulan</td>
        <td class="center">Total Realisasi Kinerja s.d TW {{$maxTw}}</td>
        <td class="center">Kegiatan</td>
        <td class="center">Indikator Kegiatan</td>
        <td class="center">Target <br> ({{$tahun}})</td>
        <td class="center">Target Kinerja Triwulan</td>
        <td class="center">Realisasi Kinerja Triwulan</td>
        <td class="center">Total Realisasi Kinerja s.d TW {{$maxTw}}</td>
        <td class="center">Sub Kegiatan</td>
        <td class="center">Indikator Sub Kegiatan</td>
        <td class="center">Satuan</td>
        <td class="center">Target Kinerja Kumulatif <br> ({{$tahun}})</td>
        <td class="center">Target TW I</td>
        <td class="center">Target TW II</td>
        <td class="center">Target TW III</td>
        <td class="center">Target TW IV</td>
        <td class="center">Jumlah</td>
        <td class="center">Realisasi Kinerja Triwulan</td>
        <td class="center">Total Realisasi Kinerja s.d TW {{$maxTw}}</td>
      </tr>
      @foreach ($data as $idx => $item)
      @foreach ($item['dataChild'] as $idx_2 => $indikator )
      <tr>
        <td class="center_xy">{{$idx_2 === 0 ? $idx + 1 : ''}}</td>
        <td class="center_xy">{{$idx_2 === 0 ? $item['programName'] : ''}}</td>
        <td class="center_xy">{{$indikator['indicatorName']}}</td>
        <td class="center_xy">{{$indikator['targetIndicator']}}</td>
        <td>
          @foreach ($indikator['targetTriwulan'] as $idx_3 => $targetTriwulan)
          <p>TW {{$idx_3 + 1}} = {{$targetTriwulan['tw']}} </p>
          @endforeach
        </td>
        <td>
          @foreach ($indikator['realisasiTriwulan'] as $idx_3 => $realisasiTriwulan)
          <p>TW {{$idx_3 + 1}} = {{$realisasiTriwulan['tw']}} </p>
          @endforeach
        </td>
        <td class="center_xy"> {{$indikator['totalRealisasi']}} </td>
        @for ($i = 0; $i < 17; $i++) <td>
          </td>
          @endfor
      </tr>
      @endforeach

      @endforeach
    </table>
  </div>
</body>

</html>