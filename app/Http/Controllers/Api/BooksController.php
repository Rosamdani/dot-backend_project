<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
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
        $books = Books::with('author')->get();
        return new BookCollection($books);
    }

    /**
     * Menampilkan detail buku berdasarkan ID.
     */
    public function show($id)
    {
        $book = Books::with('author')->find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku tidak ditemukan',
            ], 404);
        }

        return new BookResource($book);
    }

    /**
     * Menambahkan buku baru ke dalam sistem.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title'     => 'required|string|max:255',
            'deskripsi' => 'required',
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Buat buku baru
        $book = Books::create($validator->validated());

        return (new BookResource($book))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Memperbarui informasi buku berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $book = Books::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku tidak ditemukan',
            ], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'title'     => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required',
            'author_id' => 'sometimes|required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Update buku
        $book->update($validator->validated());

        return new BookResource($book);
    }

    /**
     * Menghapus buku berdasarkan ID.
     */
    public function destroy($id)
    {
        $book = Books::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku tidak ditemukan',
            ], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Buku berhasil dihapus'], 204);
    }

    /**
     * Mencari buku berdasarkan judul dan/atau nama penulis.
     */
    public function search(Request $request)
    {
        // Validasi input pencarian
        $validator = Validator::make($request->all(), [
            'title'  => 'nullable|string|min:1',
            'author' => 'nullable|string|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Ambil parameter pencarian dari request
        $title  = $request->input('title');
        $author = $request->input('author');

        // Mulai query berdasarkan parameter
        $query = Books::with('author');

        if ($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }

        if ($author) {
            $query->whereHas('author', function ($q) use ($author) {
                $q->where('name', 'LIKE', '%' . $author . '%');
            });
        }

        // Jalankan query
        $books = $query->get();

        if ($books->isEmpty()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Tidak ada data yang ditemukan',
                'data'    => []
            ], 200);
        }

        return new BookCollection($books);
    }
}
