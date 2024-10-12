<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = \App\Models\Books::all();
        return new BookResource($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        // Validasi input pencarian
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|min:1',
            'author' => 'nullable|string|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Ambil parameter pencarian dari request
        $title = $request->input('title');
        $author = $request->input('author');

        // Mulai query berdasarkan parameter
        $query = Books::query();

        // Jika ada parameter title, tambahkan ke query
        if ($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }


        if ($author) {
            $query->whereHas('author', function ($query) use ($author) {
                $query->where('name', 'LIKE', '%' . $author . '%');
            });
        }


        // Jalankan query
        $books = $query->get();
        if ($books->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Tidak ada data yang ditemukan',
                'data' => []
            ], 200);
        }

        return new BookResource($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Books::find($id);
        return new BookResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
