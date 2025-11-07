<!-- BELUM SESUAI CSS NYA -->

@extends('layouts.admin')

@section('content')
<h1>Edit Kategori Klinis</h1>

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.kategori-klinis.update', $kategori->idkategori_klinis) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nama Kategori Klinis:</label>
    <input type="text" name="nama_kategori_klinis" value="{{ old('nama_kategori_klinis', $kategori->nama_kategori_klinis) }}" required>
    <button type="submit">Update</button>
</form>
@endsection
