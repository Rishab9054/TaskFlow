<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Get a note for a specific date.
     */
    public function getByDate(Request $request)
    {
        $date = $request->date;
        
        $note = Note::where('user_id', Auth::id())
            ->whereDate('date', $date)
            ->first();
        
        return response()->json($note);
    }

    /**
     * Store a new note or update if exists.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'content' => 'required|string',
        ]);

        $note = Note::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'date' => $validated['date'],
            ],
            [
                'content' => $validated['content'],
            ]
        );

        return response()->json($note, 201);
    }

    /**
     * Delete a note for a specific date.
     */
    public function destroy(Request $request)
    {
        $date = $request->date;
        
        $note = Note::where('user_id', Auth::id())
            ->whereDate('date', $date)
            ->first();
            
        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }
        
        $note->delete();
        
        return response()->json(null, 204);
    }
} 