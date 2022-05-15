<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $fillable = ['template_lk_path','template_rekomendasi_path'];

    // public function recommendation(){
    //     return $this->hasMany(Recommendation::class);
    // }
}