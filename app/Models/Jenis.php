<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function sekolahs()
    {
        return $this->hasMany(Sekolah::class);
    }
}

