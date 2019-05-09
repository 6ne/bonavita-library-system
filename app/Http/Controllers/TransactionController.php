<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
  public function index ()
  {
    return response()->json(Transaction::all());
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
    
  }

  public function getToday ()
  {

  }
}
