<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CalendarController extends Controller
{
    /**
     * Display the calendar view with tasks.
     */
    public function index(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);
        
        $date = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $date->daysInMonth;
        
        // Get first day of the month
        $firstDay = $date->copy()->firstOfMonth();
        $startOfCalendar = $firstDay->copy()->startOfWeek(Carbon::SUNDAY);
        
        // Get last day of the month
        $lastDay = $date->copy()->lastOfMonth();
        $endOfCalendar = $lastDay->copy()->endOfWeek(Carbon::SATURDAY);
        
        // Get all tasks for the current month
        $tasks = Task::where('user_id', Auth::id())
            ->whereDate('date', '>=', $startOfCalendar)
            ->whereDate('date', '<=', $endOfCalendar)
            ->get()
            ->groupBy(function($task) {
                return $task->date->format('Y-m-d');
            });
            
        // Get all notes for the current month
        $notes = Note::where('user_id', Auth::id())
            ->whereDate('date', '>=', $startOfCalendar)
            ->whereDate('date', '<=', $endOfCalendar)
            ->get()
            ->keyBy(function($note) {
                return $note->date->format('Y-m-d');
            });
        
        // Create an array of days for the calendar
        $calendar = [];
        $day = $startOfCalendar->copy();
        
        while ($day <= $endOfCalendar) {
            $dateStr = $day->format('Y-m-d');
            $calendar[] = [
                'date' => $day->copy(),
                'isCurrentMonth' => $day->month === $month,
                'isToday' => $day->isToday(),
                'tasks' => $tasks->get($dateStr, collect()),
                'note' => $notes->get($dateStr),
            ];
            
            $day->addDay();
        }
        
        return view('calendar', [
            'calendar' => $calendar,
            'currentDate' => $date,
            'previousMonth' => $date->copy()->subMonth(),
            'nextMonth' => $date->copy()->addMonth(),
        ]);
    }
} 