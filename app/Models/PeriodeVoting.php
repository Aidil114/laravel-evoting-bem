<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeriodeVoting extends Model
{
    protected $fillable = ['start_time', 'end_time'];

    public function getStatusAttribute()
    {
        $now = Carbon::now();

        if ($now->lt($this->start_time)) {
            return 'belum';
        }

        if ($now->gt($this->end_time)) {
            return 'selesai';
        }

        return 'aktif';
    }
}