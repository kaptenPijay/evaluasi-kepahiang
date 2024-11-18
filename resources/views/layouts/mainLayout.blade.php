<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./../">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  @vite(['resources/sass/app.scss', 'resources/js/app.js', 'public/css/layout.css', 'public/css/card-dashboard.css',
  'public/css/data-table.css', 'public/css/super-admin.css'])
  {{-- data table cdn --}}
  <link href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" type="image/x-icon" href="{{ asset('images/kemenkes.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <title>Evaluasi Kinerja kepahiang</title>
</head>

<body>
  @include('layouts.components.sidebar')
  <div class="w-100 overflow-y-scroll overflow-x-hidden">
    @include('layouts.components.header')
    <div class="wrapper_main_content">
      @yield('content')
      {{-- <div class="text-end text_footer">
        <span>Aplikasi Kelola Aset Puskesmas</span> © 2024
      </div> --}}
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  @yield('script')
  @yield('custom_js')

</body>


</html>