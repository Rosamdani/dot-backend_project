@extends('index')

@section('content')
<form action="{{ route('authors.store') }}" method="POST">
    @csrf
    <h3>Tambah author baru</h3>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="name" placeholder="Masukkan nama">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
    </div>
    <div class="mb-3">
        <label for="no_telp" class="form-label">No. Telp</label>
        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan no. telp">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<x-alert />

<div class="row mt-3">
    <div class="card p-0">
        <div class="card-header">
            <h5 class="card-title">Daftar author</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">No. Telp</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($authors as $author)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->email }}</td>
                        <td>{{ $author->no_telp }}</td>
                        <td>
                            <a href="/authors/edit/{{ $author->id }}" class="btn btn-warning">Edit</a>
                            <form action="/authors/delete/{{ $author->id }}" method="POST" class="d-inline">
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