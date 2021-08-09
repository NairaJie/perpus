<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    // diisi secara massal
    protected $fillable = [
        'nisbn',
        'title',
        'description',
        'image_url',
        'rating',
        'stock',
        'publisher_id',
        'author_id',
    ];

    //yang ga ditampilin
    protected $hidden = [
        'author_id',
        'publisher_id',
    ];

    // dikonversi jadi tipe data tertentu
    protected $casts =[
        'rating'=> 'double',
        'stock' => 'integer',
    ];
}
