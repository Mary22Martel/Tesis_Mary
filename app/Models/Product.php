<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Campos que son asignables en masa
    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'precio',
        'cantidad_disponible',
        'imagen',
        'categoria'
    ];

    protected $table = 'productos';

    // Relación con el modelo User (agricultor)
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
