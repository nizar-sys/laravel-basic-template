@extends('layouts.app')
@section('title', 'Users DataTable')

@section('title-header', 'Users DataTable')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Users DataTable</li>
@endsection
@section('content')
    {{-- modal --}}
    @include('_partials.modals.modal-crud-user')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Users DataTable</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Avatar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    var tablePengguna = $('#table-data').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('datatable.users') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'role'
            },
            {
                data: 'avatar',
                orderable: false,
                searchable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari Data",
            lengthMenu: "Menampilkan _MENU_ data",
            zeroRecords: "Data tidak ditemukan",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ data)",
            paginate: {
                previous: '<i class="fa fa-angle-left"></i>',
                next: "<i class='fa fa-angle-right'></i>",
            }
        },
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data Users',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-sm btn-success',
                exportOptions: {
                    stripHtml: false,
                    columns: [1, 2, 3, 4],
                    sheetName: 'Data User',
                    sheetHeader: true,
                    sheetFooter: false,
                    exportData: {
                        decodeEntities: true,
                    },
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Data Users',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-sm btn-danger',
                exportOptions: {
                    columns: [1, 2, 3, 4]
                },
                // set alignment option
                customize: function (doc) {
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                    doc.content[1].table.widths = ['*', '*', '*', '*', '*'];

                    // import img from data base64
                    var img = $('.img-avatar').map(function() {
                        return this.src;
                    }).get();

                    for (var i = 0, c = 1; i < img.length; i++, c++) {
                            doc.content[1].table.body[c][3] = {
                                image: img[i],
                                width: 50,
                                height: 50
                            }
                        }
                }
            },
            {
                extend: 'print',
                title: 'Data Users',
                text: '<i class="fas fa-print"></i> Print',
                className: 'btn btn-sm btn-info',
                exportOptions: {
                    stripHtml : false,
                    columns: [1, 2, 3, 4]
                }
            },
            @if(Auth::user()->role == 'admin')
            {
                title: "Tambah Data",
                text: '<i class="fas fa-plus"></i> Tambah Data',
                className: 'btn btn-default btn-sm',
                action: function (e, dt, node, config) {
                    createData();
                }
            }
            @endif
        ],
    });

    var idModal = '#modal-crud-user';
    var modal = $(idModal);
    var form = modal.find(idModal + 'Form');
    var formData = form.serialize();

    function createData() {
        modal.modal('show')
            .find(idModal + 'Title').text('Tambah Data');
        
        console.log(formData);
    }

    function updateData(id) {
        modal.modal('show')
            .find(idModal + 'Title').text('Edit Data')
    }

    
    function deleteData(id) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            var url = "{{ route('users.destroy', ':id') }}";
            url = url.replace(':id', id);
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire(
                                'Terhapus!',
                                res.message,
                                'success'
                            ).then(function() {
                                tablePengguna.ajax.reload();
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Data gagal dihapus.',
                                'error'
                            );
                        }
                    }
                });
            }
        });
    }
</script>
@endsection