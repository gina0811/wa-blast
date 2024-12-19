<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('received_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message_type'); // Tipe pesan
            $table->string('from_name')->nullable(); // Nama pengirim
            $table->string('from_number'); // Nomor pengirim
            $table->string('number'); // Nomor penerima
            $table->boolean('is_group')->default(false); // Grup atau bukan
            $table->text('message'); // Isi pesan
            $table->timestamps(); // Waktu penerimaan pesan
        });
    }

    public function down()
    {
        Schema::dropIfExists('received_messages');
    }
};
