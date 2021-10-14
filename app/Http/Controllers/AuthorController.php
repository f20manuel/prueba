<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Author;
use App\Models\Book;

class AuthorController extends Controller
{
    public function index()
    {
        try {
            $authors = Author::with('books')->get();

            return response()->json([
                "code" => "codigo http ok",
                "data" => $authors
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "codito http error",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function show(Author $author)
    {
        try {
            if ($author) {
                $author->books = $author->books;
                return response()->json([
                    "code" => "codigo http ok",
                    "data" => $author
                ], 200);
            }

            return response()->json([
                "code" => "codigo http error",
                "data" => "No se encontro ningun libro"
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "codigo http error",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255'
            ]);

            $newAuthor = new Author();
            $newAuthor->name = $request->name;
            $newAuthor->save();

            if ($newAuthor) {
                return response()->json([
                    "code" => "codigo http crear",
                    "data" => "Autor con el id {$newAuthor->id} fue creado"
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                "code" => "codito http error",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function update(Author $author, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required'
            ]);

            if ($author) $author->update([
                "name" => $request->name
            ]);

            return response()->json([
                "code" => "codigo http ok",
                "data" => "Autor con el id {$author->id} fue actualizado"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "codito http error",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(Author $author)
    {
        try {
            $author->delete();

            return response()->json([
                "code" => "codigo http no content",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "codito http error",
                "data" => $e->getMessage()
            ], 400);
        }
    }
}
