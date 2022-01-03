<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleVenta extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="detalleventas";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'dvt_cantidad','dvt_precio','venta_id','producto_id',
    ];

    public function venta()
    {
        return $this->belongsTo(Compra::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
