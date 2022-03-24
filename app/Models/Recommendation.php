<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['notelp_pr','file_path','mahasiswa_id','mahasiswa_key','email_pr'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
