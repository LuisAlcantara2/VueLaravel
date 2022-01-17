<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Kardex extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="kardex";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'krd_fecha','krd_tipo','krd_cantidad','krd_anterior','krd_actual','producto_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
