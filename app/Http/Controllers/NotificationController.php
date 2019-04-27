<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function show ($user_id)
  {
    $user_id = intval($user_id);
    return response()->json(
      Notification::whereTo($user_id)
        ->orderBy('created_at', 'desc')
        ->get());
  }

  public function new ($user_id)
  {
    $user_id = intval($user_id);
    return response()->json(
      Notification::whereTo($user_id)
      ->whereIs_new(true)
      ->orderBy('created_at', 'asc')
      ->get());
  }

  public function read ($user_id)
  {
    $user_id = intval($user_id);
    Notification::whereTo($user_id)
      ->whereIs_new(true)->update(['is_new' => false]);
    return response()->json([]);
  }

  public function store (Request $request)
  {
    $notification = new Notification;
    try {
      $notification->book_id = intval($request->book_id);
      $notification->from = intval($request->from);
      $notification->to = intval($request->to);
      $notification->status = esc($request->status);
      $notification->reason = esc($request->reason) != null?
        esc($request->reason):
        'No Reason';
      $notification->save();
    } catch (Exception $e) {
      return response()->json([], 400);
    }

    return response()->json([]);
  }

  public function update ($id, Request $request)
  {
    $id = intval($id);
    $notification = Notification::find($id);

    try {
      $notification->status = esc($request->status);
      $notification->reason = esc($request->reason) != null?
        esc($request->reason):
        'No Reason';

      $notification->save();
    } catch (Exception $e) {
      return response()->json([], 400);
    }

    return response()->json([]);
  }
}
