<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'photo', 'visi', 'misi'];

    // 🔹 Tambahkan relasi ke tabel votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}