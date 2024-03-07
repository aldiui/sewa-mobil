<?php

namespace App\Models;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'peminjam_id');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

}
