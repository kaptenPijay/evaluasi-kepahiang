@extends('layouts.mainLayout')
@section('content')
<div class="container-fluid w-100 wrapperDataTableBackOffice regular-shadow data_table_satuan">
    <div class="section-table-button w-100">
        {{-- button --}}
    </div>
    <div class="data_table_container">
        <table class="stripe table-back-office w-100" id="serverSide">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-start">Nama Kegiatan</th>
                    <th class="text-start">Sub Kegiatan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('subKegiatan.modal.delete')
@include('subKegiatan.modal.create')
@include('subKegiatan.modal.edit')
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
                url: "{{ route('subKegiatan.index') }}"
            },
            columns:[
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'kegiatan',
                    name: 'kegiatan',
                    searchable: true,
                    className: "text-start"
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    className: "text-start"
                },
                {
                    data: 'action',
                    name: 'action',
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
                    <button data-bs-target="#ModalTambah" data-bs-toggle="modal" class="btn small-shadow">
                            Tambah Kegiatan
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
    function editData({id,kegiatan_id,name}) {
        $("#formEdit select[name='kegiatan_id']").val(kegiatan_id);
        $("#formEdit input[name='name']").val(name);
        $('#formEdit').attr('action', "{{ route($updateUrl, '') }}" + '/' + id);
        $('#ModalEdit').modal('show');
    }
</script>
@endsection