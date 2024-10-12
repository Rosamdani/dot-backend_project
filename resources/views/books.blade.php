@extends('index')

@section('content')
<form action="{{ route('books.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <h3>Tambah buku baru</h3>
    </div>
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" placeholder="Masukkan judul" name="title">
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Pilih author</label>
        <div class="form-group row">
            <div class="col-md-6 col-12">
                <select name="author_id" id="author" class="form-select">
                    <option value="">Pilih author</option>
                    @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
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

<div class="row mt-2">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5>Terjadi kesalahan</h5>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>

{{-- Card --}}
<div class="row mt-5">
    <div class="card p-0">
        <div class="card-header">
            <h5 class="card-title">Daftar buku</h5>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Author</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $book->title }}</td>
                        <td class="text-truncate">{{ $book->deskripsi }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>
                            <a href="/books/{{ $book->id }}/edit" class="btn btn-warning">Edit</a>
                            <form action="/books/{{ $book->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection