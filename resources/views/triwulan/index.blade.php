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
                    <th class="text-start">Tanggal Mulai</th>
                    <th class="text-start">Tanggal Selesai</th>
                    <th class="text-center">AKSI</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('triwulan.modal.edit')
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
                url: "{{ route('triwulan.index') }}"
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
                    data: 'start_date',
                    name: 'start_date',
                    searchable: true,
                    className: "text-start"
                },
                {
                    data: 'end_date',
                    name: 'end_date',
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
                </div>`
                );

                $('.section-table-button').append(addButton).css("text-align", "end");
            },
        })
    }
    function editData({name,id,start_date,end_date}) {
        $("#formEdit input[name='name']").val(name);
        $("#formEdit input[name='start_date']").val(start_date);
        $("#formEdit input[name='end_date']").val(end_date);
        $('#formEdit').attr('action', "{{ route($updateUrl, '') }}" + '/' + id);
        $('#ModalEdit').modal('show');
        cekRole(role);
    }
</script>
@endsection
