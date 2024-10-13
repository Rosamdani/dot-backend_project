@extends('index')

@section('content')
<form action="{{ route('authors.update') }}" method="POST">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{ $author->id }}">
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" value="{{ $author->name }}" class="form-control" id="nama" name="name"
            placeholder="Masukkan nama">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" value="{{ $author->email }}" id="email" name="email"
            placeholder="Masukkan email">
    </div>
    <div class="mb-3">
        <label for="no_telp" class="form-label">No. Telp</label>
        <input type="text" class="form-control" value="{{ $author->no_telp }}" id="no_telp" name="no_telp"
            placeholder="Masukkan no. telp">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<x-alert />
@endsection