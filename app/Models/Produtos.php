<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{

    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'id',
        'name',
        'description',
        'categoria_id'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
