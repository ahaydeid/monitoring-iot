<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanam extends Model
{
    use HasFactory;
    protected $table = 'tanam';
    protected $guarded = ['id'];
}
