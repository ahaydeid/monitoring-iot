<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device1 extends Model
{
    use HasFactory;
    protected $table = 'device1';
    protected $guarded = ['id'];
}
