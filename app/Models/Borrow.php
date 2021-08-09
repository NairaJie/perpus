<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'user_id',
        'book_id',
        'return',
        'deadline',
        'period',
    ];

    protected $hidden =[
        'user_id',
        'book_id',
    ];

    protected $cats =[
        'return' => 'dateTime',
        'deadline'=> 'dateTime',
        'period' => 'dateTime'
    ];
    
    
}
