@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Calendar</h1>
        <button id="add-task-button" class="bg-primary hover:bg-primary/90 text-white rounded-md px-4 py-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Task
        </button>
    </div>
    
    <div class="bg-card border border-border rounded-lg shadow-sm overflow-hidden">
        <div class="p-4 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <h2 class="text-xl font-semibold">{{ $currentDate->format('F Y') }}</h2>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('calendar', ['year' => $previousMonth->year, 'month' => $previousMonth->month]) }}" class="p-2 rounded-md hover:bg-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                <button id="today-button" class="px-3 py-1 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90">Today</button>
                <a href="{{ route('calendar', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}" class="p-2 rounded-md hover:bg-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-7 text-center border-b border-border">
            <div class="py-2 text-sm font-medium text-muted-foreground">Sun</div>
            <div class="py-2 text-sm font-medium text-muted-foreground">Mon</div>
            <div class="py-2 text-sm font-medium text-muted-foreground">Tue</div>
            <div class="py-2 text-sm font-medium text-muted-foreground">Wed</div>
            <div class="py-2 text-sm font-medium text-muted-foreground">Thu</div>
            <div class="py-2 text-sm font-medium text-muted-foreground">Fri</div>
            <div class="py-2 text-sm font-medium text-muted-foreground">Sat</div>
        </div>
        
        <div class="grid grid-cols-7 min-h-[600px]">
            @foreach($calendar as $day)
                <div class="border-b border-r border-border p-2 min-h-[100px] relative @if(!$day['isCurrentMonth']) bg-muted/40 @endif">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm @if($day['isToday']) bg-primary text-primary-foreground rounded-full w-6 h-6 flex items-center justify-center @endif">
                            {{ $day['date']->format('j') }}
                        </span>
                        <div class="flex space-x-1">
                            <button class="text-xs rounded-full w-5 h-5 bg-muted hover:bg-muted/80 flex items-center justify-center add-note" data-date="{{ $day['date']->format('Y-m-d') }}" title="Add note">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button class="text-xs rounded-full w-5 h-5 bg-muted hover:bg-muted/80 flex items-center justify-center create-task" data-date="{{ $day['date']->format('Y-m-d') }}" title="Add task">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    @if($day['note'])
                        <div class="text-xs px-2 py-1 mb-1 bg-blue-500/10 text-blue-500 border-l-2 border-blue-500 rounded truncate cursor-pointer note-item" data-date="{{ $day['date']->format('Y-m-d') }}" data-content="{{ $day['note']->content }}">
                            {{ \Illuminate\Support\Str::limit($day['note']->content, 30) }}
                        </div>
                    @endif
                    
                    <div class="space-y-1">
                        @foreach($day['tasks'] as $task)
                            <div class="text-xs px-1 py-0.5 rounded truncate cursor-pointer task-item 
                                @if($task->priority == 'high')
                                    bg-red-500/10 text-red-500 border-l-2 border-red-500
                                @elseif($task->priority == 'medium')
                                    bg-amber-500/10 text-amber-500 border-l-2 border-amber-500
                                @else
                                    bg-green-500/10 text-green-500 border-l-2 border-green-500
                                @endif
                            " data-task-id="{{ $task->id }}">
                                {{ $task->title }}
                            </div>
                        @endforeach
                    </div>
                    
                    @if($day['tasks']->count() > 0)
                        <div class="absolute bottom-1 right-1">
                            <span class="text-xs bg-primary text-white rounded-full px-2 py-0.5">
                                {{ $day['tasks']->count() }} {{ Str::plural('task', $day['tasks']->count()) }}
                            </span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Task Form Modal -->
