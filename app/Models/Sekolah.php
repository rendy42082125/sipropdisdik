<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'sekolah';
    protected $primaryKey = 'id_sekolah';
    
    protected $fillable = [
        'nama_sekolah',
        'alamat',
        'kota',
        'telepon',
        'jenis_id'
    ];

    public function jenis()
    {
    return $this->belongsTo(Jenis::class, 'jenis_id'); // Pastikan 'jenis_id' sesuai dengan nama kolom pada tabel 'sekolah'
    }

}

