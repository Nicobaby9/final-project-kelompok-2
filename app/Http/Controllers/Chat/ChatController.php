<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Events\ChatStoredEvent;
use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
	public function __construct()
	{
		return $this->middleware('auth');
	}

	public function allChats()
	{
		$chats = Chat::with('user')->orderBy('created_at', 'desc')->take(4)->get();

		return $chats;
	}

	public function store(Request $request)
	{
		$chat = Chat::create([
			'subject' => $request->subject,
			'user_id' => auth()->user()->id,
		]);

		broadcast(new ChatStoredEvent($chat))->toOthers();

		return $chat;
	}
}
