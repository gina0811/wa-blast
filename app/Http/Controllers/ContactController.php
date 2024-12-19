<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Menampilkan daftar kontak
    public function index()
    {
        // Mengambil semua kontak dari database
        $contacts = Contact::all();

        // Mengirimkan variabel $contacts ke tampilan
        return view('contacts.index', compact('contacts'));
    }

    // Menyimpan kontak baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|max:20',
            'email' => 'required|email|unique:contacts,email',
        ]);

        // Menyimpan kontak baru
        Contact::create($request->all());

        // Kembali ke halaman daftar kontak dengan pesan sukses
        return redirect()->route('contacts.index')->with('success', 'Contact added successfully.');
    }

    // Form edit kontak
    public function edit(Contact $contact)
    {
        // Mengirimkan data kontak ke tampilan edit
        return view('contacts.edit', compact('contact'));
    }

    // Memperbarui kontak
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|max:20',
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
        ]);

        // Memperbarui data kontak
        $contact->update($request->all());

        // Kembali ke halaman daftar kontak dengan pesan sukses
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    // Menghapus kontak
    public function destroy(Contact $contact)
    {
        // Menghapus kontak yang dipilih
        $contact->delete();

        // Kembali ke halaman daftar kontak dengan pesan sukses
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    // Menghapus semua kontak
    public function deleteAll()
    {
        // Menghapus semua data kontak
        Contact::truncate();

        // Kembali ke halaman daftar kontak dengan pesan sukses
        return redirect()->route('contacts.index')->with('success', 'All contacts deleted successfully.');
    }
}
