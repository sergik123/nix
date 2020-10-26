<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'author',
        'description',
        'cover',
        'category',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
