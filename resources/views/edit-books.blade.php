@extends('index')

@section('content')
<form action="{{ route('books.update') }}" method="POST">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{ $book->id }}">
    <div class="mb-3">
        <h3>Ubah data buku</h3>
    </div>
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" value="{{ $book->title }}" id="judul" placeholder="Masukkan judul"
            name="title">
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $book->deskripsi }}</textarea>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Pilih author</label>
        <div class="form-group row">
            <div class="col-md-6 col-12">
                <select name="author_id" id="author" class="form-select">
                    <option value="">Pilih author</option>
                    @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : ''}}>{{
                        $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 col-12">
                <a href="/authors" class="btn btn-warning">Tambah author baru</a>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<x-alert />
@endsection