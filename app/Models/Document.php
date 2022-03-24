<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $primarykey = "mahasiswa_id";
    protected $guarded = ['mahasiswa_id'];
    protected $fillable = ['status_rekomendasi','file_lk_path', 'file_psikotest_path'];
    protected $attributes = [
        'mahasiswa_id' => 0,
     ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function recommendation(){
    //     return $this->hasMany(Recommendation::class);
    // }
}
