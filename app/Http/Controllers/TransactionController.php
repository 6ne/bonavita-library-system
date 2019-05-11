<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

use DB;

class TransactionController extends Controller
{
  public function index ()
  {
    return response()->json(Transaction::orderBy('created_at', 'desc')
      ->get());
  }

  public function show ($id)
  {
    $id = intval($id);
    $transaction = Transaction::find($id);
    return response()->json($transaction);
  }

  public function store (Request $request)
  {
    $transaction = new Transaction;
    try {
      $transaction->user_id = intval($request->user_id);
      $transaction->book_id = intval($request->book_id);
      $transaction->lend_by = esc($request->lend_by);
      $transaction->returned_at = esc($request->returned_at);
      $transaction->save();
    } catch (Exception $e) {
      return response()->json([], 400);
    }
    
    return response()->json([]);
  }

  public function getUser ($id)
  {
    $id = intval($id);
    $transactions = Transaction::whereUser_id($id)
      ->whereIs_active(1)
      ->orderBy('borrowed_at', 'asc')
      ->get();
    return response()->json($transactions);
  }

  public function getDeadline ()
  {
    $transactions =
      DB::select("SELECT U.id AS user_id,
          U.nis AS nis,
          B.id AS book_id,
          B.title AS title,
          T.id AS transaction_id,
          returned_at AS returned_at
        FROM `transactions` T
        JOIN `users` U ON U.id = T.user_id
        JOIN `books` B ON B.id = T.book_id
        WHERE DATE(returned_at) < CURDATE()
        AND is_active = 1"
    );
    return response()->json($transactions);
  }

  public function getToday ()
  {
    $transactions =
      DB::select("SELECT U.id AS user_id,
          U.nis AS nis,
          B.id AS book_id,
          B.title AS title,
          T.id AS transaction_id,
          returned_at AS returned_at
        FROM `transactions` T
        JOIN `users` U ON U.id = T.user_id
        JOIN `books` B ON B.id = T.book_id
        WHERE DATE(returned_at) = CURDATE()
        AND is_active = 1"
    );
    return response()->json($transactions);
  }

  public function update (Request $request)
  {
    $id = intval($request->id);
    $transaction = Transaction::find($id);

    $transaction->is_active = $request->is_active;
    $transaction->returned_at = $request->returned_at;
    $transaction->returned_to = $request->returned_to;
    $transaction->penalty = $request->penalty;
    $transaction->save();

    return response()->json([]);
  }
}
