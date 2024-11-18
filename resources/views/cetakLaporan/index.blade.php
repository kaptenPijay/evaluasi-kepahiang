@extends('layouts.mainLayout')
@section('content')

<style>
  .card_cetak_laporan {
    width: 100%;
    height: 100%;
    background-color: white;
    border-radius: 2px;
    padding: 38px;
  }

  .title_card {
    font-size: 27.67px;
    font-weight: 700;
    line-height: 24px;
  }

  .button_print {
    background-color: #5856D6;
    border-radius: 6px;
    width: 160px;
    height: 38px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #5856D6;

    font-size: 16px;
    line-height: 24px;
    font-weight: 400;
    color: white;
    margin-top: 1em
  }
</style>
<div class="card_cetak_laporan">
  <div class="title_card">
    Cetak Laporan
  </div>

  {{-- Progres --}}
  <div class="wrapper_progress w-100" style="margin: 36px 0px;">
    <button id="button_evaluasi" onclick="changeFormContainer('evaluasi')"
      class="text-decoration-none wrapper_progress_card wrapper_progress_card-active">
      <i class="ri-bar-chart-line"></i>
      Evaluasi
    </button>

    <button id="button_spm" onclick="changeFormContainer('spm')"
      class="text-decoration-none wrapper_progress_card {{Request::is('*realisasi*') ? 'wrapper_progress_card-active' : ''}}">
      <i class="ri-donut-chart-line"></i>
      SPM
    </button>
    <div class="hr_datatable"></div>
  </div>

  {{-- form --}}
  <div id="container_evaluasi" class="w-25">
    @include('cetakLaporan.components.form-evaluasi')
  </div>

  <div id="container_spm" class="w-25 d-none">
    @include('cetakLaporan.components.form-spm')
  </div>

</div>


@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
@endsection
<script>
  const setProgress = (selectedButton, isSelected) => {
    const selectedProgress = document.getElementById(selectedButton)
    if(isSelected){
      selectedProgress.classList.add('wrapper_progress_card-active')
    } else {
      selectedProgress.classList.remove('wrapper_progress_card-active')
    }
  }

  const setVisibleContainer = (selectedContainer, isSelected) => {
    const selectedProgress = document.getElementById(selectedContainer)
    if(isSelected){
      selectedProgress.classList.remove('d-none')
    } else {
      selectedProgress.classList.add('d-none')
    }
  }
  const changeFormContainer = (containerName) => {
    const allContainer = ['evaluasi', 'spm']
    allContainer.forEach((e) => {

      // --> Get Selected container
      const isSelectedContainer = e === containerName

      // --> Set visible and progress
      setProgress(`button_${e}`, isSelectedContainer)
      setVisibleContainer(`container_${e}`, isSelectedContainer)
    })
  }
</script>
@endsection