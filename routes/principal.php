<!--
    dev: Oscar Peralta
    date 2019
-->
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Categoria;
use App\Inicio;
use App\Subcategoria;
use App\Archivo;

Route::get('/', function () {
	$categoria = Categoria::orderBy('nombre', 'ASC')->get();
	 $inicio = Inicio::find(1);
    return view('principal/dashboard',array('categoria'=>$categoria,'inicio'=>$inicio));
});

