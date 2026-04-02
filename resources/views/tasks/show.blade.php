@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="card">
    <div class="flex-between" style="margin-bottom: 1rem;">
        <h2>{{ $task->title }}</h2>
        <div class="actions">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary btn-sm">Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
        <div>
            <strong style="font-size: 0.75rem; text-transform: uppercase; color: #6b7280;">Status</strong>
            <div style="margin-top: 0.25rem;"><span class="badge badge-{{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span></div>
        </div>
        <div>
            <strong style="font-size: 0.75rem; text-transform: uppercase; color: #6b7280;">Priority</strong>
            <div style="margin-top: 0.25rem;"><span class="badge badge-{{ $task->priority }}">{{ ucfirst($task->priority) }}</span></div>
        </div>
        <div>
            <strong style="font-size: 0.75rem; text-transform: uppercase; color: #6b7280;">Due Date</strong>
            <div style="margin-top: 0.25rem;">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'Not set' }}</div>
        </div>
    </div>

    @if($task->description)
        <div style="margin-bottom: 1rem;">
            <strong style="font-size: 0.75rem; text-transform: uppercase; color: #6b7280;">Description</strong>
            <p style="margin-top: 0.25rem; white-space: pre-wrap;">{{ $task->description }}</p>
        </div>
    @endif

    <div style="font-size: 0.8rem; color: #9ca3af; border-top: 1px solid #e5e7eb; padding-top: 0.75rem;">
        Created {{ $task->created_at->diffForHumans() }} &mdash; Updated {{ $task->updated_at->diffForHumans() }}
    </div>
</div>

<a href="{{ route('tasks.index') }}" class="btn btn-secondary">&larr; Back to Tasks</a>
@endsection
