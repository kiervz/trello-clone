<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index($id)
    {
        // Get the specific task of the logged in user
        $task = User::findOrFail(Auth::user()->id)->tasks->where('id', $id)->first();
        // Then return all of its cards
        return response()->json([
            'cards' => CardResource::collection($task->cards)
        ]);
    }

    public function show($card_id, $task_id)
    {
        $card = Card::where('id', $card_id)
                    ->where('task_id', $task_id)
                    ->first();

        return response()->json([
            'card' => new CardResource($card)
        ]);
    }

    public function store(CardRequest $request, $task_id)
    {
        $request->task_id = $task_id;
        Card::create($request->all());

        return response()->json([
            'message' => 'Card Successfully Saved.'
        ]);
    }

    public function update(CardRequest $request, $card_id, $task_id)
    {
        $card = Card::where('id', $card_id)
                    ->where('task_id', $task_id)
                    ->first();

        $card->update($request->all());

        return response()->json([
            'message' => 'Card Successfully Updated.'
        ]);
    }

    public function destroy($card_id, $task_id)
    {
        $card = Card::where('id', $card_id)
                    ->where('task_id', $task_id)
                    ->first();

        $card->delete();

        return response()->json([
            'message' => 'Card Successfully Deleted.'
        ]);
    }

    public function updateIsComplete(Request $request, $id, $task_id)
    {
        $card = Card::where('id', $id)
                    ->where('task_id', $task_id)
                    ->first();

        $card->update($request->all());

        return response()->json([
            'message' => 'Card Successfully Updated.'
        ]);
    }

}
