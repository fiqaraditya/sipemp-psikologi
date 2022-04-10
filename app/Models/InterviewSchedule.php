<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewSchedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['tanggal','email_pw_1','email_pw_2','email_mahasiswa','waktu_mulai','waktu_akhir'];
}
