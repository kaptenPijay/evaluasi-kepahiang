{{-- <form action="{{route('cetakLaporan.cetak', ['tipe-laporan' => 'evaluasi'])}}" method="POST" --}} <form
  action="{{route('cetakLaporan.cetak')}}" method="POST" style="display: flex; flex-direction: column; row-gap: 1em">

  @csrf
  <div class="form-group">
    <label class="labelText mb-1" for="indikator">Bidang<span class="text-danger">*</span></label>
    <select required id="bidang_laporan" name="bidang_laporan" class="form-select">
      <option value="" selected>Pilih bidang</option>
      @foreach ($allBidang as $item)
      <option value="{{ $item->id }}" {{ old('bidang_laporan')==$item->id ? 'selected' : '' }}>{{
        $item->name }}</option>
      @endforeach
    </select>
    @error('bidang_laporan')
    <div class="text-danger">
      <span>{{ $message }}</span>
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label class="labelText mb-1" for="indikator">Tahun<span class="text-danger">*</span></label>
    <select required disabled id="tahun_anggaran" name="tahun_anggaran" class="form-select">
      <option value="" selected>Pilih tahun</option>
    </select>
    @error('tahun_anggaran')
    <div class="text-danger">
      <span>{{ $message }}</span>
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label class="labelText mb-1" for="indikator">Triwulan<span class="text-danger">*</span></label>
    <select required name="triwulan_laporan" class="form-select">
      <option value="" selected>Pilih triwulan</option>
      <option value="1">Triwulan 1</option>
      <option value="2">Triwulan 2</option>
      <option value="3">Triwulan 3</option>
      <option value="4">Triwulan 4</option>
    </select>
    @error('triwulan_laporan')
    <div class="text-danger">
      <span>{{ $message }}</span>
    </div>
    @enderror
  </div>

  {{-- Button --}}
  <button class="button_print" type="submit">
    Cetak Laporan
  </button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  // --> Reset option in year select input
  function resetOptionYear(isInit){
      $("#tahun_anggaran").prop('disabled', isInit);
    $('#tahun_anggaran')
    .find('option')
    .remove()
    .end()
    .append('<option value="" selected>Pilih tahun</option>')
    .val('')
  }

  $(document).ready(function(){
    $('#bidang_laporan').change(function(){
      const bidangId = $(this).val()
      if(bidangId !== ''){
        resetOptionYear(true)
        $.ajax({
          url: `{{route('cetakLaporan.tahunBidang', '')}}/${bidangId}`,
          type: "GET",
          success: function(response){
            // --> validate length of response
            if(response.tahunBidang.length === 0){
              resetOptionYear(false)
              return
            }

            // --> Set new option into year select
            $.each(response.tahunBidang, (key, item) => {
              $('#tahun_anggaran').append(
              `<option value="${item.year}">${item.year}</option>`
              );
            })
            $("#tahun_anggaran").prop('disabled', false);
          }
        })
      } else {
        resetOptionYear(true)
      }
    })
  })
</script>