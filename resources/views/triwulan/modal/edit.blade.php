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
                        <label class="labelText mb-1" for="start_date">Tanggal Mulai</label>
                        <input value="{{ old('start_date') }}" name="start_date" type="date"
                            class="form-control {{ $errors->has('start_date') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Nama" required>

                        @error('start_date')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="labelText mb-1" for="end_date">Tanggal Berakhir</label>
                        <input value="{{ old('end_date') }}" name="end_date" type="date"
                            class="form-control {{ $errors->has('end_date') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Nama" required>

                        @error('end_date')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
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
