<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRCodeData extends Model
{
    use HasFactory;
    protected $table = 'Keanggotaan'; // Ganti 'nama_tabel' dengan nama tabel yang digunakan untuk menyimpan data QR code

    protected $fillable = [
        'username', 'qr_code',
    ];
}
