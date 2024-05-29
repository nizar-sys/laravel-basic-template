@extends('layouts.app')
@section('title', 'Tambah Data Pengiriman')

@section('title-header', 'Tambah Data Pengiriman')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('tracking-records.index') }}">Data Pengiriman</a></li>
    <li class="breadcrumb-item active">Tambah Data Pengiriman</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Pengiriman</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('tracking-records.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="date">Tanggal</label>
                                    <input type="text" class="form-control @error('date') is-invalid @enderror" id="date"
                                        placeholder="Tanggal Pengiriman" value="{{ old('date', \Carbon\Carbon::parse(now())->translatedFormat('d F Y')) }}" disabled name="date">

                                    @error('date')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="tracking_number">Nomor Resi</label>
                                    <input type="text" class="form-control @error('tracking_number') is-invalid @enderror"
                                        id="tracking_number" placeholder="Nomor Resi Pengiriman" value="{{ old('tracking_number') }}"
                                        name="tracking_number">

                                    @error('tracking_number')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('tracking-records.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
