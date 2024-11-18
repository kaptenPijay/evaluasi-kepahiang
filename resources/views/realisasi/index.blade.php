@extends('layouts.mainLayout')
@section('content')
<div class="container-fluid w-100 wrapperDataTableBackOffice regular-shadow data_table_satuan">
    <div class="section-table-button w-100">
        {{-- button --}}
    </div>

    {{-- Progres --}}
    <div class="wrapper_progress w-100">
        <a href="/back-office/indikator"
            class="text-decoration-none wrapper_progress_card {{Request::is('*indikator*') ? 'wrapper_progress_card-active' : ''}}">
            <i class="ri-focus-line"></i>
            Target
        </a>
        <a href="/back-office/realisasi"
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
                    <th class="text-start">Nama Program</th>
                    <th class="text-start">Indikator</th>
                    <th class="text-center">Target</th>
                    <th class="text-center">Satuan</th>
                    <th class="text-center">TW 1</th>
                    <th class="text-center">TW 2</th>
                    <th class="text-center">TW 3</th>
                    <th class="text-center">TW 4</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('realisasi.modal.delete')
@include('realisasi.modal.edit')
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
                url: "{{ route('realisasi.index') }}"
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
                            Update Realisasi
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
