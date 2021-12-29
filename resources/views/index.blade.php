<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  {{-- <link rel="icon" type="image/png" sizes="16x16" href="{{  asset('assets/images/favicon.png') }}"> --}}
  <title>{{ config('app.name') }}</title>

  {{-- css --}}
  <link href="{{ asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets\libs\sweetalert2\dist\sweetalert2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets\libs\select2\dist\css\select2-bootstrap4.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets\libs\select2\dist\css\select2.min.css') }}" rel="stylesheet" />
  
  <!--This page CSS -->
  @stack('page-css')
</head>

<body class="bg-info p-5">

    {{-- Start content --}}
        <div class="container-fluid">
            <div class="card card-body">
                <div class="d-flex align-items-center mb-4">
                    <h4 class="card-title">{{ config('app.name') }}</h4>
                    <div class="ml-auto">
                        <div class="form-actions">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info btn-sm px-3" id="tambah"><i class="fas fa-plus"></i> New User</button>
                            </div>
                        </div>
                    </div>
                </div>
            <br>
                <table class="table no-wrap v-middle mb-0 data-table">
                    <thead>
                        <tr class="border-0">
                            <th class="border-0 font-14 font-weight-medium" width="5%">No</th>
                            <th class="border-0 font-14 font-weight-medium">ID Pengguna</th>
                            <th class="border-0 font-14 font-weight-medium">Nama</th>
                            <th class="border-0 font-14 font-weight-medium">Alamat</th>
                            <th class="border-0 font-14 font-weight-medium">Nomor Telepon</th>
                            <th class="border-0 font-14 font-weight-medium">Downline</th>
                            <th class="border-0 font-14 font-weight-medium  text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        {{-- call modal --}}
        @extends('modal')
    {{-- end content --}}



    <!-- All Jquery -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- apps -->
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>

    <!--Custom JavaScript -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>

    <!--This plugin for data table -->
    <script src="{{ asset('assets\extra-libs\datatables.net\js\jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('dist\js\pages\datatable\datatable-basic.init.js') }}"></script>
    <script src="{{ asset('dist\js\my-script.js') }}"></script>
    <script src="{{ asset('assets\libs\sweetalert2\dist\sweetalert2.min.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('assets\libs\select2\dist\js\select2.min.js') }}"></script>

    <!--This page JavaScript -->
    <script type="text/javascript">
        // data table
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            rowId:"id",
            ajax: "{{ route('route_DataTable') }}",
            columns: [
                {orderable:false,searchable:false,data:'DT_RowIndex',name: 'DT_RowIndex'},
                {data: 'daftar_nomor_id', name: 'daftar_nomor_id'},
                {data: 'nama', name: 'nama'},
                {data: 'alamat', name: 'alamat', orderable: false},
                {data: 'nomor_telepon', name: 'nomor_telepon'},
                {data: 'jumlah', name: 'jumlah', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        // menjalankan fungsi tombol hapus
        $(document).on('click', '#hapusData', function(e) {
            e.preventDefault();
            var url = "{{ route('route_destroy') }}";
            var csrf= '{{ csrf_token() }}';
            var dataText= $(this).attr('data-text');
            var id= $(this).attr('data-id');
            deleteConfirm(url,table,dataText,csrf,id);
        });
        // menjalankan tombol lihat
        $(document).on('click', '#detail',function (e) {
            e.preventDefault();
            let element = $(this);
            show_loading(element, "");
            let id=$(this).attr('data-id');
            $.ajax({
                type: 'get',
                url: "/show/"+id,
                success: function(data) {
                hide_loading(element, 'eye', '', '');
                $('#modalDialogLabel').html("Tambah Data")
                $('#modalDialogSize').addClass("modal-lg")
                $('#modalDialogData').html(data);
                $('#modalDialog').modal({
                    backdrop: 'static'
                })
                $('#modalDialog').modal("show");
                }
            });
        });
        // menjalankan tombol tambah
        $(document).on('click', '#tambah',function (e) {
            e.preventDefault();
            let element = $(this);
            show_loading(element, "full");
            $.ajax({
                type: 'get',
                url: "/tambah",
                success: function(data) {
                hide_loading(element, 'plus', 'full', 'New User');
                $('#modalDialogLabel').html("Tambah Data")
                $('#modalDialogSize').addClass("modal-lg")
                $('#modalDialogData').html(data);
                $('#modalDialog').modal({
                    backdrop: 'static'
                })
                $('#modalDialog').modal("show");
                }
            });
        });
        // menjalankan fungsi tambah
        $(document).on('submit', '#formCreate', function(e) {
            e.preventDefault();
            clear_error_withStyle()
            show_loading("#btnCreate", "full");
            $.ajax({
                url: '/insert',
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    hide_loading('#btnCreate', '', 'full', 'Create');
                    if (data.status) {
                        clearInput();
                        $('#modalDialog').modal("hide");
                        Swal.fire("Berhasil!", data.message, "success").then(function() {
                            table.ajax.reload();
                        });
                    }else{
                        Swal.fire("Gagal !", data.message, "error").then(function() {
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    hide_loading('#btnCreate', '', 'full', 'Create');
                    check_errors_withStyle(xhr.responseJSON.errors);
                }
            });
        });
        // menjalankan tombol Edit
        $(document).on('click', '#editData',function (e) {
            e.preventDefault();
            let element = $(this);
            show_loading(element, "");
            let id=$(this).attr('data-id');
            $.ajax({
                type: 'get',
                url: "/edit/"+id,
                success: function(data) {
                hide_loading(element, 'edit', '', '');
                $('#modalDialogLabel').html("Edit Data")
                $('#modalDialogSize').addClass("modal-lg")
                $('#modalDialogData').html(data);
                $('#modalDialog').modal({
                    backdrop: 'static'
                })
                $('#modalDialog').modal("show");
                }
            });
        });
        // menjalankan fungsi Edit 
        $(document).on('submit', '#formEdit', function(e) {
            e.preventDefault();
            clear_error_withStyle()
            show_loading("#btnEdit", "");
            $.ajax({
                url: `/update`,
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    hide_loading('#btnEdit', '', '', 'Edit');
                    if (data.status) {
                        clearInput();
                        $('#modalDialog').modal("hide");
                        Swal.fire("Berhasil!", data.message, "success").then(function() {
                            table.ajax.reload();
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    hide_loading('#btnEdit', '', '', 'Edit');
                    check_errors_withStyle(xhr.responseJSON.errors);
                }
            });
        });
        //ajax menampilkan data berdasarkan id
        $('body').on('change', '#upline', function() {
            var id = $("#upline").val();
            $.ajax({
                url: `/getDataByID/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $("input[name='notelp']").val(data[0]['nomor_telepon']);
                    $("input[name='almt']").val(data[0]['alamat']);
                    console.log(data);
                },
                error:function(data){
                    $("input[name='nama']").val(' -');
                    $("#almt").val(' -');
                }
            });
        }); 
    </script>
</body>

</html>