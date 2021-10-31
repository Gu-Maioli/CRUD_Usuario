<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $tabla = 'users';
    protected $fillable = ['nome', 'data_nascimento', 'cpf', 'email', 'logradouro_id'];

    public function getUserById($id){
        return Users::where('id', $id)->first();
    }

    public function getAllUsers(){
        return Users::leftJoin('logradouros', 'logradouros.id', 'users.logradouro_id')
                    ->select('users.*', 'users.id as user_id', 'logradouros.*')
                    ->orderby('nome')
                    ->get();
    }

    public static function getUser($id){
        return Users::leftJoin('logradouros', 'logradouros.id', 'users.logradouro_id')
                    ->select('users.*', 'users.id as user_id', 'logradouros.*')
                    ->where('users.id', $id)
                    ->first();
    }
}
