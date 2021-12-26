<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'cat_nombre',
    ];

    public function producto()
    {
        return $this->hasMany(Producto::class);
    }
}
