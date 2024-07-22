<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatans';
    protected $fillable = ['nama']; // Kolom yang dapat diisi secara massal
    // Atau gunakan $guarded untuk menentukan kolom yang tidak dapat diisi secara massal
}
