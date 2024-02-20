<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keanggotaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'username',
        'jenkel',
        'telepon',
        'email',
        'alamat',
        'foto',
        'qr_code',
    ];
}
