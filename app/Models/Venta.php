<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{

    use HasFactory;

    use SoftDeletes;
    
    protected $table="ventas";
    protected $dates = ['deleted_at'];
    protected $casts = ['ven_total' => 'float'];

    protected $fillable = [
        'ven_serie','ven_correlativo','ven_fecha','ven_total','cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detalleventa()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
