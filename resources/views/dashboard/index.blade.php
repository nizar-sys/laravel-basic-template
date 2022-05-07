@extends('layouts.app')
@section('title', 'Dashboard')
@php
    $auth = Auth::user();
@endphp

@section('breadcrumb')
<li class="breadcrumb-item active"><a
href="{{ route('home') }}">Dashboard</a></li>
@endsection
