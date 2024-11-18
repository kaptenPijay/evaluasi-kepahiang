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
                        <label class="labelText mb-1" for="name">Nama</label>
                        <input value="{{ old('name') }}" name="name" type="text"
                            class="form-control {{ $errors->has('name') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Nama" required>

                        @error('name')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="labelText mb-1" for="year">Tahun</label>
                        <input value="{{ old('year') }}" name="year" type="text"
                            class="form-control {{ $errors->has('year') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Nama" required>

                        @error('year')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>


                    @can('superAdmin')
                    <div class="form-group">
                        <label for="bidang_id" class="labelText mb-1" id="labelText">Pilih Bidang</label>
                        <select name="bidang_id" class="form-select">
                            @foreach ($dataBidangs as $item)
                            <option value="{{ $item->id }}" {{ old('bidang_id')==$item->id ? 'selected' : '' }}>{{
                                $item->name }}</option>
                            @endforeach
                            @error('bidang_id')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </select>
                    </div>
                    @else
                    <input type="hidden" value="{{ Auth::user()->bidang_id }}" class="d-none" name="bidang_id">
                    @endcan
                    <div class="d-flex mt-1" style="justify-content: space-between">
                        <button class="btn btn-danger"
                            style="background-color: #F3F4F7 !important; border: none !important" type="button"
                            data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit" id="btnSubmit">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
