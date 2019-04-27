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
}
