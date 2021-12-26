<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="empresas";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'emp_ruc','emp_nombre','emp_logo','emp_direccion','emp_telefono','emp_correo',
    ];
}
