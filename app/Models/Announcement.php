<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table = "announcements";
    protected $primarykey = "id";
    protected $fillable = [
        'judul', 'isi', 'file_path', 'admin_id'
    ];
    protected $guarded = ['id'];
    // protected $attributes = [
    //     'admin_id' => 0,
    //  ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
