<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledMessage; // Pastikan model ini ada
use App\Models\ReceivedMessage; // Pastikan model ini ada

class WhatsAppController extends Controller
{
    // Menampilkan halaman dashboard
    public function dashboard()
    {
        return view('dashboard');
    }

    // Menampilkan halaman WhatsApp sender
    public function sender()
    {
        return view('wa.sender');
    }

    // Menampilkan halaman WhatsApp schedule
    public function schedule()
    {
        // Ambil data pesan terjadwal dari database
        $scheduledMessages = ScheduledMessage::orderBy('scheduled_time', 'desc')->paginate(10);

        // Kirim data ke view
        return view('wa.schedule', compact('scheduledMessages'));
    }

    // Menampilkan halaman auto-reply
    public function autoReply()
    {
        return view('wa.auto-reply');
    }

    // Menampilkan halaman kontak WhatsApp
    public function contacts()
    {
        return view('wa.contacts');
    }

    // Menampilkan halaman untuk menerima pesan WhatsApp
    public function receive()
    {
        // Ambil data pesan yang diterima dari database
        $receivedMessages = ReceivedMessage::orderBy('created_at', 'desc')->paginate(10);

        // Kirim data ke view
        return view('wa.receive', compact('receivedMessages'));
    }

    // Menangani pengiriman pesan WhatsApp
    public function sendMessage(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'phone_number' => 'required|numeric',
            'message' => 'required|string|max:500',
        ]);

        $phoneNumber = $request->input('phone_number');
        $message = $request->input('message');

        // Contoh logika pengiriman pesan WhatsApp menggunakan API eksternal
        try {
            // Gunakan library atau API WhatsApp di sini
            // Contoh fiktif:
            // WhatsAppAPI::send($phoneNumber, $message);

            // Kembalikan respons sukses
            return redirect()->back()->with('success', 'Message sent successfully!');
        } catch (\Exception $e) {
            // Tangani error
            return redirect()->back()->with('error', 'Failed to send message: ' . $e->getMessage());
        }
    }
}
