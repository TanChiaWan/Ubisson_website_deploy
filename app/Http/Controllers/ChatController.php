<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:professional,professional_id',
            'message' => 'required|string',
        ]);

        $message = new ChatMessage([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->input('receiver_id'),
            'message' => $request->input('message'),
        ]);
        DB::table('chat_messages')->insert($message);
      

        return redirect()->route('all_patients');
    }

    
}
