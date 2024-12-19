<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ScheduledMessage extends Model
{
    use HasFactory;

    /**
     * Daftar atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'schedule_type',  // Tipe jadwal (text, image, video, document)
        'is_blast',       // Apakah pesan akan dikirim sebagai blast
        'caption',        // Keterangan tambahan (opsional)
        'number',         // Nomor tujuan
        'message',        // Pesan utama
        'start_in',       // Waktu mulai pengiriman
        'scheduled_time', // Schedule waktu
        'status',         // Status pengiriman (pending, sent, failed)
        'file_path',      // Path file yang diunggah
    ];

    /**
     * Atribut default untuk model.
     */
    protected $attributes = [
        'status' => 'pending', // Status default ketika pesan dibuat
        'is_blast' => false,   // Default tidak blast
    ];

    /**
     * Mutator untuk memastikan is_blast berupa boolean.
     */
    public function setIsBlastAttribute($value)
    {
        $this->attributes['is_blast'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Accessor untuk format tanggal.
     */
    public function getStartInAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * Accessor untuk mendapatkan URL lengkap file yang diunggah.
     */
    public function getFileUrlAttribute()
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }
}
