@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-5">
    <h1>Selamat Datang di Dashboard Admin 🎉</h1>
    <p>Halo, {{ auth()->user()->name ?? 'Admin' }}!</p>
    <a href="{{ route('logout') }}" class="btn btn-danger mt-3">Logout</a>
</div>
@endsection
