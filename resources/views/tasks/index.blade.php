@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
<div class="card">
    <div class="flex-between" style="margin-bottom: 1rem;">
        <h2>Tasks</h2>
        <div style="display: flex; gap: 0.5rem; align-items: center;">
            <form method="GET" action="{{ route('tasks.index') }}" class="filters">
                <select name="status" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <select name="priority" onchange="this.form.submit()">
                    <option value="">All Priorities</option>
                    <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                </select>
            </form>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ New Task</a>
        </div>
    </div>

    @if($tasks->count())
        <table class="task-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td><a href="{{ route('tasks.show', $task) }}" style="color: #2563eb; text-decoration: none; font-weight: 500;">{{ $task->title }}</a></td>
                    <td><span class="badge badge-{{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span></td>
                    <td><span class="badge badge-{{ $task->priority }}">{{ ucfirst($task->priority) }}</span></td>
                    <td>{{ $task->due_date ? $task->due_date->format('M d, Y') : '—' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($tasks->hasPages())
        <div class="pagination" style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 1rem;">
            @if($tasks->onFirstPage())
                <span class="btn btn-secondary btn-sm" style="opacity: 0.5;">&laquo; Previous</span>
            @else
                <a href="{{ $tasks->withQueryString()->previousPageUrl() }}" class="btn btn-secondary btn-sm">&laquo; Previous</a>
            @endif

            @if($tasks->hasMorePages())
                <a href="{{ $tasks->withQueryString()->nextPageUrl() }}" class="btn btn-secondary btn-sm">Next &raquo;</a>
            @else
                <span class="btn btn-secondary btn-sm" style="opacity: 0.5;">Next &raquo;</span>
            @endif
        </div>
        @endif
    @else
        <div class="empty-state">
            <p style="font-size: 2rem; margin-bottom: 0.5rem;">&#9776;</p>
            <p>No tasks found.</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary" style="margin-top: 1rem;">Create Your First Task</a>
        </div>
    @endif
</div>
@endsection
