<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    //
    use HasFactory;
    protected $table = 'peminjaman';

    protected $fillable = [
        'barang_id',
        'nama_peminjam',
        'kelas_jurusan',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
