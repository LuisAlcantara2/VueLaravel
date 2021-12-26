<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleCompra extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="detallecompras";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'dcp_cantidad','dcp_precio','compra_id','producto_id',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
