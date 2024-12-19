<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment
            $table->string('name'); // Kolom Nama
            $table->string('phone', 20); // Kolom Telepon, panjang maksimal 20
            $table->string('email')->unique(); // Kolom Email (unik)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
