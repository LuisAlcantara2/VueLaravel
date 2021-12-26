<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="clientes";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'cli_doc','cli_nombre','cli_direccion','cli_telefono','cli_correo',
    ];
}
