<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTanam extends Model
{
    use HasFactory;
    protected $table = 'detail_tanam';
    protected $guarded = ['id'];
}
