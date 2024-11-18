<form action="{{ route('cetakLaporanPdfSpm.index') }}" style="display: flex; flex-direction: column; row-gap: 1em">
    <div class="form-group">
        <label class="labelText mb-1" for="indikator">Jenis SPM<span class="text-danger">*</span></label>
        <select required id="jenis_spm" name="jenis_spm" class="form-select">
          <option value="" selected disabled>Pilih SPM</option>
          <option value="laporan_tw">Laporan Triwulan</option>
          <option value="rekap_spm">Rekap SPM</option>
          <option value="realisasi_anggaran">Realisasi Anggaran SPM</option>
          <option value="realisasi_capaian">Realisasi Capaian SPM</option>
          <option value="capaian_pkm">Capaian Per PKM</option>
          <option value="tagging_spm">Tagging SPM</option>
          <option value="rekap_ba_pkm">Rekap BA PKM</option>
        </select>
        @error('jenis_spm')
        <div class="text-danger">
          <span>{{ $message }}</span>
        </div>
        @enderror
      </div>

  <div class="form-group">
    <label class="labelText mb-1" for="indikator">Tahun<span class="text-danger">*</span></label>
    <select required id="tahun_anggaran" name="tahun_anggaran" class="form-select">
      <option value="" selected>Pilih Tahun</option>
      @foreach ($allProgram as $program)
      <option value="{{ $program->id }}">{{ $program->year }}</option>
      @endforeach
    </select>
    @error('tahun_anggaran')
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
