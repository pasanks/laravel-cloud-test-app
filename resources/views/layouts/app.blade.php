<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Task Manager') }} - @yield('title', 'Dashboard')</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f3f4f6; color: #1f2937; line-height: 1.6; }
        .navbar { background: #1e40af; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .navbar a { color: white; text-decoration: none; font-weight: 600; font-size: 1.25rem; }
        .navbar .nav-links a { font-size: 0.9rem; margin-left: 1.5rem; opacity: 0.9; }
        .navbar .nav-links a:hover { opacity: 1; text-decoration: underline; }
        .container { max-width: 960px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 1.5rem; }
        .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; font-size: 0.875rem; font-weight: 500; border: none; cursor: pointer; transition: background 0.2s; }
        .btn-primary { background: #2563eb; color: white; }
        .btn-primary:hover { background: #1d4ed8; }
        .btn-success { background: #16a34a; color: white; }
        .btn-success:hover { background: #15803d; }
        .btn-danger { background: #dc2626; color: white; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-secondary { background: #6b7280; color: white; }
        .btn-secondary:hover { background: #4b5563; }
        .btn-sm { padding: 0.25rem 0.75rem; font-size: 0.8rem; }
        .alert { padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-weight: 500; margin-bottom: 0.25rem; font-size: 0.875rem; }
        .form-control { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; font-family: inherit; }
        .form-control:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
        select.form-control { appearance: auto; }
        textarea.form-control { resize: vertical; min-height: 80px; }
        .badge { display: inline-block; padding: 0.15rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-in_progress { background: #dbeafe; color: #1e40af; }
        .badge-completed { background: #dcfce7; color: #166534; }
        .badge-low { background: #e0e7ff; color: #3730a3; }
        .badge-medium { background: #fef3c7; color: #92400e; }
        .badge-high { background: #fee2e2; color: #991b1b; }
        .task-table { width: 100%; border-collapse: collapse; }
        .task-table th, .task-table td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
        .task-table th { font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 600; }
        .task-table tr:hover { background: #f9fafb; }
        .actions { display: flex; gap: 0.5rem; align-items: center; }
        .flex-between { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .filters { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
        .filters select { padding: 0.35rem 0.5rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.8rem; }
        .empty-state { text-align: center; padding: 3rem; color: #9ca3af; }
        .pagination { display: flex; justify-content: center; margin-top: 1rem; }
        .pagination nav { display: flex; gap: 0.25rem; }
        .error-list { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .error-list ul { margin-left: 1rem; }
        .footer { text-align: center; padding: 2rem; color: #9ca3af; font-size: 0.8rem; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('tasks.index') }}">Task Manager</a>
        <div class="nav-links">
            <a href="{{ route('tasks.index') }}">All Tasks</a>
            <a href="{{ route('tasks.create') }}">New Task</a>
            <a href="{{ url('/health') }}">Health Check</a>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <div class="footer">
        <p>Task Manager App &mdash; Built with Laravel {{ app()->version() }} &mdash; Deployed on Laravel Cloud</p>
    </div>
</body>
</html>
