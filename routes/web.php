<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Categoria;
use App\Inicio;
use App\Subcategoria;
use App\Archivo;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$categoria = Categoria::all();
	 $inicio = Inicio::find(1);
    return view('principal/dashboard',array('categoria'=>$categoria,'inicio'=>$inicio));
});
Route::get('/usuario/login', function () {
    return view('usuario/login');
});

Route::get('/principal/categoria/{id}', function ($id) {

	$categorias = Categoria::find($id);
	$categoria = Categoria::all();
	$subcategoria = Subcategoria::where('categoriaId',$id)->get();
	$archivos = Archivo::where("categoriaId",$id)->where('visible',4)->get();
    return view('principal/categoria',array('categoria'=>$categoria,'categorias'=>$categorias,'subcategoria'=>$subcategoria,'archivos'=>$archivos));
})->name("principal.categoria"); 