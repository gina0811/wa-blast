<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoReply;

class AutoReplyController extends Controller
{
    public function index()
    {
        $autoReply = AutoReply::all();
        return view('auto-reply.index', compact('autoReply'));
    }

    public function create()
    {
        return view('auto-reply.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|unique:auto_reply',
            'response' => 'required|string',
        ]);

        AutoReply::create($request->all());

        return redirect()->route('wa.auto-reply.index')->with('success', 'Auto Reply berhasil ditambahkan.');
    }

    public function edit(AutoReply $autoReply)
    {
        return view('auto-reply.edit', compact('autoReply'));
    }

    public function update(Request $request, AutoReply $autoReply)
    {
        $request->validate([
            'keyword' => 'required|string|unique:auto_reply,keyword,' . $autoReply->id,
            'response' => 'required|string',
        ]);

        $autoReply->update($request->all());

        return redirect()->route('wa.auto-reply.index')->with('success', 'Auto Reply berhasil diperbarui.');
    }

    public function destroy(AutoReply $autoReply)
    {
        $autoReply->delete();

        return redirect()->route('wa.auto-reply.index')->with('success', 'Auto Reply berhasil dihapus.');
    }
}
