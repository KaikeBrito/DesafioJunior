<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{

    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'id',
        'name'
    ];

    public function produtos()
    {
        return $this->hasMany(Produtos::class, 'categoria_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
