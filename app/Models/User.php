<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'correo',
        'contraseña'
    ];

    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
