@extends('layouts.app')

@section('header_title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Tasks Card -->
        <div class="bg-card border border-border rounded-lg shadow-soft overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-muted-foreground text-sm font-medium">Total Tasks</h2>
                        <div class="text-3xl font-bold mt-1">{{ $totalTasks }}</div>
                    </div>
                    <div class="p-2 bg-primary/10 rounded-full transition-transform duration-300 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="h-2 bg-muted rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full transition-all duration-300 w-0" id="completion-progress-bar"></div>
                    </div>
                    <div class="flex justify-between items-center text-xs text-muted-foreground mt-2">
                        <span>{{ $completionPercentage }}% complete</span>
                        <span>{{ $completedTasks }} of {{ $totalTasks }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Task Status Card -->
        <div class="bg-card border border-border rounded-lg shadow-soft overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-muted-foreground text-sm font-medium">Task Status</h2>
                    <div class="p-2 bg-blue-primary/10 rounded-full transition-transform duration-300 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full bg-cyan-success mr-2 group-hover:scale-125 transition-transform duration-300"></div>
                            <span class="text-sm">Completed</span>
                        </div>
                        <span class="font-medium">{{ $completedTasks }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full bg-blue-primary mr-2 group-hover:scale-125 transition-transform duration-300"></div>
                            <span class="text-sm">In Progress</span>
                        </div>
                        <span class="font-medium">{{ $inProgressTasks }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full bg-amber-warning mr-2 group-hover:scale-125 transition-transform duration-300"></div>
                            <span class="text-sm">Pending</span>
                        </div>
                        <span class="font-medium">{{ $pendingTasks }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- High Priority Card -->
        <div class="bg-card border border-border rounded-lg shadow-soft overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-muted-foreground text-sm font-medium">High Priority</h2>
                        <div class="text-3xl font-bold mt-1">{{ $highPriorityTasks->count() }}</div>
                    </div>
                    <div class="p-2 bg-red-danger/10 rounded-full transition-transform duration-300 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2 text-sm text-muted-foreground">
                    @if($highPriorityTasks->count() > 0)
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-red-danger mr-2 animate-pulse"></div>
                            <span>{{ $highPriorityTasks->count() }} tasks need attention</span>
                        </div>
                    @else
                        <span>No high priority tasks</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Add Task Button -->
    <div class="flex justify-end">
        <a href="{{ route('calendar') }}?add=task" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md shadow-sm hover:bg-primary/90 transition-all duration-300 group hover:shadow-md transform hover:-translate-y-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-110 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Task
        </a>
    </div>
    
    <!-- Upcoming Tasks Section -->
    <div>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold tracking-tight">Upcoming Tasks</h2>
            <div class="text-sm text-muted-foreground px-3 py-1 bg-muted/40 rounded-full">Next 7 days</div>
        </div>
        
        @if($upcomingTasks->isEmpty())
            <div class="bg-card border border-border rounded-lg shadow-soft p-8 text-center">
                <div class="inline-flex items-center justify-center p-4 bg-muted rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-muted-foreground">No upcoming tasks for the next 7 days.</p>
                <p class="text-sm text-muted-foreground mt-1">Enjoy your free time or add a new task.</p>
            </div>
        @else
            <div class="bg-card border border-border rounded-lg shadow-soft overflow-hidden">
                <div class="divide-y divide-border">
                    @foreach($upcomingTasks as $task)
                        <div class="p-4 hover:bg-muted/30 transition-all duration-300 hover:translate-x-1">
                            <div class="flex items-center justify-between">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 mt-1">
                                        @if($task->status == 'completed')
                                            <div class="w-5 h-5 rounded-full bg-success-bg flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-success-color" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @elseif($task->status == 'in-progress')
                                            <div class="w-5 h-5 rounded-full bg-blue-primary/10 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-blue-primary" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-5 h-5 rounded-full bg-amber-warning/10 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-amber-warning" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-medium">{{ $task->title }}</h3>
                                        @if($task->description)
                                            <p class="text-sm text-muted-foreground line-clamp-1">{{ $task->description }}</p>
                                        @endif
                                        <p class="text-xs text-muted-foreground mt-1">
                                            {{ $task->date->format('M j, Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <span class="
                                        inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-all duration-200 hover:shadow-sm
                                        @if($task->priority == 'high') bg-danger-bg text-danger-color
                                        @elseif($task->priority == 'medium') bg-warning-bg text-warning-color
                                        @else bg-success-bg text-success-color @endif
                                    ">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Animate progress bars on load
    document.addEventListener('DOMContentLoaded', function() {
        // Animate completion progress bar
        const progressBar = document.getElementById('completion-progress-bar');
        if (progressBar) {
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.width = '{{ $completionPercentage }}%';
            }, 300);
        }
        
        // Add scroll reveal animations to cards
        const cards = document.querySelectorAll('.bg-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * (index + 1));
        });
    });
</script>
@endpush 