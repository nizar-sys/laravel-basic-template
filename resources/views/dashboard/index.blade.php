@extends('layouts.app')
@section('title', 'Dashboard')
@php
    $auth = Auth::user();
@endphp

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-secondary" role="alert">
                <h4 class="alert-heading">Dashboard</h4>
                <p class="font-weight-500">Halo {{ auth()->user()->name }}, selamat datang di halaman dashboard admin
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <p class="card-text h3">{{ $userCount }}</p>
                    <h5 class="card-title">Jumlah Pengguna</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <p class="card-text h3">{{ $trackingRecordCount }}</p>
                    <h5 class="card-title">Jumlah Pengiriman</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
