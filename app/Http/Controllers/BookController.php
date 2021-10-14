<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        try {
            $books = Book::with('author')->get();

            return response()->json([
                "code" => "codigo http ok",
                "data" => $books
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "codigo http error",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function show(Book $book)
    {
        try {
            if ($book) {
                $book->author = $book->author;
                return response()->json([
                    "code" => "codigo http ok",
                    "data" => $book
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

    public function store(Request $request) {
        try {
            $request->validate([
                "name" => "required",
                "author_id" => "required"
            ]);

            $newBook = new Book();
            $newBook->name = $request->name;
            $newBook->author_id = $request->author_id;
            $newBook->save();

            return response()->json([
                "code" => "codigo http crear",
                "data" => "Libro el id {$newBook->id} fue creado"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "codigo http error",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function update(Book $book, Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "author_id" => "required"
            ]);

            $book->update([
                "name" => $request->name,
                "author_id" => $request->author_id
            ]);

            return response()->json([
                "code" => "codigo http ok",
                "data" => "Libro con el id {$book->id} fue actualizado"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "codigo http error",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(Book $book)
    {
        try {
            $book->delete();

            return response()->json([
                "code" => "codigo http no content",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "codigo http error",
                "data" => $e->getMessage()
            ], 400);
        }
    }
}