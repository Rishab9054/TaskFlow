<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->orderBy('date', 'asc')->get();
        return response()->json($tasks);
    }

    /**
     * Get tasks by date.
     */
    public function getByDate(Request $request)
    {
        $date = $request->date;
        $tasks = Task::where('user_id', Auth::id())
            ->whereDate('date', $date)
            ->get();
        
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'priority' => 'required|in:high,medium,low',
            'status' => 'required|in:pending,in-progress,completed',
        ]);

        $task = Task::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Check if the authenticated user owns this task
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Check if the authenticated user owns this task
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'sometimes|required|date',
            'priority' => 'sometimes|required|in:high,medium,low',
            'status' => 'sometimes|required|in:pending,in-progress,completed',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Check if the authenticated user owns this task
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json(null, 204);
    }
} 