<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Unidad extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="unidades";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'uni_nombre',
    ];

    public function producto()
    {
        return $this->hasMany(Producto::class);
    }
}
