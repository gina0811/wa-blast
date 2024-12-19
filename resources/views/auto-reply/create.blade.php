@extends('layouts.app')

@section('title', 'Create Auto Reply')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 text-primary"><span class="text-muted fw-light">Page/</span> Create Auto Reply</h4>

    <!-- Flash message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('wa.auto-reply.store') }}" method="POST">
                @csrf

                <!-- Keyword -->
                <div class="mb-3">
                    <label for="keyword" class="form-label">Keyword</label>
                    <input type="text" name="keyword" id="keyword" class="form-control" required>
                </div>

                <!-- Response -->
                <div class="mb-3">
                    <label for="response" class="form-label">Response</label>
                    <textarea name="response" id="response" class="form-control" rows="3" required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Create Auto Reply</button>
            </form>
        </div>
    </div>
</div>
@endsection
