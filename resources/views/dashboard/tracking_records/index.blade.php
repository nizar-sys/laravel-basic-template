@extends('layouts.app')
@section('title', 'Data Pengiriman')

@section('title-header', 'Data Pengiriman')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Pengiriman</li>
@endsection

@section('action_btn')
    @php
        $startDate = request()->start_date ?? null;
        $endDate = request()->end_date ?? null;

        $queryParams = [];

        if ($startDate) {
            $queryParams['start_date'] = $startDate;
        }

        if ($endDate) {
            $queryParams['end_date'] = $endDate;
        }

        $url = route('tracking-records.reports', $queryParams);

    @endphp
    <a href="{{ $url }}" target="__blank" class="btn btn-danger">Buat Laporan</a>
    <a href="{{ route('tracking-records.create') }}" class="btn btn-default">Tambah Data</a>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#filter-date-modal">Filter</button>
    @if ($startDate || $endDate)
        <a href="{{ route('tracking-records.index') }}" class="btn btn-danger">Reset</a>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data Pengiriman</h2>
                    <div class="table-responsive">
                        <table id="trackingRecordsTable" class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nomor Resi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trackingRecords as $tracking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@date($tracking->created_at)</td>
                                        <td>{{ $tracking->tracking_number }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('tracking-records.edit', $tracking->id) }}"
                                                class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            <form id="delete-form-{{ $tracking->id }}"
                                                action="{{ route('tracking-records.destroy', $tracking->id) }}"
                                                class="d-none" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{ $tracking->id }}')"
                                                class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-center">Total Pengiriman</th>
                                    <th>{{ $trackingRecords->total() }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4">
                                        {{ $trackingRecords->links() }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Filter Range Date -->
    <div class="modal fade" id="filter-date-modal" tabindex="-1" role="dialog" aria-labelledby="filter-date-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filter-date-modal-label">Filter Range Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ old('start_date', request()->start_date) }}">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ old('start_date', request()->end_date) }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        function deleteForm(id) {
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit()
                }
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#trackingRecordsTable').DataTable();
        });
    </script>
@endsection
