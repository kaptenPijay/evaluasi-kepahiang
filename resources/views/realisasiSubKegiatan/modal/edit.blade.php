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
            <form action="{{ route('realisasiSubKegiatan.update') }}" method="POST" id="formEdit">
                @csrf
                <div class="modal-body"
                    style="display: flex; flex-direction:column; justify-content:space-between; display: flex; flex-direction: column; row-gap: 1em">

                    <div class="form-group">
                        <label for="sub_kegiatan_id" class="labelText mb-1" id="labelText">Pilih Kegiatan</label>
                        <select name="sub_kegiatan_id" class="form-select" id="sub_kegiatan_id">
                            <option value="" selected disabled>Pilih Kegiatan</option>
                            @foreach ($dataSubKegiatan as $item)
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
                        <label class="labelText mb-1" for="indikator_id">Indikator</label>
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
                        <label class="labelText mb-1" for="tw">Pilih triwulan</label>
                        <select name="tw" class="form-select" id="tw">
                            <option value="" selected disabled>Pilih Triwulan</option>
                            <option value="tw_1">TW 1</option>
                            <option value="tw_2">TW 2</option>
                            <option value="tw_3">TW 3</option>
                            <option value="tw_4">TW 4</option>
                            @error('tw')
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
                        <label class="labelText" for="tw_value_anggaran">Realisasi Keuangan</label>
                        <input value="{{ old('tw_value_anggaran') }}" name="tw_value_anggaran" id="tw_value_anggaran" type="text"
                            class="form-control {{ $errors->has('tw_value_anggaran') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Nama" oninput="formatNumber(this)">

                        @error('tw_value_anggaran')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="labelText" for="tw_value_fisik">Realisasi Fisik</label>
                        <input value="{{ old('tw_value_fisik') }}" name="tw_value_fisik" id="tw_value_fisik" type="text"
                            class="form-control {{ $errors->has('tw_value_fisik') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Nama">

                        @error('tw_value_fisik')
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
    <script>
        $(document).ready(function () {
            $('#sub_kegiatan_id').change(function () {
                let sub_kegiatan_id = $(this).val();

                if (sub_kegiatan_id) {
                    $.ajax({
                        url: `{{ route('realisasiSubKegiatan.dataProgram', '') }}/${sub_kegiatan_id}`,
                        type: "GET",
                        success: function (response) {
                            if (response.indikatorData  && response.indikatorData.length > 0) {
                                $.each(response.indikatorData, function (key, item) {
                                    $('#indikator_id').append(
                                        `<option value="${item.id}">${item.indikator}</option>`
                                    );
                                });
                                $('#indikator_id').change(function () {
                                    let dataTarget = $(this).val();
                                    let filteredTarget = response.indikatorData.find(item => item.id == dataTarget);
                                    const { target, tw_1_fisik, tw_2_fisik, tw_3_fisik, tw_4_fisik,tw_1_anggaran,tw_2_anggaran,tw_3_anggaran,tw_4_anggaran } = filteredTarget.realisasi_sub_kegiatan
                                    let today = new Date();
                                    function isDateInRange(start, end) {
                                        let startDate = new Date(start);
                                        let endDate = new Date(end);
                                        return today >= startDate && today <= endDate;
                                    }
                                    document.getElementById('tw').addEventListener('change', () => {
                                        let twVal = document.getElementById('tw').value;
                                        const twAnggaran = document.getElementById('tw_value_anggaran');
                                        const twFisik = document.getElementById('tw_value_fisik');

                                        const twDataMap = {
                                            'tw_1': {
                                                data: response.dataTriwulan.find(item => item.name == 'TW 1'),
                                                anggaran: tw_1_anggaran,
                                                fisik: tw_1_fisik,
                                            },
                                            'tw_2': {
                                                data: response.dataTriwulan.find(item => item.name == 'TW 2'),
                                                anggaran: tw_2_anggaran,
                                                fisik: tw_2_fisik,
                                            },
                                            'tw_3': {
                                                data: response.dataTriwulan.find(item => item.name == 'TW 3'),
                                                anggaran: tw_3_anggaran,
                                                fisik: tw_3_fisik,
                                            },
                                            'tw_4': {
                                                data: response.dataTriwulan.find(item => item.name == 'TW 4'),
                                                anggaran: tw_4_anggaran,
                                                fisik: tw_4_fisik,
                                            }
                                        };

                                        const selectedTw = twDataMap[twVal];
                                        if (selectedTw) {
                                            const { data, anggaran, fisik } = selectedTw;
                                            const isDisabled = !isDateInRange(data.start_date, data.end_date);

                                            twAnggaran.value = anggaran;
                                            twFisik.value = fisik;
                                            twAnggaran.disabled = isDisabled;
                                            twFisik.disabled = isDisabled;
                                        }
                                    });
                                });
                            }
                        },
                        error: function (xhr) {
                            console.error("Gagal memuat data indikator.");
                        }
                    });
                }
            });
        });
        function formatNumber(input) {
            let value = input.value.replace(/\D/g, '');

            if (value.length > 0) {
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            input.value = value;
    }
    function formatNumberUpdate(value) {
        return value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
    </script>
