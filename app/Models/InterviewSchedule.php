<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewSchedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['tanggal','waktu_mulai','waktu_akhir', 'note', 'filepath'];
}
