<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoReply extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan yang ada di database
    protected $table = 'auto_replies';  // Menambahkan nama tabel yang benar
    
    // Menambahkan kolom yang boleh diisi
    protected $fillable = ['keyword', 'response'];
}
