<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledMessagesTable extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel `scheduled_messages`.
     */
    public function up()
    {
        Schema::create('scheduled_messages', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('schedule_type', 50); // Tipe pesan: text, image, video, document
            $table->boolean('is_blast')->default(false); // Apakah pesan dikirim sebagai blast
            $table->string('caption', 255)->nullable(); // Caption tambahan (opsional)
            $table->string('number', 15); // Nomor tujuan
            $table->text('message')->nullable(); // Pesan utama (nullable untuk file-based)
            $table->timestamp('start_in')->nullable(); // Waktu mulai pengiriman
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending'); // Status pengiriman
            $table->string('file_path')->nullable(); // Lokasi file yang diunggah (opsional)
            $table->string('file_type', 20)->nullable(); // Jenis file: image, video, document
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });
    }

    /**
     * Mengembalikan migrasi dengan menghapus tabel `scheduled_messages`.
     */
    public function down()
    {
        Schema::dropIfExists('scheduled_messages');
    }
}
