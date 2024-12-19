@extends('layouts.app')

@section('title', 'Edit Auto Reply')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 text-primary"><span class="text-muted fw-light">Page/</span> Edit Auto Reply</h4>

    <!-- Flash message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('wa.auto-reply.update', $autoReply->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Keyword -->
                <div class="mb-3">
                    <label for="keyword" class="form-label">Keyword</label>
                    <input type="text" name="keyword" id="keyword" class="form-control" value="{{ $autoReply->keyword }}" required>
                </div>

                <!-- Response -->
                <div class="mb-3">
                    <label for="response" class="form-label">Response</label>
                    <textarea name="response" id="response" class="form-control" rows="3" required>{{ $autoReply->response }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning">Update Auto Reply</button>
            </form>
        </div>
    </div>
</div>
@endsection
