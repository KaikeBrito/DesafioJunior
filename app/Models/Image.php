<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    use HasFactory;

    protected $fillable = ['filename', 'url', 'imageable_id', 'imageable_type'];

    /**
     * Obtém o modelo pai (categoria ou produto) que possui a imagem.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
