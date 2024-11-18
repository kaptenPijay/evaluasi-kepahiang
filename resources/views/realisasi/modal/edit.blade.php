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
            <form action="{{ route('realisasi.update') }}" method="POST" id="formEdit">
                @csrf
                <div class="modal-body"
                    style="display: flex; flex-direction:column; justify-content:space-between; display: flex; flex-direction: column; row-gap: 1em">

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
                        <label class="labelText mb-1" for="indikator">Indikator</label>
                        <select name="indikator_id" class="form-select" id="indikator_id">
                            <option value="" selected disabled>Pilih Indikator</option>
                            @error('indikator_id')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </select>

                        @error('indikator')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="labelText mb-1" for="target">Target</label>
                        <input value="{{ old('target') }}" name="target" type="text"
                            class="form-control {{ $errors->has('target') ? 'border-danger' : 'border-none' }}"
                            placeholder="Jumlah Target" id="target" readonly>

                        @error('target')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="labelText mb-1" for="satuan">Satuan</label>
                        <input value="{{ old('satuan') }}" name="satuan" type="text"
                            class="form-control {{ $errors->has('satuan') ? 'border-danger' : 'border-none' }}"
                            placeholder="Jumlah satuan" id="satuan" readonly>

                        @error('satuan')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelText mb-1" for="tw_1">Triwulan 1</label>
                                <input value="{{ old('tw_1') }}" id="tw_1" name="tw_1" type="text"
                                    class="form-control {{ $errors->has('tw_1') ? 'border-danger' : 'border-none' }}"
                                    placeholder="0" type="number" onblur="setDefault(this)">

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
                                <input value="{{ old('tw_2') }}" id="tw_2" name="tw_2" type="text"
                                    class="form-control {{ $errors->has('tw_2') ? 'border-danger' : 'border-none' }}"
                                    placeholder="0" type="number" onblur="setDefault(this)">

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
                                <input value="{{ old('tw_3') }}" id="tw_3" name="tw_3" type="text"
                                    class="form-control {{ $errors->has('tw_3') ? 'border-danger' : 'border-none' }}"
                                    placeholder="0" type="number" onblur="setDefault(this)">

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
                                <input value="{{ old('tw_4') }}" id="tw_4" name="tw_4" type="text"
                                    class="form-control {{ $errors->has('tw_4') ? 'border-danger' : 'border-none' }}"
                                    placeholder="0" type="number" onblur="setDefault(this)">

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
    <script>
        $(document).ready(function () {
            $('#program_id').change(function () {
                let program_id = $(this).val();

                if (program_id) {
                    $.ajax({
                        url: `{{ route('realisasi.dataProgram', '') }}/${program_id}`,
                        type: "GET",
                        success: function (response) {
                            if (response.indikatorData && response.indikatorData.length > 0) {
                                $.each(response.indikatorData, function (key, item) {
                                    $('#indikator_id').append(
                                        `<option value="${item.id}">${item.indikator}</option>`
                                    );
                                });
                                $('#indikator_id').change(function () {
                                    let dataTarget = $(this).val();
                                    let filteredTarget = response.indikatorData.find(item => item.id == dataTarget);

                                    const { target, tw_1, tw_2, tw_3, tw_4, satuan} = filteredTarget.realisasi

                                    let today = new Date();
                                    function isDateInRange(start, end) {
                                        let startDate = new Date(start);
                                        let endDate = new Date(end);
                                        return today >= startDate && today <= endDate;
                                    }

                                    $('#target').val(target);
                                    $('#satuan').val(satuan.name);
                                    let tw_1_data = response.dataTriwulan.find(item => item.name == 'TW 1');
                                    let tw_2_data = response.dataTriwulan.find(item => item.name == 'TW 2');
                                    let tw_3_data = response.dataTriwulan.find(item => item.name == 'TW 3');
                                    let tw_4_data = response.dataTriwulan.find(item => item.name == 'TW 4');

                                    $('#tw_1').val(tw_1).prop('disabled', !isDateInRange(tw_1_data.start_date, tw_1_data.end_date));
                                    $('#tw_2').val(tw_2).prop('disabled', !isDateInRange(tw_2_data.start_date, tw_2_data.end_date));
                                    $('#tw_3').val(tw_3).prop('disabled', !isDateInRange(tw_3_data.start_date, tw_3_data.end_date));
                                    $('#tw_4').val(tw_4).prop('disabled', !isDateInRange(tw_4_data.start_date, tw_4_data.end_date));
                                });
                            } else {
                                $('#indikator_id').append('<option value="">Tidak ada indikator tersedia</option>');
                            }
                        },
                        error: function (xhr) {
                            console.error("Gagal memuat data indikator.");
                        }
                    });
                } else {
                    $('#indikator_id').empty().append('<option value="">Pilih Program terlebih dahulu</option>');
                    $('#target').val('');
                }
            });
        });
        function setDefault(input) {
        if (input.value.trim() === '') {
            input.value = '0';
        }
    }
    </script>

