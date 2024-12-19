<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    WhatsAppController,
    SettingsController,
    ProfileController,
    ScheduledMessageController,
    AutoReplyController,
    ContactController,
    ReceivedMessageController
};

// Dashboard Route
Route::get('/', [WhatsAppController::class, 'dashboard'])->name('dashboard');

// Contacts (Resource Route)
Route::resource('contacts', ContactController::class);
Route::post('contacts/deleteAll', [ContactController::class, 'deleteAll'])->name('contacts.deleteAll');


// Custom route for deleting all contacts
Route::delete('contacts/delete-all', [ContactController::class, 'deleteAll'])->name('contacts.deleteAll');

// Auto Reply Routes
Route::prefix('auto-reply')->name('wa.auto-reply.')->group(function () {
    Route::get('/', [AutoReplyController::class, 'index'])->name('index');
    Route::post('/', [AutoReplyController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AutoReplyController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AutoReplyController::class, 'update'])->name('update');
    Route::delete('/{id}', [AutoReplyController::class, 'destroy'])->name('destroy');
});

// WhatsApp Routes
Route::prefix('wa')->name('wa.')->group(function () {
    Route::get('/sender', [WhatsAppController::class, 'sender'])->name('sender');
    Route::post('/send-message', [WhatsAppController::class, 'sendMessage'])->name('send.message');
    Route::get('/schedule', [WhatsAppController::class, 'schedule'])->name('schedule');
    Route::get('/auto-reply', [WhatsAppController::class, 'autoReply'])->name('auto-reply');
    Route::get('/contacts', [WhatsAppController::class, 'contacts'])->name('contacts');
    Route::get('/receive', [WhatsAppController::class, 'receive'])->name('receive');
});

// Schedule Message Routes
Route::prefix('schedule-message')->name('schedule-message.')->group(function () {
    Route::get('/', [ScheduledMessageController::class, 'index'])->name('index');
    Route::get('/create', [ScheduledMessageController::class, 'create'])->name('create');
    Route::post('/', [ScheduledMessageController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ScheduledMessageController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ScheduledMessageController::class, 'update'])->name('update');
    Route::delete('/{id}', [ScheduledMessageController::class, 'destroy'])->name('destroy');
});

// Receive Messages Routes
Route::prefix('receive-messages')->name('received-messages.')->group(function () {
    Route::get('/', [ReceivedMessageController::class, 'index'])->name('index');
    Route::delete('/delete-all', [ReceivedMessageController::class, 'deleteAll'])->name('deleteAll');
});

// Settings Routes
Route::prefix('settings')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('settings');
    Route::post('/', [SettingsController::class, 'store'])->name('post.settings');
});

// Profile Route
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// WhatsApp Sender: Tambahan untuk mendukung schedule_type dropdown
Route::prefix('wa/sender')->name('wa.sender.')->group(function () {
    Route::get('/types', [WhatsAppController::class, 'getMessageTypes'])->name('types'); // API atau view untuk menampilkan tipe
});
