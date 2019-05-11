<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
  public function index ()
  {
    return response()->json(Book::all());
  }

  public function show ($id)
  {
    $id = intval($id);
    $book = Book::find($id);
    return response()->json($book);
  }

  public function search (Request $request)
  {
    $books = Book::where('title', 'like', '%' . $request->title . '%')->get();
    return response()->json($books);
  }

  public function update (Request $request)
  {
    $id = intval($request->id);
    $book = Book::find($id);
    if ($request->has('stock')) {
      $book->stock += $request->stock;
    }

    $book->save();
    return response()->json();
  }
}
