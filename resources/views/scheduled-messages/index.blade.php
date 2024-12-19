@extends('layouts.app')

@section('title', 'Scheduled Messages')

@section('content')
<div class="container">
    <h2>Daftar Pesan Terjadwal</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah Schedule -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
        Tambah Schedule
    </button>

    <!-- Tabel -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Schedule Type</th>
                <th>Number</th>
                <th>Message</th>
                <th>Start In</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($scheduledMessages as $message)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $message->schedule_type }}</td>
                    <td>{{ $message->number }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ $message->start_in }}</td>
                    <td>{{ $message->status }}</td>
                    <td>
                        <a href="{{ route('schedule-message.edit', $message->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('schedule-message.destroy', $message->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada pesan terjadwal.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $scheduledMessages->links() }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addScheduleModalLabel">Tambah Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedule-message.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="schedule_type" class="form-label">Type</label>
                        <input type="text" name="schedule_type" class="form-control" id="schedule_type" placeholder="Type message" required>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Number</label>
                        <input type="text" name="number" class="form-control" id="number" placeholder="Nomor tujuan" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_in" class="form-label">Start In</label>
                        <input type="datetime-local" name="start_in" class="form-control" id="start_in" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" class="form-control" id="message" rows="3" placeholder="Isi pesan" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
