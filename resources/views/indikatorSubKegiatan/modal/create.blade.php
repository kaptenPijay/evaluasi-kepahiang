<!-- Modal -->
<div class="modal fade modalForm modalDoubleCol" id="ModalTambah" tabindex="-1" role="dialog"
    aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document"
        style="display: flex; justify-content:center">
        <div class="modal-content">
            {{-- Modal header --}}
            <div class="modal-header" style="border-bottom: none !important; padding: 1rem 2rem 0rem 2rem !important">
                <div class="modal-title" id="exampleModalLabel">Tambah Data</div>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri ri-close-line"></i>
                </button>
            </div>

            {{-- Modal body --}}
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="{{ route('indikatorSubKegiatan.store') }}" method="POST" id="formData"
                    style="display: flex; flex-direction: column; row-gap: 1em">
                    @csrf
                    <div class="form-group">
                        <label for="sub_kegiatan_id" class="labelText mb-1" id="labelText">Pilih Sub Kegiatan</label>
                        <select name="sub_kegiatan_id" class="form-select">
                            @foreach ($dataKegiatan as $item)
                            <option value="{{ $item->id }}" {{ old('sub_kegiatan_id')==$item->id ? 'selected' : '' }}>{{
                                $item->name }}</option>
                            @endforeach
                            @error('sub_kegiatan_id')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="labelText mb-1" for="indikator">Indikator</label>
                        <input value="{{ old('indikator') }}" name="indikator" type="text"
                            class="form-control {{ $errors->has('indikator') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Indikator" required>

                        @error('indikator')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="labelText mb-1" for="anggaran">Anggaran</label>
                        <input value="{{ old('anggaran') }}" name="anggaran" type="text"
                            class="form-control {{ $errors->has('anggaran') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan anggaran" onkeyup="formatRupiah(this)" required>

                        @error('anggaran')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="labelText mb-1" for="target">Target</label>
                        <input type="number" value="{{ old('target') }}" name="target" type="text"
                            class="form-control {{ $errors->has('target') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Target" required>

                        @error('target')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="satuan_id" class="labelText mb-1" id="labelText">Pilih Satuan</label>
                        <select name="satuan_id" class="form-select">
                            @foreach ($dataSatuans as $item)
                            <option value="{{ $item->id }}" {{ old('satuan_id')==$item->id ? 'selected' : '' }}>{{
                                $item->name }}</option>
                            @endforeach
                            @error('satuan_id')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelText mb-1" for="tw_1">Triwulan 1</label>
                                <input value="{{ old('tw_1') }}" name="tw_1" type="text"
                                    class="form-control {{ $errors->has('tw_1') ? 'border-danger' : 'border-none' }}"
                                    placeholder="0" type="text" required>

                                @error('tw_1')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelText mb-1" for="tw_2">Triwulan 2</label>
                                <input value="{{ old('tw_2') }}" name="tw_2" type="text"
                                    class="form-control {{ $errors->has('tw_2') ? 'border-danger' : 'border-none' }}"
                                    placeholder="0" type="text" required>

                                @error('tw_2')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelText mb-1" for="tw_3">Triwulan 3</label>
                                <input value="{{ old('tw_3') }}" name="tw_3" type="text"
                                    class="form-control {{ $errors->has('tw_3') ? 'border-danger' : 'border-none' }}"
                                    placeholder="0" type="text" required>

                                @error('tw_3')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelText mb-1" for="tw_4">Triwulan 4</label>
                                <input value="{{ old('tw_4') }}" name="tw_4" type="text"
                                    class="form-control {{ $errors->has('tw_4') ? 'border-danger' : 'border-none' }}"
                                    placeholder="0" type="text" required>

                                @error('tw_4')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-1" style="justify-content: space-between">
                        <button class="btn btn-danger"
                            style="background-color: #F3F4F7 !important; border: none !important" type="button"
                            data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" id="btnSubmit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function formatRupiah(element) {
        let value = element.value.replace(/[^,\d]/g, "").toString();
        let split = value.split(",");
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        element.value = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
    }

    document.addEventListener("DOMContentLoaded", function() {
        let element = document.getElementById('anggaran');
        element.value = formatRupiah(element);
    });
</script>
<style>
    .input-group {
        border: 1px solid var(--cui-input-border-color, #b1b7c1);
        border-radius: 0.375rem;
    }

    .input-group:focus-within {
        color: var(--cui-input-focus-color, rgba(44, 56, 74, 0.95));
        background-color: var(--cui-input-focus-bg, #fff);
        border-color: var(--cui-input-focus-border-color, #998fed);
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(50, 31, 219, 0.25);
    }

    .input-group input {
        border: none;
        width: fit-content !important;
        border-right: none;
    }

    .input-group input:focus-within {
        background-color: transparent;
        border-color: transparent;
        outline: 0;
        box-shadow: none;
    }

    .toggle-password {
        border-left: none !important;
        border: var(--bs-border-width) solid var(--bs-border-color);
    }

    .toggle-password:hover {
        border-color: var(--bs-border-color) !important;
    }

    .toggle-password:active {
        border-color: var(--bs-border-color) !important;
    }
</style>
