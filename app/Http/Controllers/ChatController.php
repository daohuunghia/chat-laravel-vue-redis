<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessagePostedEvent;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chats()
    {
        return view('layouts.chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        if ($request->message) {
            $user = Auth::user();
            $message = new Message();
            $message->user_id = $user->id;
            $message->message = $request->message;
            $message->save();
            broadcast(new MessagePostedEvent($message, $user))->toOthers();
            return [
                'status' => true,
                'message' => $message->load('user')
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Message required'
            ];
        }

    }

    public function getUserLogin()
    {
        return Auth::user();
    }
}
