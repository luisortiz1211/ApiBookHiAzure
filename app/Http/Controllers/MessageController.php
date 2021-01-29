<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Http\Resources\Message as MessageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Chat $chat
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Chat $chat)
    {
        $this->authorize('ViewAny', Message::class);
        return response()->json(MessageResource::collection($chat->messages), 200);
    }

    public function show(Message $message)
    {
        $this->authorize('View', $message);
        return response()->json(new MessageResource($message), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Chat $chat
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Chat $chat)
    {

        $this->authorize('create', [Message::class, $chat]);
        //$request->validate([
          //  'message'=> 'required',
        //]);
        $message = $chat->messages()->save(new Message($request->all()));
        return response()->json($message, 201);
    }

    public function update()
    {
        //
    }

    public function delete(Message $message)
    {
        /*$this->authorize('delete', $message);

        $message->delete();
        return response()->json(null, 204);*/
    }
}
