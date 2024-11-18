<!-- Modal -->
<div class="modal fade modalForm modalDoubleCol" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="display: flex; justify-content:center">
        <div class="modal-content">
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="{{ route('realisasi.update') }}" method="POST" id="formData">
                    @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="program_id" class="labelText">Pilih Program</label>
                            <select name="program_id" id="program_id" class="form-select">
                                <option value="" selected disabled>Pilih Program</option>
                                @foreach ($dataPrograms as $item)
                                    <option value="{{ $item->id }}" {{ old('program_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_id')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="indikator_id" class="labelText">Pilih Indikator</label>
                            <select name="indikator_id" id="indikator_id" class="form-select">
                                <option value="" selected disabled>Pilih indikator</option>
                            </select>
                            @error('indikator_id')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelText" for="target">Target</label>
                                <input value="{{ old('target') }}" name="target" id="target" type="text"
                                    class="form-control {{ $errors->has('target') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Nama" readonly>

                                @error('target')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="labelText" for="tw_1">Triwulan 1</label>
                                    <input value="{{ old('tw_1') }}" name="tw_1" type="text"
                                        class="form-control {{ $errors->has('tw_1') ? 'border-danger' : 'border-none' }}"
                                        placeholder="Masukkan Nama" required>

                                    @error('tw_1')
                                    <div class="text-danger">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="labelText" for="tw_2">Triwulan 2</label>
                                    <input value="{{ old('tw_2') }}" name="tw_2" type="text"
                                        class="form-control {{ $errors->has('tw_2') ? 'border-danger' : 'border-none' }}"
                                        placeholder="Masukkan Nama" required>

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
                                    <label class="labelText" for="tw_3">Triwulan 3</label>
                                    <input value="{{ old('tw_3') }}" name="tw_3" type="text"
                                        class="form-control {{ $errors->has('tw_3') ? 'border-danger' : 'border-none' }}"
                                        placeholder="Masukkan Nama" required>

                                    @error('tw_3')
                                    <div class="text-danger">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="labelText" for="tw_4">Triwulan 4</label>
                                    <input value="{{ old('tw_4') }}" name="tw_4" type="text"
                                        class="form-control {{ $errors->has('tw_4') ? 'border-danger' : 'border-none' }}"
                                        placeholder="Masukkan Nama" required>

                                    @error('tw_4')
                                    <div class="text-danger">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    <div class="d-flex" style="justify-content: end">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" id="btnSubmit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#program_id').change(function () {
            let program_id = $(this).val();

            if (program_id) {
                $.ajax({
                    url: `{{ route('realisasi.dataProgram', '') }}/${program_id}`,
                    type: "GET",
                    success: function (response) {
                        if (response.indikatorData) {
                            $.each(response.indikatorData, function (key, item) {
                                $('#indikator_id').append(
                                    `<option value="${item.id}" {{ old('program_id') == $item->id ? 'selected' : '' }}>${item.indikator}</option>`
                                );
                            });

                            $('#indikator_id').change(function (e) {
                                let dataTarget = $('#indikator_id').find(":selected").val();
                                let filteredTarget = response.indikatorData.find((item) => item.id == dataTarget)
                                $('#target').val(filteredTarget.target);
                            })
                        }
                    },
                    error: function (xhr) {
                        console.error("Gagal memuat data indikator.");
                    }
                });
            }
        });
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
