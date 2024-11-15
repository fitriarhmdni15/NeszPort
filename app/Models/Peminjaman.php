<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman'; // Pastikan nama tabel sesuai dengan migrasi

    protected $fillable = [
        'user_id',
        'barang_id',
        'nama_peminjam',
        'tanggal_peminjaman',
        'jumlah_peminjaman',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
