<!-- Modal -->
<div class="modal fade modalForm modalSingleCol" id="ModalEdit" tabindex="-1" role="dialog"
    aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content large-shadow">
            {{-- Modal header --}}
            <div class="modal-header" style="border-bottom: none !important; padding: 1rem 2rem 0rem 2rem !important">
                <div class="modal-title" id="exampleModalLabel">Edit Data</div>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri ri-close-line"></i>
                </button>
            </div>

            {{-- Modal body --}}
            <form action="" method="POST" id="formEdit">
                @csrf
                @method('PUT')
                <div class="modal-body"
                    style="display: flex; flex-direction:column; justify-content:space-between; display: flex; flex-direction: column; row-gap: 1em">

                    <div class="form-group">
                        <label for="kegiatan_id" class="labelText mb-1" id="labelText">Pilih Kegiatan</label>
                        <select name="kegiatan_id" class="form-select">
                            <option value="">Pilih Kegiatan</option>
                            @foreach ($dataKegiatan as $item)
                            <option value="{{ $item->id }}" {{ old('kegiatan_id')==$item->id ? 'selected' : ''
                                }}>{{
                                $item->name }}</option>
                            @endforeach
                            @error('kegiatan_id')
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
                            <option value="{{ $item->id }}" {{ old('satuan_id') == $item->id ? 'selected' : '' }}>{{
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
                                    placeholder="0" type="number" required>
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
                                    placeholder="0" type="number" required>
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
                                    placeholder="0" type="number" required>
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
                                    placeholder="0" type="number" required>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
