<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Apartment;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    // Index
    public function index()
    {
        $user = Auth::user();
        $user_id = $user['id'];

        $messages = Message::with('apartment')->orderBy('created_at', 'desc')->paginate(7);
        // dd($messages);
        // $unviewedMessagesCount = Message::where('read', '0')
        //     ->count();

        $user_messages = [];
        $unread_messages = [];

        foreach ($messages as $message) {
            // dd($message->apartment['user_id']);
            if ($user_id == $message->apartment['user_id']) {
                $user_messages[] = $message;

                if ($message->read == 0) {
                    $unread_messages[] = $message;
                }
            }
        }


        return view('admin.messages.index', compact('user_messages', 'unread_messages', 'messages'));
    }


    // Show
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


    // Update
    public function update(Request $request, $id)
    {

        $data = $request->All();
        $message = Message::find($id);

        if ($message['read'] === 0) {
            $data["read"] = 1;
        };

        $message->update($data);

        return redirect()->route('admin.messages.show', $id);
    }


    // Destroy
    public function destroy($id)
    {
        $message = Message::find($id);
        // Pulizia orfani
        $message->delete();
        return redirect()->route('admin.messages.index')->with('deleted', $message->title);
    }
}
