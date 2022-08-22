<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SesionUsuario extends Model
{
    protected $table = "sesion_usuario";
    
    public function  usuarios(){

       return $this->hasOne("App\Usuario", "id", "usuarioId");

     }
}
