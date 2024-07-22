<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Proposal extends Model
{
    protected $fillable = ['title', 'description', 'status_id', 'id_sekolah', 'id_user', 'telepon','panjanglokasi', 'lebarlokasi', 'kecamatan_id', 'tanggal'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'proposal_id');
    }
}
