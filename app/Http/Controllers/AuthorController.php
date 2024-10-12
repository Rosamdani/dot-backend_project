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
}