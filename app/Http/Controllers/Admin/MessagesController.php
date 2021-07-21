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
        $message = Message::find($id);
        $user_log = Auth::user();

        $user_id = $user_log['id'];



        if ($message == null) {
            return abort(404);
        } elseif ($message != null && $message->apartment['user_id'] == $user_id) {
            return view('admin.messages.show', compact('message'));
        }

        abort(404);
    }


    public function destroy($id)
    {
        //
    }
}
