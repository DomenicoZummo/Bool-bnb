<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Apartment;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_id = $user['id'];

        $messages = Message::with('apartment')->get();
        // dd($messages);
        $user_messages = [];
        foreach ($messages as $message) {
            // dd($message->apartment['user_id']);
            if ($user_id == $message->apartment['user_id']) {
                $user_messages[] = $message;
            }
        }

        return view('admin.messages.index', compact('user_messages'));
    }


    public function show($id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
