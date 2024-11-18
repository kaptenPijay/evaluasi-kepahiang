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
        <a href="/back-office/sub-kegiatan-realisasi"
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
                    <th class="text-center">No</th>
                    <th class="text-start">Nama Sub Kegiatan</th>
                    <th class="text-start">Indikator</th>
                    <th class="text-start">Anggaran</th>
                    <th class="text-center">Target</th>
                    <th class="text-center">Satuan</th>
                    <th class="text-center">TW 1</th>
                    <th class="text-center">TW 2</th>
                    <th class="text-center">TW 3</th>
                    <th class="text-center">TW 4</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('indikatorSubKegiatan.modal.delete')
@include('indikatorSubKegiatan.modal.create')
@include('indikatorSubKegiatan.modal.edit')
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
                url: "{{ route('indikatorSubKegiatan.index') }}"
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
                    searchable: true,
                    className: "text-start"
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
                    data: 'tw_1',
                    name: 'tw_1',
                    searchable: true
                },
                {
                    data: 'tw_2',
                    name: 'tw_2',
                    searchable: true
                },
                {
                    data: 'tw_3',
                    name: 'tw_3',
                    searchable: true
                },
                {
                    data: 'tw_4',
                    name: 'tw_4',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: true,
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
                `
                <div class="wrapper_top_section_data_table d-flex w-100">
                    <div class="title_table">
                        {{ $title }}
                    </div>
                    <button data-bs-target="#ModalTambah" data-bs-toggle="modal" class="btn small-shadow">
                            Tambah Indikator Sub Kegiatan
                    </button>
                </div>
                `
                );

                $('.section-table-button').append(addButton).css("text-align", "end");
            },
        })
    }
    function deleteData(id) {
        $('#formDelete').attr('action', "{{ route($deleteUrl, '') }}" + '/' + id);
        $('#ModalDelete').modal('show');
    }

    function editData({indikator,id,target,tw_1,tw_2,tw_3,tw_4,kegiatan_id,anggaran,satuan_id}) {
        $("#formEdit select[name='kegiatan_id']").val(kegiatan_id);
        $("#formEdit select[name='satuan_id']").val(satuan_id);
        $("#formEdit input[name='indikator']").val(indikator);
        $("#formEdit input[name='target']").val(target);
        $("#formEdit input[name='anggaran']").val(anggaran);
        $("#formEdit input[name='tw_1']").val(tw_1);
        $("#formEdit input[name='tw_2']").val(tw_2);
        $("#formEdit input[name='tw_3']").val(tw_3);
        $("#formEdit input[name='tw_4']").val(tw_4);
        $('#formEdit').attr('action', "{{ route($updateUrl, '') }}" + '/' + id);
        $('#ModalEdit').modal('show');
    }

</script>
@endsection
