<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="serie";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'ser_serie','ser_corre',
    ];
}