<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi (fillable)
    protected $fillable = ['name', 'phone', 'email'];

    // Jika tabel menggunakan nama lain selain "contacts"
    protected $table = 'contacts';

    // Tidak perlu menonaktifkan $timestamps jika tabel memiliki kolom created_at dan updated_at
    public $timestamps = true; // Default true, bisa dihapus jika timestamps digunakan
}
