@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Receive Message List</h2>
        <form action="{{ route('received-messages.deleteAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all messages? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete All</button>
        </form>
    </div>

    @forelse ($messages as $message)
        @if ($loop->first)
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Message Type</th>
                        <th>From Name</th>
                        <th>From Number</th>
                        <th>Number</th>
                        <th>Is Group</th>
                        <th>Message</th>
                        <th>Received At</th>
                    </tr>
                </thead>
                <tbody>
        @endif
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $message->message_type }}</td>
                        <td>{{ $message->from_name ?? '-' }}</td>
                        <td>{{ $message->from_number }}</td>
                        <td>{{ $message->number }}</td>
                        <td>{{ $message->is_group ? 'Yes' : 'No' }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->created_at->format('d M Y, H:i') }}</td>
                    </tr>
        @if ($loop->last)
                </tbody>
            </table>
        @endif
    @empty
        <div class="alert alert-info text-center">
            No messages found.
        </div>
    @endforelse

    <div class="mt-3">
        {{ $messages->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
