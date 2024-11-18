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
                    <th class="text-start">Nama</th>
                    <th class="text-start">Role</th>
                    <th class="text-start">Bidang</th>
                    <th class="text-start">No Hp</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('user.modal.delete')
@include('user.modal.create')
@include('user.modal.edit')
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
                url: "{{ route('user.index') }}"
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
                    data: 'role',
                    name: 'role',
                    searchable: true,
                    className: "text-start"
                },
                {
                    data: 'bidang',
                    name: 'bidang',
                    searchable: true,
                    className: "text-start"
                },
                {
                    data: 'nohp',
                    name: 'nohp',
                    searchable: true,
                    className: "text-start"
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
                `<div class="wrapper_top_section_data_table d-flex w-100">
                    <div class="title_table">
                        {{ $title }}
                    </div>
                    <button data-bs-target="#ModalTambah" data-bs-toggle="modal" class="btn small-shadow">
                            Tambah Data
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

    function editData({name,username,nohp,role,bidang_id,id}) {
        $("#formEdit input[name='name']").val(name);
        $("#formEdit input[name='username']").val(username);
        $("#formEdit input[name='nohp']").val(nohp);
        $("#formEdit select[name='role']").val(role);
        $("#formEdit select[name='bidang_id']").val(bidang_id);
        $('#formEdit').attr('action', "{{ route($updateUrl, '') }}" + '/' + id);
        $('#ModalEdit').modal('show');
        cekRole(role);
    }
</script>
@endsection