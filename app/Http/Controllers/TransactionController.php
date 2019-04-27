<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
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
}
