<?php

namespace App\Http\Controllers;

use App\Http\Requests\BooksRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = \App\Models\Books::all();
        $authors = \App\Models\Author::all();
        return view('books', [
            'books' => $books,
            'authors' => $authors
        ]);
    }

    public function store(BooksRequest $request)
    {
        \App\Models\Books::create($request->all());
        return redirect('/')->with('success', 'Data buku berhasil ditambahkan');
    }

    public function show($id)
    {
        $book = \App\Models\Books::find($id);
        return new \App\Http\Resources\BookResource($book);
    }

    public function edit($id)
    {
        $book = \App\Models\Books::find($id);
        $authors = \App\Models\Author::all();
        return view('edit-books', [
            'book' => $book,
            'authors' => $authors
        ]);
    }

    public function update(BooksRequest $request)
    {
        $book = \App\Models\Books::find($request->id);
        $book->update($request->all());
        return redirect('/')->with('success', 'Data buku berhasil diubah');
    }

    public function destroy($id)
    {
        $book = \App\Models\Books::find($id);
        $book->delete();
        return redirect('/')->with('success', 'Data buku berhasil dihapus');
    }
}
