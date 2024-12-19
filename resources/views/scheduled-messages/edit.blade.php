@extends('layouts.app')

@section('title', 'Edit Schedule')

@section('content')
<div class="container">
    <h2>Edit Pesan Terjadwal</h2>
    <form action="{{ route('schedule-message.update', $scheduledMessage->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Schedule Type</label>
            <input type="text" name="schedule_type" class="form-control" value="{{ $scheduledMessage->schedule_type }}" required>
        </div>
        <div class="mb-3">
            <label>Number</label>
            <input type="text" name="number" class="form-control" value="{{ $scheduledMessage->number }}" required>
        </div>
        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control" rows="3" required>{{ $scheduledMessage->message }}</textarea>
        </div>
        <div class="mb-3">
            <label>Start In</label>
            <input type="datetime-local" name="start_in" class="form-control" value="{{ \Carbon\Carbon::parse($scheduledMessage->start_in)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-3">
            <label>Caption</label>
            <input type="text" name="caption" class="form-control" value="{{ $scheduledMessage->caption }}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_blast" value="1" class="form-check-input" {{ $scheduledMessage->is_blast ? 'checked' : '' }}>
            <label class="form-check-label">Is Blast?</label>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
