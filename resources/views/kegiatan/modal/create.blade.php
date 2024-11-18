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
                <form action="{{ route('kegiatan.store') }}" method="POST" id="formData"
                    style="display: flex; flex-direction: column; row-gap: 1em">
                    @csrf

                    <div class="form-group">
                        <label for="program_id" class="labelText mb-1" id="labelText">Pilih Program</label>
                        <select name="program_id" class="form-select" id="program_id">
                            <option value="" selected disabled>Pilih Program</option>
                            @foreach ($dataPrograms as $item)
                            <option value="{{ $item->id }}" {{ old('program_id')==$item->id ? 'selected' : '' }}>{{
                                $item->name }}</option>
                            @endforeach
                            @error('program_id')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="labelText mb-1" for="name">Nama Kegiatan</label>
                        <input value="{{ old('name') }}" name="name" type="text"
                            class="form-control {{ $errors->has('name') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Nama" required>

                        @error('name')
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
