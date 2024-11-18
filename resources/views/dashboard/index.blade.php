@extends('layouts.mainLayout')
@section('content')
<div class="row" style="column-gap: 1em">
  <div class="col-2 avatar_box">
    {{-- Image avatar --}}
    <div>
      <img src="{{asset('images/avatar.png')}}" alt="avatar">
    </div>
    <div class="hello_text">
      Hello !!!
    </div>
    {{-- Fullname --}}
    <div class="fullName_dashboard">
      {{ auth()->user()->name }}
    </div>
  </div>
  @foreach ($dataDashboard as $item)
  {{-- Card --}}
  <div class="col-2 card_dashboard card_dashboard-{{$item['id']}}">
    <div class="top_card_section d-flex justify-between w-100">
      {{-- Total data --}}
      <div class="total_data_text">
        {{$item['totalData']}}
      </div>

      {{-- Setting botton --}}
      <div>
        <button class="botton_option_dashboard">
          <i class="ri-more-2-line"></i>
        </button>
      </div>
    </div>

    {{-- Mid --}}
    <div class="text_title_section">
      {{$item['cardName']}}
    </div>

    {{-- Graph ilustration --}}
    <div>
      <img src="{{asset($item['assetName'])}}" alt="graph-program" class="graph-illustration">
    </div>
  </div>
  @endforeach

</div>

@endsection