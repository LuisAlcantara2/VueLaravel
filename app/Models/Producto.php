<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Producto extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table="productos";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'pro_nombre','pro_stockactual','pro_stockmin','pro_precioventa','pro_preciocompra','categoria_id','unidad_id','marca_id',
    ];

    public function categoria()
    {
        // return $this->belongsTo('App\Categoria', 'categoria_id', 'id');
        return $this->belongsTo(Categoria::class);
    }
    public function unidad()
    {
        // return $this->belongsTo('App\Unidad', 'id', 'unidad_id');
        return $this->belongsTo(Unidad::class);
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
    public function detallecompra()
    {
        return $this->hasMany(DetalleCompra::class);
    }
    public function kardex()
    {
        return $this->hasMany(Kardex::class);
    }

    public static function ActualizarStock($id,$cantidad){ 
        return DB::select(
             DB::raw("UPDATE productos set pro_stockactual = pro_stockactual + '".$cantidad."' where id='".$id."'")
        );
    }
}