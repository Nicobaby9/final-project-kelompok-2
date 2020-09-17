<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Chat\ChatStoredEvent;
use App\Models\{Chat, User};

class ChatsController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}
    public function allChats() {
    	$chats = Chat::with('user')->orderBy('created_at', 'desc')->take(10)->get();

    	return $chats;
    }

    public function store(Request $request) {
    	$chat = Chat::create([
    		'subject' => $request->subject,
    		'user_id' => auth()->user()->id,
    	]);

    	broadcast(new ChatStoredEvent($chat))->toOthers();

    	return $chat;
    }
}
