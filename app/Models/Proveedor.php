<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="proveedores";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'pvd_doc','pvd_nombre','pvd_direccion','pvd_telefono',
    ];

    public function compra()
    {
        return $this->hasMany(Compra::class);
    }
}
