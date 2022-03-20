<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = ['mahasiswa_id'];
    protected $fillable = ['email_pr1','email_pr2','status_rekomendasi','r1_id','r2_id','file_lk_path', 'file_psikotest_path'];
    protected $attributes = [
        'mahasiswa_id' => 0,
     ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function recommendation(){
        return $this->hasMany(Recommendation::class);
    }
}