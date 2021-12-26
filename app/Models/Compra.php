<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="compras";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'com_serie','com_correlativo','com_fecha','com_total','proveedor_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function detallecompra()
    {
        return $this->hasMany(DetalleCompra::class);
        //return $this->belongsTo(DetalleCompra::class);
    }
}
