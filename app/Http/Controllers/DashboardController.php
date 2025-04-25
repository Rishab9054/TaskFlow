<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with task statistics.
     */
    public function index()
    {
        $userId = Auth::id();
        
        // Get all tasks for the authenticated user
        $tasks = Task::where('user_id', $userId)->get();
        
        // Calculate statistics
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status', 'completed')->count();
        $pendingTasks = $tasks->where('status', 'pending')->count();
        $inProgressTasks = $tasks->where('status', 'in-progress')->count();
        
        $completionPercentage = $totalTasks > 0 
            ? round(($completedTasks / $totalTasks) * 100) 
            : 0;
        
        // Get upcoming tasks (next 7 days)
        $today = Carbon::today();
        $nextWeek = Carbon::today()->addDays(7);
        
        $upcomingTasks = Task::where('user_id', $userId)
            ->whereDate('date', '>=', $today)
            ->whereDate('date', '<=', $nextWeek)
            ->where('status', '!=', 'completed')
            ->orderBy('date')
            ->get();
        
        // Get high priority tasks
        $highPriorityTasks = Task::where('user_id', $userId)
            ->where('priority', 'high')
            ->where('status', '!=', 'completed')
            ->get();
        
        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'inProgressTasks',
            'completionPercentage',
            'upcomingTasks',
            'highPriorityTasks'
        ));
    }
} 