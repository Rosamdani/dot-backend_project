<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return new AuthorCollection($authors);
    }

    /**
     * Menampilkan detail penulis berdasarkan ID.
     */
    public function show($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'status' => 'error',
                'message' => 'Penulis tidak ditemukan',
            ], 404);
        }

        return new AuthorResource($author);
    }

    /**
     * Menambahkan penulis baru ke dalam sistem.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Buat penulis baru
        $author = Author::create($validator->validated());

        return (new AuthorResource($author))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Memperbarui informasi penulis berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'status' => 'error',
                'message' => 'Penulis tidak ditemukan',
            ], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Update penulis
        $author->update($validator->validated());

        return new AuthorResource($author);
    }

    /**
     * Menghapus penulis berdasarkan ID.
     */
    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'status' => 'error',
                'message' => 'Penulis tidak ditemukan',
            ], 404);
        }

        $author->delete();

        return response()->json(null, 204);
    }
}
