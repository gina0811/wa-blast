<?php

namespace App\Http\Controllers;

use App\Models\ReceivedMessage; // Pastikan model ini ada dan sudah dibuat
use Illuminate\Http\Request;

class ReceivedMessageController extends Controller
{
    /**
     * Menampilkan daftar pesan yang diterima.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data pesan dengan pagination
        $messages = ReceivedMessage::orderBy('created_at', 'desc')->paginate(10);
        return view('received-messages', compact('messages')); // Pastikan nama file Blade adalah received-messages.blade.php
    }

    /**
     * Menghapus semua pesan.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        // Menghapus semua data dalam tabel received_messages
        ReceivedMessage::truncate();
        return redirect()->route('received-messages.index')->with('success', 'All messages deleted successfully.');
    }
}
