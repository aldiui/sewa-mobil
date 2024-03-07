<?php

namespace App\Models;

use App\Models\Mobil;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $guarded = [];

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'peminjam_id');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
