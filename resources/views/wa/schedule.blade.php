@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 text-primary"><span class="text-muted fw-light">Page/</span> Schedule Messages</h4>

    <!-- Tambah Schedule Button & Filter -->
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Tambah Schedule</button>
            <form id="filter-form" action="{{ route('schedule-message.index') }}" method="GET" class="d-flex align-items-center">
                <label for="filter_status" class="form-label me-2 mb-0 text-secondary">Filter:</label>
                <select name="filter_status" id="filter_status" class="form-control form-control-sm">
                    <option value="">-- All Status --</option>
                    <option value="pending" {{ request('filter_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="sent" {{ request('filter_status') === 'sent' ? 'selected' : '' }}>Sent</option>
                    <option value="failed" {{ request('filter_status') === 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Schedule List -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered border-2 table-hover">
                <thead class="table-light text-center text-dark">
                    <tr>
                        <th>No</th>
                        <th>Schedule Type</th>
                        <th>Number</th>
                        <th>Message</th>
                        <th>Start In</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($scheduledMessages as $message)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center text-uppercase">{{ $message->schedule_type }}</td>
                            <td class="text-center">{{ $message->number }}</td>
                            <td class="text-center">{{ $message->message ?? 'N/A' }}</td>
                            <td class="text-center">{{ $message->start_in->format('Y-m-d H:i:s') }}</td>
                            <td class="text-center">
                                @if ($message->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($message->status === 'sent')
                                    <span class="badge bg-success">Sent</span>
                                @else
                                    <span class="badge bg-danger">Failed</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-danger fw-bold">No scheduled messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Adding Schedule -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('schedule-message.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="addScheduleModalLabel">Tambah Schedule Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Type -->
                    <div class="mb-3">
                        <label for="schedule_type" class="form-label">Type Message</label>
                        <select name="schedule_type" id="schedule_type" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            <option value="text">Text</option>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                            <option value="document">Document</option>
                        </select>
                    </div>

                    <!-- File Upload -->
                    <div class="mb-3" id="file-upload-group" style="display: none;">
                        <label for="file_upload" class="form-label">Upload File</label>
                        <input type="file" name="file_upload" id="file_upload" class="form-control" accept="">
                    </div>

                    <!-- Number -->
                    <div class="mb-3">
                        <label for="number" class="form-label">Number</label>
                        <input type="text" name="number" id="number" class="form-control" placeholder="Enter recipient number" required>
                    </div>

                    <!-- Start In -->
                    <div class="mb-3">
                        <label for="start_in" class="form-label">Start In</label>
                        <input type="datetime-local" name="start_in" id="start_in" class="form-control" required>
                    </div>

                    <!-- Message -->
                    <div class="mb-3" id="message-group">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="3" placeholder="Enter your message" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Handle filter change event
    document.getElementById('filter_status').addEventListener('change', function () {
        const filterForm = document.getElementById('filter-form');
        filterForm.submit(); // Submit the form automatically when filter is changed
    });

    // Handle schedule type change
    document.getElementById('schedule_type').addEventListener('change', function () {
        const fileGroup = document.getElementById('file-upload-group');
        const messageGroup = document.getElementById('message-group');
        const fileInput = document.getElementById('file_upload');

        if (this.value === 'image') {
            fileGroup.style.display = 'block';
            messageGroup.style.display = 'none';
            fileInput.setAttribute('accept', 'image/*');
        } else if (this.value === 'video') {
            fileGroup.style.display = 'block';
            messageGroup.style.display = 'none';
            fileInput.setAttribute('accept', 'video/*');
        } else if (this.value === 'document') {
            fileGroup.style.display = 'block';
            messageGroup.style.display = 'none';
            fileInput.setAttribute('accept', '.pdf,.doc,.docx,.txt');
        } else {
            fileGroup.style.display = 'none';
            messageGroup.style.display = 'block';
            fileInput.removeAttribute('accept');
        }
        // Initialize flatpickr for datetime input with 24-hour format
        flatpickr("#start_in", {
            enableTime: true,
            noCalendar: false,
            dateFormat: "Y-m-d H:i",
            time_24hr: truess
    });
</script>
@endsection
