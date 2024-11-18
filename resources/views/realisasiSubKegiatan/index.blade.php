@extends('layouts.mainLayout')
@section('content')
<div class="container-fluid w-100 wrapperDataTableBackOffice regular-shadow data_table_satuan">
    <div class="section-table-button w-100">
        {{-- button --}}
    </div>

    {{-- Progres --}}
    <div class="wrapper_progress w-100">
        <a href="/back-office/indikator-sub-kegiatan"
            class="text-decoration-none wrapper_progress_card {{Request::is('*indikator*') ? 'wrapper_progress_card-active' : ''}}">
            <i class="ri-focus-line"></i>
            Target
        </a>
        <a href="/back-office/kegiatan-realisasi"
            class="text-decoration-none wrapper_progress_card {{Request::is('*realisasi*') ? 'wrapper_progress_card-active' : ''}}">
            <i class="ri-line-chart-line"></i>
            Realisasi
        </a>
        <div class="hr_datatable"></div>
    </div>

    <div class="data_table_container">
        <table class="stripe table-back-office w-100" id="serverSide">
            <thead>
                <tr>
                    <th class="text-start" rowspan="2">No</th>
                    <th class="text-start" rowspan="2">Nama Sub Kegiatan</th>
                    <th class="text-start" rowspan="2">Indikator</th>
                    <th class="text-center" rowspan="2">Total Realisasi Keuangan</th>
                    <th class="text-center" rowspan="2">Total Realisasi Fisik</th>
                    <th class="text-center" rowspan="2">Satuan</th>
                    <th class="text-center" colspan="2">TW 1</th>
                    <th class="text-center" colspan="2">TW 2</th>
                    <th class="text-center" colspan="2">TW 3</th>
                    <th class="text-center" colspan="2">TW 4</th>
                </tr>
                <tr>
                    <th class="text-center">FISIK</th>
                    <th class="text-center">KEUANGAN</th>
                    <th class="text-center">FISIK</th>
                    <th class="text-center">KEUANGAN</th>
                    <th class="text-center">FISIK</th>
                    <th class="text-center">KEUANGAN</th>
                    <th class="text-center">FISIK</th>
                    <th class="text-center">KEUANGAN</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('realisasiSubKegiatan.modal.delete')
@include('realisasiSubKegiatan.modal.edit')
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
@endsection
@section('custom_js')
<script type="text/javascript">
    $(document).ready(function(){
        loadData()
    })
    function loadData(){
        $('#serverSide').DataTable({
            processing: true,
            pagination: true,
            responsive: true,
            serverSide: true,
            searching: true,
            ordering: false,
            ajax:{
                url: "{{ route('realisasiSubKegiatan.index') }}"
            },
            columns:[
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    className: "text-start"
                },
                {
                    data: 'indikator',
                    name: 'indikator',
                    searchable: true,
                    className: "text-start"
                },
                {
                    data: 'anggaran',
                    name: 'anggaran',
                    searchable: true
                },
                {
                    data: 'target',
                    name: 'target',
                    searchable: true
                },
                {
                    data: 'satuan',
                    name: 'satuan',
                    searchable: true
                },
                {
                    data: 'tw_1_fisik',
                    name: 'tw_1_fisik',
                    searchable: true
                },
                {
                    data: 'tw_1_anggaran',
                    name: 'tw_1_anggaran',
                    searchable: true
                },
                {
                    data: 'tw_2_fisik',
                    name: 'tw_2_fisik',
                    searchable: true
                },
                {
                    data: 'tw_2_anggaran',
                    name: 'tw_2_anggaran',
                    searchable: true
                },
                {
                    data: 'tw_3_fisik',
                    name: 'tw_3_fisik',
                    searchable: true
                },
                {
                    data: 'tw_3_anggaran',
                    name: 'tw_3_anggaran',
                    searchable: true
                },
                {
                    data: 'tw_4_fisik',
                    name: 'tw_4_fisik',
                    searchable: true
                },
                {
                    data: 'tw_4_anggaran',
                    name: 'tw_4_anggaran',
                    searchable: true
                },
            ],
            language: {
                search: '',
                searchPlaceholder: "Cari Data...",
                lengthMenu: "_MENU_ entries per page",
            },
            pagingType: 'simple_numbers',
            initComplete: function () {
                var addButton = $(
                `<div class="wrapper_top_section_data_table d-flex w-100">
                    <div class="title_table">
                        {{ $title }}
                    </div>
                    <button data-bs-target="#ModalEdit" data-bs-toggle="modal" class="btn small-shadow">
                            Update Realisasi Kegiatan
                    </button>
                </div>`
                );

                $('.section-table-button').append(addButton).css("text-align", "end");
            },
        })
    }
    function deleteData(id) {
        $('#formDelete').attr('action', "{{ route($deleteUrl, '') }}" + '/' + id);
        $('#ModalDelete').modal('show');
    }
</script>
@endsection
