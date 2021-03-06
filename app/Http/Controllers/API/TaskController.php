<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return TaskResource::collection(Auth::user()->tasks);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json([
            'data' => new TaskResource($task)
        ]);
    }

    public function store(TaskRequest $request)
    {
        $request['user_id'] = Auth::user()->id;
        Task::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Task Successfully Added.'
        ]);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Task Successfully Updated.'
        ]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Task Successfully Deleted.'
        ]);
    }

}
