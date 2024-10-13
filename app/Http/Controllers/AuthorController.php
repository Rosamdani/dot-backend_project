<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = \App\Models\Author::all();
        return view('authors', [
            'authors' => $authors
        ]);
    }

    public function store(AuthorRequest $request)
    {
        \App\Models\Author::create($request->all());
        return redirect('/authors')->with('success', 'Data author berhasil ditambahkan');
    }

    public function show($id)
    {
        $author = \App\Models\Author::find($id);
        return new \App\Http\Resources\AuthorResource($author);
    }

    public function edit($id)
    {
        $author = \App\Models\Author::find($id);
        return view('edit-author', [
            'author' => $author
        ]);
    }

    public function update(AuthorRequest $request)
    {
        $author = \App\Models\Author::find($request->id);
        $author->update($request->all());
        return redirect('/authors')->with('success', 'Data author berhasil diubah');
    }

    public function delete(Request $request)
    {
        $author = \App\Models\Author::find($request->id);
        $author->delete();
        return redirect('/authors')->with('success', 'Data author berhasil dihapus');
    }
}
