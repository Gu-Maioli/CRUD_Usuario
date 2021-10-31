<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logradouro extends Model
{
    use HasFactory;

    protected $tabla = 'logradouros';
    protected $fillable = ['rua', 'bairro', 'complemento', 'numero', 'cidade'];

    public static function getLogradouro($id){
        return Logradouro::where('id', $id)->select()->first();
    }
    
}
