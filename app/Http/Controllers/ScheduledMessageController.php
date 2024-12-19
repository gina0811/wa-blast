<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledMessage;
use Illuminate\Support\Facades\Storage;

class ScheduledMessageController extends Controller
{
    /**
     * Tampilkan daftar pesan terjadwal.
     */
    public function index()
    {
        $scheduledMessages = ScheduledMessage::orderBy('scheduled_time', 'desc')->paginate(10);
        return view('scheduled-messages.index', compact('scheduledMessages'));
    }

    /**
     * Simpan pesan terjadwal baru.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'schedule_type' => 'required|in:text,image,video,document',
            'number' => 'required|string|max:15',
            'message' => 'required_if:schedule_type,text|string|max:1000',
            'start_in' => 'required|date|after_or_equal:now',
            'caption' => 'nullable|string|max:255',
            'is_blast' => 'nullable|boolean',
            'file_upload' => 'nullable|file|mimes:jpeg,png,jpg,mp4,avi,pdf,doc,docx|max:20480', // Validasi file
        ]);

        // Proses file upload jika ada
        if ($request->hasFile('file_upload')) {
            $filePath = $request->file('file_upload')->store('uploads');
            $validated['file_path'] = $filePath;
        }

        // Tambahkan status default
        $validated['status'] = 'pending';
        $validated['is_blast'] = $request->has('is_blast') ? (bool)$request->is_blast : false;

        ScheduledMessage::create($validated);

        return redirect()->route('schedule-message.index')->with('success', 'Pesan terjadwal berhasil dibuat.');
    }

    /**
     * Update pesan terjadwal yang ada.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'schedule_type' => 'required|in:text,image,video,document',
            'number' => 'required|string|max:15',
            'message' => 'required_if:schedule_type,text|string|max:1000',
            'start_in' => 'required|date|after_or_equal:now',
            'caption' => 'nullable|string|max:255',
            'is_blast' => 'nullable|boolean',
            'file_upload' => 'nullable|file|mimes:jpeg,png,jpg,mp4,avi,pdf,doc,docx|max:20480',
        ]);

        $scheduledMessage = ScheduledMessage::findOrFail($id);

        // Proses file upload jika ada
        if ($request->hasFile('file_upload')) {
            // Hapus file lama jika ada
            if ($scheduledMessage->file_path) {
                Storage::delete($scheduledMessage->file_path);
            }

            $filePath = $request->file('file_upload')->store('uploads');
            $validated['file_path'] = $filePath;
        }

        $validated['is_blast'] = $request->has('is_blast') ? (bool)$request->is_blast : false;

        $scheduledMessage->update($validated);

        return redirect()->route('schedule-message.index')->with('success', 'Pesan terjadwal berhasil diperbarui.');
    }

    /**
     * Hapus pesan terjadwal.
     */
    public function destroy($id)
    {
        $scheduledMessage = ScheduledMessage::findOrFail($id);

        // Hapus file jika ada
        if ($scheduledMessage->file_path) {
            Storage::delete($scheduledMessage->file_path);
        }

        $scheduledMessage->delete();

        return redirect()->route('schedule-message.index')->with('success', 'Pesan terjadwal berhasil dihapus.');
    }
}
