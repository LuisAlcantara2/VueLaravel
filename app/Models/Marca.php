<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'mar_nombre',
    ];

    public function producto()
    {
        return $this->hasMany(Producto::class);
    }
}