<div id="task-modal" class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <div class="bg-card border border-border p-6 rounded-lg shadow-lg max-w-md w-full relative">
        <button type="button" id="close-task-modal" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h2 class="text-xl font-bold mb-6 text-foreground" id="modal-title">Create New Task</h2>
        <form id="task-form">
            <input type="hidden" id="task-id" name="task_id">
            <input type="hidden" id="task-date" name="date">
            
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium mb-1 text-foreground">Title</label>
                    <input type="text" id="title" name="title" class="w-full px-3 py-2 border border-input rounded-md bg-background text-foreground" placeholder="Task title" required>
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium mb-1 text-foreground">Description</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-3 py-2 border border-input rounded-md bg-background text-foreground" placeholder="Task description"></textarea>
                </div>
                
                <div>
                    <label for="task-date-display" class="block text-sm font-medium mb-1 text-foreground">Date</label>
                    <div class="relative">
                        <input type="text" id="task-date-display" class="w-full px-3 py-2 border border-input rounded-md bg-background text-foreground cursor-pointer" >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-muted-foreground" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="priority" class="block text-sm font-medium mb-1 text-foreground">Priority</label>
                    <div class="relative" x-data="{ open: false, selected: 'Medium' }">
                        <button type="button" @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 border border-input rounded-md bg-background text-foreground">
                            <span x-text="selected"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 w-full mt-1 bg-popover border border-border rounded-md shadow-lg">
                            <div class="py-1">
                                <button type="button" @click="selected = 'High'; open = false; document.getElementById('priority').value = 'high'" class="block w-full text-left px-4 py-2 text-sm hover:bg-muted">High</button>
                                <button type="button" @click="selected = 'Medium'; open = false; document.getElementById('priority').value = 'medium'" class="block w-full text-left px-4 py-2 text-sm hover:bg-muted bg-primary text-primary-foreground">Medium</button>
                                <button type="button" @click="selected = 'Low'; open = false; document.getElementById('priority').value = 'low'" class="block w-full text-left px-4 py-2 text-sm hover:bg-muted">Low</button>
                            </div>
                        </div>
                        <select id="priority" name="priority" class="hidden">
                            <option value="high">High</option>
                            <option value="medium" selected>Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium mb-1 text-foreground">Status</label>
                    <div class="relative" x-data="{ open: false, selected: 'Pending' }">
                        <button type="button" @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 border border-input rounded-md bg-background text-foreground">
                            <span x-text="selected"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 w-full mt-1 bg-popover border border-border rounded-md shadow-lg">
                            <div class="py-1">
                                <button type="button" @click="selected = 'Pending'; open = false; document.getElementById('status').value = 'pending'" class="block w-full text-left px-4 py-2 text-sm hover:bg-muted bg-primary text-primary-foreground">Pending</button>
                                <button type="button" @click="selected = 'In Progress'; open = false; document.getElementById('status').value = 'in-progress'" class="block w-full text-left px-4 py-2 text-sm hover:bg-muted">In Progress</button>
                                <button type="button" @click="selected = 'Completed'; open = false; document.getElementById('status').value = 'completed'" class="block w-full text-left px-4 py-2 text-sm hover:bg-muted">Completed</button>
                            </div>
                        </div>
                        <select id="status" name="status" class="hidden">
                            <option value="pending" selected>Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" id="delete-task" class="px-4 py-2 text-sm font-medium rounded-md bg-red-500 text-white hover:bg-red-600 hidden">
                    Delete
                </button>
                <button type="button" id="cancel-task" class="px-4 py-2 text-sm font-medium rounded-md bg-secondary text-secondary-foreground hover:bg-secondary/90">
                    Cancel
                </button>
                <button type="submit" id="save-task" class="px-4 py-2 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90">
                    Create Task
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Note Form Modal -->
<div id="note-modal" class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <div class="bg-card border border-border p-6 rounded-lg shadow-lg max-w-md w-full relative">
        <button type="button" id="close-note-modal" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h2 class="text-xl font-bold mb-6 text-foreground" id="note-modal-title">Add Note</h2>
        <form id="note-form">
            <input type="hidden" id="note-date" name="date">
            
            <div class="space-y-4">
                <div>
                    <label for="note-content" class="block text-sm font-medium mb-1 text-foreground">Note</label>
                    <textarea id="note-content" name="content" rows="4" class="w-full px-3 py-2 border border-input rounded-md bg-background text-foreground" placeholder="Enter your note here..."></textarea>
                </div>
            </div>
            
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" id="delete-note" class="px-4 py-2 text-sm font-medium rounded-md bg-red-500 text-white hover:bg-red-600 hidden">
                    Delete
                </button>
                <button type="button" id="cancel-note" class="px-4 py-2 text-sm font-medium rounded-md bg-secondary text-secondary-foreground hover:bg-secondary/90">
                    Cancel
                </button>
                <button type="submit" id="save-note" class="px-4 py-2 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const taskModal = document.getElementById('task-modal');
        const taskForm = document.getElementById('task-form');
        const taskDate = document.getElementById('task-date');
        const taskDateDisplay = document.getElementById('task-date-display');
        const taskId = document.getElementById('task-id');
        const taskModalTitle = document.getElementById('modal-title');
        const saveTaskButton = document.getElementById('save-task');
        const deleteTaskButton = document.getElementById('delete-task');
        const addTaskButton = document.getElementById('add-task-button');
        
        const noteModal = document.getElementById('note-modal');
        const noteForm = document.getElementById('note-form');
        const noteDate = document.getElementById('note-date');
        const noteContent = document.getElementById('note-content');
        const noteModalTitle = document.getElementById('note-modal-title');
        const deleteNoteButton = document.getElementById('delete-note');
        
        // Initialize flatpickr date picker
        const datePicker = flatpickr(taskDateDisplay, {
            dateFormat: "F j, Y",
            allowInput: false,
            onChange: function(selectedDates, dateStr, instance) {
                // Update the hidden input with the ISO format for the server
                if (selectedDates.length > 0) {
                    const dateObj = selectedDates[0];
                    const year = dateObj.getFullYear();
                    const month = String(dateObj.getMonth() + 1).padStart(2, '0');
                    const day = String(dateObj.getDate()).padStart(2, '0');
                    taskDate.value = `${year}-${month}-${day}`;
                }
            }
        });
        
        // Format date for display
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }
        
        // Today button
        document.getElementById('today-button').addEventListener('click', function() {
            const today = new Date();
            window.location.href = "{{ route('calendar') }}?year=" + today.getFullYear() + "&month=" + (today.getMonth() + 1);
        });
        
        // Add task button from header
        addTaskButton.addEventListener('click', function() {
            const today = new Date();
            const dateStr = today.toISOString().split('T')[0];
            taskDate.value = dateStr;
            taskDateDisplay.value = formatDate(dateStr);
            datePicker.setDate(today); // Update the flatpickr instance
            taskId.value = '';
            taskForm.reset();
            taskModalTitle.textContent = 'Create New Task';
            saveTaskButton.textContent = 'Create Task';
            deleteTaskButton.classList.add('hidden');
            taskModal.classList.remove('hidden');
        });
        
        // Close task modal with X button
        document.getElementById('close-task-modal').addEventListener('click', function() {
            taskModal.classList.add('hidden');
        });
        
        // Close note modal with X button
        document.getElementById('close-note-modal').addEventListener('click', function() {
            noteModal.classList.add('hidden');
        });
        
        // Open create task modal from calendar
        document.querySelectorAll('.create-task').forEach(button => {
            button.addEventListener('click', function() {
                const date = this.getAttribute('data-date');
                taskDate.value = date;
                taskDateDisplay.value = formatDate(date);
                datePicker.setDate(new Date(date)); // Update flatpickr with the selected date
                taskId.value = '';
                taskForm.reset();
                taskModalTitle.textContent = 'Create New Task';
                saveTaskButton.textContent = 'Create Task';
                deleteTaskButton.classList.add('hidden');
                taskModal.classList.remove('hidden');
            });
        });
        
        // Open edit task modal
        document.querySelectorAll('.task-item').forEach(item => {
            item.addEventListener('click', function() {
                const id = this.getAttribute('data-task-id');
                taskModalTitle.textContent = 'Edit Task';
                saveTaskButton.textContent = 'Save Changes';
                deleteTaskButton.classList.remove('hidden');
                
                // Fetch task details
                fetch(`/api/tasks/${id}`)
                    .then(response => response.json())
                    .then(task => {
                        taskId.value = task.id;
                        taskDate.value = task.date;
                        taskDateDisplay.value = formatDate(task.date);
                        datePicker.setDate(new Date(task.date)); // Update flatpickr with the task date
                        document.getElementById('title').value = task.title;
                        document.getElementById('description').value = task.description || '';
                        document.getElementById('priority').value = task.priority;
                        document.getElementById('status').value = task.status;
                        taskModal.classList.remove('hidden');
                    });
            });
        });
        
        // Close task modal
        document.getElementById('cancel-task').addEventListener('click', function() {
            taskModal.classList.add('hidden');
        });
        
        // Open create/edit note modal
        document.querySelectorAll('.add-note').forEach(button => {
            button.addEventListener('click', function() {
                const date = this.getAttribute('data-date');
                noteDate.value = date;
                
                // Check if there's already a note for this date
                fetch(`/api/notes?date=${date}`)
                    .then(response => response.json())
                    .then(note => {
                        if (note) {
                            noteContent.value = note.content;
                            noteModalTitle.textContent = 'Edit Note';
                            deleteNoteButton.classList.remove('hidden');
                        } else {
                            noteForm.reset();
                            noteDate.value = date;
                            noteModalTitle.textContent = 'Add Note';
                            deleteNoteButton.classList.add('hidden');
                        }
                        noteModal.classList.remove('hidden');
                    });
            });
        });
        
        // Open edit note modal when clicking on an existing note
        document.querySelectorAll('.note-item').forEach(item => {
            item.addEventListener('click', function() {
                const date = this.getAttribute('data-date');
                const content = this.getAttribute('data-content');
                
                noteDate.value = date;
                noteContent.value = content;
                noteModalTitle.textContent = 'Edit Note';
                deleteNoteButton.classList.remove('hidden');
                noteModal.classList.remove('hidden');
            });
        });
        
        // Close note modal
        document.getElementById('cancel-note').addEventListener('click', function() {
            noteModal.classList.add('hidden');
        });
        
        // Handle note form submission
        noteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                date: noteDate.value,
                content: noteContent.value
            };
            
            fetch('/api/notes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                }
            });
        });
        
        // Handle note deletion
        deleteNoteButton.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this note?')) {
                fetch(`/api/notes?date=${noteDate.value}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            }
        });
        
        // Handle task form submission
        taskForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                title: document.getElementById('title').value,
                description: document.getElementById('description').value,
                priority: document.getElementById('priority').value,
                status: document.getElementById('status').value,
                date: taskDate.value
            };
            
            if (taskId.value) {
                // Update existing task
                fetch(`/api/tasks/${taskId.value}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            } else {
                // Create new task
                fetch('/api/tasks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            }
        });
        
        // Handle task deletion
        deleteTaskButton.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this task?')) {
                fetch(`/api/tasks/${taskId.value}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>
@endpush