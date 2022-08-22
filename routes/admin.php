<?php
/*
* dev: Oscar Peralta
* date: 2019
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Admin;
use App\Usuario;
use App\Inicio;
use App\Categoria;
use App\Utilidades;
use App\SesionUsuario;
use App\Subcategoria;
use App\Archivo;
use App\MovimientoUsuario;
Route::get('/', function () {

    return view('admin/login');

})->name("admin.login");

Route::post('/login', function (Request $request) {

  $administrador = Admin::where("correo", $request->correo)->first();

  if (!$administrador)

    return response()->json(["estado" => false, "detalle" => "incorrecto"]);

  if (!Hash::check($request->password, $administrador->password))

    return response()->json(["estado" => false, "detalle" => "incorrecto"]);
    
    Session::put("admin", $administrador);

    return response()->json(["estado" => true]);
});

Route::get('/logout', function () {
  
  if (Session::has("admin"))

  Session::forget("admin");

  return response()->redirectToRoute("admin.login");

})->name("admin.logout");

Route::group(["middleware" => "AdminAutentificado"],function(){
   
  Route::get('/dashboard', function (Request $request) {
    $categoria = Categoria::orderBy('nombre', 'ASC')->get();
   	$administra =Admin::find(Session::get('admin')->id);
     $inicio = Inicio::find(1);
    return view("admin.dashboard",array('administra'=> 	$administra,'categoria'=>$categoria,'inicio'=>$inicio));

  })->name("admin.dashboard");

  Route::get('/inicios-de-sesion', function (Request $request) {

    $administra =Admin::find(Session::get('admin')->id);
    $categoria = Categoria::orderBy('nombre', 'ASC')->get();
    $sesiones =SesionUsuario::all();
  
    return view("admin.inicioSesion",array('sesiones'=>  $sesiones,'administra'=>$administra,'categoria'=> $categoria));

  })->name("admin.inicioSesion");

  Route::get('/inicio', function (Request $request) {
      
    $categoria = Categoria::orderBy('nombre', 'ASC')->get();
    $inicio = Inicio::find(1);
    $administra =Admin::find(Session::get('admin')->id);
    $usuario = Usuario::all();

    return view("admin.inicio",array('administra'=>  $administra,'usuario'=>$usuario,'inicio'=>$inicio,'categoria'=>$categoria));

  })->name("admin.inicio");
/*==========================================================
                      VISTA  CATEGORIA 
============================================================*/
  Route::get('/categoria/{id}/',function(Request $request,$id){
  $administra =Admin::find(Session::get('admin')->id);
  $categorias = Categoria::find($id);
  $categoria = Categoria::all();
  $rutaFuente = "archivos/".$categorias->carpeta."/archivos-fuente/";
  $archivoFuente = Archivo::where('src_archivo',$rutaFuente)->get();
  $rutaObsoleto = "archivos/".$categorias->carpeta."/obsoletos/";
  $archivoObsoleto = Archivo::where('src_archivo',$rutaObsoleto)->get();
  $rutaDerogado = "archivos/".$categorias->carpeta."/derogados/";
  $archivoDerogado = Archivo::where('src_archivo',$rutaDerogado)->get();
  $subcategoria = Subcategoria::where('categoriaId',$id)->get();
  $sub = Subcategoria::all();
  $util= new Utilidades();

  $archivos = Archivo::where("categoriaId",$id)->get();

  return view('admin/categoria',array('administra'=>$administra, 'categoria'=>$categoria, 'categorias'=>$categorias, 'subcategoria'=>$subcategoria, 'sub'=>$sub, 'archivos'=>$archivos, 'obsoletos'=>$archivoObsoleto,'derogados'=>$archivoDerogado,'fuentes'=>$archivoFuente));
  })->name("admin.categoria");


/*==========================================================
                      VISTA  mOVImIENTOS 
============================================================*/

  Route::get('/movimientos',function(Request $request){
    $administra =Admin::find(Session::get('admin')->id);
    $categoria = Categoria::all();
   $movimiento = MovimientoUsuario::all();
    return view('admin/movimientos', array('categoria'=> $categoria,'administra'=>  $administra,'movimiento'=>$movimiento));

  })->name("admin.movimientos");

  /*==========================================================
                      VISTA  ARCHIVO
============================================================*/

  Route::get('/archivo',function(Request $request){
        
    $administra =Admin::find(Session::get('admin')->id);
    $categoria = Categoria::orderBy('nombre', 'ASC')->get();
    $archivo = Archivo::all();
   
    return view('admin/archivo', array('categoria'=> $categoria,'administra'=>$administra,'archivo'=>$archivo));

  })->name("admin.archivo");

/*==========================================================
                      VISTA USUARIO 
============================================================*/
       
  Route::get('/usuario', function (Request $request) { 
    $categoria = Categoria::orderBy('nombre', 'ASC')->get();
    $administra =Admin::find(Session::get('admin')->id);
    $usuario = Usuario::all();
    
    return view("admin.usuario",array('administra'=>  $administra,'usuario'=>$usuario,'categoria'=>$categoria));
  })->name("admin.usuario");


/*==========================================================
                      VISTA BIENVENIDA 
============================================================*/
    
  Route::post('/editar-bienvenida', function (Request $request) {
           
    $inicio = Inicio::find($request->id);

    if($inicio){

      $inicio->bienvenida = $request->bienvenida;
      $inicio->save();

      return response()->json(["estado" => true]);
            
    }else{

        return response()->json(["estado" => false, "detalle" => "incorrecto"]);
    }
                     
  });

  Route::post('/editar-politica', function (Request $request) {
       
    $inicio = Inicio::find($request->id);

    if($inicio){

      $inicio->politica = $request->politica;
      $inicio->save();

      return response()->json(["estado" => true]);
          
    }else{

        return response()->json(["estado" => false, "detalle" => "incorrecto"]);
    }             
  });
  Route::post('/editar-mision', function (Request $request) {
       
    $inicio = Inicio::find($request->id);

    if($inicio){

      $inicio->mision = $request->mision;
      $inicio->save();

      return response()->json(["estado" => true]);
              
    }else{

      return response()->json(["estado" => false, "detalle" => "incorrecto"]);
    }
            
  });
  Route::post('/editar-vision', function (Request $request) {
       
    $inicio = Inicio::find($request->id);

    if($inicio){

      $inicio->vision = $request->vision;
      $inicio->save();

      return response()->json(["estado" => true]);
            
    }else{

        return response()->json(["estado" => false, "detalle" => "incorrecto"]);
    }
                 
  });

/*==========================================================
                      AGREGAR  USUARIO 
============================================================*/

  Route::post('/agregar-usuario', function(Request $request){

    try{
      $verificar = Usuario::where('correo',$request->correo)->first();
      if (!$verificar) {
      $usuario = new Usuario();
      $usuario->nombre = $request->nombre;
      $usuario->apellidoPaterno = $request->apellidoPaterno;
      $usuario->apellidoMaterno = $request->apellidoMaterno;
      $usuario->tipo = $request->tipo;
      $usuario->estatus = $request->estatus;
      $usuario->password = Hash::make("sigupt2021");
      $usuario->correo = $request->correo;
      $usuario->codigo = str_random($request->codigo);
      $usuario->save();
      }else{
        return Response::json(["estado" => false, "detalle" => "El correo electronico ya existe"]);
      }
      
      return response()->json(["estado" => true]);

    }catch(Exception $ex){
                
      return Response::json(["estado" => false, "detalle" => "incorrecto"]);
    }

  });
/*==========================================================
                      EDITAR  USUARIO 
============================================================*/
  Route::post('/editar-usuario', function (Request $request) {

    $usuario = Usuario::find($request->id);
    if($usuario){
      $verificar = Usuario::where('correo',$request->correo)->first();
      if (!$verificar || $usuario->correo == $request->correo) {
      $usuario->nombre = $request->nombre;
      $usuario->apellidoPaterno = $request->apellidoPaterno;
      $usuario->apellidoMaterno = $request->apellidoMaterno;
      $usuario->tipo = $request->tipo;
      $usuario->estatus = $request->estatus;
      $usuario->password = $request->password;
      $usuario->correo = $request->correo;
      $usuario->codigo = $request->codigo;
      $usuario->save(); 
      }else{
         return Response::json(["estado" => false, "detalle" => "El correo electronico ya existe"]);
      }
      return response()->json(["estado" => true]);       
    }else{
      return response()->json(["estado" => false, "detalle" => "usuario no encontrado"]);
    }       
  });
/*==========================================================
                      ELIImNAR  USUARIO 
============================================================*/
  Route::post('/eliminar-usuario', function (Request $request) {
         
    $usuario = Usuario::where('id',$request->id)->first();

    if($usuario){

      $usuario->delete();

      return response()->json(["estado" => true]);
                
    }else{

      return response()->json(["estado" => false, "detalle" => "incorrecto"]);
    }
                   
  });
/*==========================================================
                      REINICIAR  USUARIO 
============================================================*/
  Route::post('/reiniciar-usuario', function (Request $request) {
         
    $usuario = Usuario::find($request->id);

    if($usuario){
      if (!($usuario->estatus == 0)) {
      $usuario->nombre = $request->nombre;
      $usuario->apellidoPaterno = $request->apellidoPaterno;
      $usuario->apellidoMaterno = $request->apellidoMaterno;
      $usuario->tipo = $request->tipo;
      $usuario->estatus = $request->estatus;
      $usuario->password = $request->password;
      $usuario->correo = $request->correo;
      $usuario->codigo = $request->codigo;
      $usuario->save();
        return response()->json(["estado" => true]);
      }else{
        return response()->json(["estado" => false, "detalle" => "El usuario no ha realizado el primer inicio"]);
      }
    }else{
      return response()->json(["estado" => false, "detalle" => "El usuario no existe"]);
    }

  });
/*==========================================================
                      AGREGAR CATEGORIA
============================================================*/
  Route::post('/agregar-categoria', function (Request $request) {
      
    //try{
      
      $util = new Utilidades();
      
      $categoria = new Categoria();

      $verificar = Categoria::where('nombre',$request->nombre)->first();
      
      if (!$verificar) {
      
          $categoria->nombre = $request->nombre;
          $categoria->carpeta= $request->carpeta;
          $categoria->carpeta= $util->crearSlug($request->nombre);
          $categoria->posicion = $request->posicion;
          $guardar = $categoria->save();

      }else{
        return response()->json(["estado" => false, "detalle" => "EL nombre de la categoria ya existe"]);
      }
      if ($guardar) {
        $crearCarpetaCategoria = mkdir("archivos/".$util->crearSlug($request->nombre),0700,true);
        
        if ($crearCarpetaCategoria) 
        {
          $crearObsoletos = mkdir("archivos/".$util->crearSlug($request->nombre)."/obsoletos",0700,true);
          $crearDerogados = mkdir("archivos/".$util->crearSlug($request->nombre)."/derogados",0700,true);
          $crearFuente = mkdir("archivos/".$util->crearSlug($request->nombre)."/archivos-fuente",0700,true);
        }else{
          return response()->json(["estado" => false, "detalle" => "No se pudieron crear carpetas"]);
        }
      }else{
         return response()->json(["estado" => false, "detalle" => "No se pudo guardar categoria"]);
      }
        return response()->json(["estado" => true, "mensaje"=>"Se agrego categoria"]);        
    //}catch(Exception $ex){
        //return response()->json(["estado" => false, "detalle" => $ex]);
    //}
  });
/*==========================================================
                      AGREGAR SUBCATEGORIA
============================================================*/
  Route::post('/agregar-subcategoria', function (Request $request) { 

    try{

      $util = new Utilidades();
      $subcategoria = new Subcategoria();
      $verificar = Subcategoria::where('nombre', $request->nombre)->first();
      $buscarCategoria = Categoria::find($request->categoriaId);
      if (!$verificar) {
        $subcategoria->nombre = $request->nombre;
        $subcategoria->categoriaId= $request->categoriaId;
        $guardar =  $subcategoria->save();
      }else{
        return response()->json(["estado" => false, "detalle" => "El nombre de la Subcategoria ya existe"]);
      }
      if ($guardar) {
        $crearCarpetaCategoria = mkdir("archivos/".$util->crearSlug($buscarCategoria->nombre)."/".$util->crearSlug($request->nombre),0700,true);
      }else{
        return response()->json(["estado" => false, "detalle" => "No se pudo crear la carpeta"]);
      }
      return response()->json(["estado" => true, "mensaje"=>"Se agrego subcategoria"]);  
    }catch(Exception $ex){
      return response()->json(["estado" => false, "detalle" => $ex]);
    }
  });
/*==========================================================
        SELECT DE SUBCATEGORIAS VIEW archivo.blade.php
============================================================*/
  Route::get('/niveles/{id_category?}', function (Request $request,$id_category) {
    if($request->ajaX()){
      $niveles = SubCategoria::where('categoriaId', $id_category)->get();
       $verifica = SubCategoria::where('categoriaId', $id_category)->first();
       if (!$verifica) {
        return response()->json(["estado" => false, "detalle" => "No contiene ninguna Subcategoria"]);   
       }else{
         return response()->json($niveles);
       }  
    }else{
      return response()->json(["estado" => false, "detalle" => "incorrecto algo esta mal"]);
    }                   
  });
/*==========================================================
                      EDITAR ARCHIVO
============================================================*/
  Route::post('/editar-archivo', function (Request $request) {
    try {

      $util = new Utilidades();
      $categoria = Categoria::find($request->categoriaId);
      $subcategoria = Subcategoria::find($request->subcategoriaId);
      $archivo = Archivo::find($request->id);
      $extension = explode(".", $archivo->slug);//.docx
      $verificarNombre = $util->crearSlug($request->nombre).".".$extension[1];// documento.docx
      $rutaNueva = "archivos/".$categoria->carpeta."/".$util->crearSlug($subcategoria->nombre)."/";
      $cambioSlug = $util->crearSlug($request->nombre).".".$extension[1];
      $verifica = rename($archivo->src_archivo.$archivo->slug, $rutaNueva.$cambioSlug);
        if ($verifica) {
          $archivo->nombre = $request->nombre;
          $archivo->tipo = $request->tipo;
          $archivo->categoriaId = $request->categoriaId;
          $archivo->visible = $request->visible;
          $archivo->n_subcategoria = $subcategoria->nombre;
          $archivo->usuarioId = null; 
          $archivo->slug = $util->crearSlug($request->nombre).".".$extension[1]; 
          $archivo->carpeta = null;
          $archivo->src_archivo = $rutaNueva;
          $guardar = $archivo->save();
        }else{
          return response()->json(["estado" => false, "detalle" => "No se pudo renombrar el archivo"]);
        }
        if (!$guardar) {
          return response()->json(["estado" => false, "detalle" => "No se pudo guardar el archivo"]);
        }
        return response()->json(["estado" => true, "mensaje"=>"Se Edito el Archivo"]);
      } catch (Exception $ex) {
        return response()->json(["estado" => false, "detalle" => $ex]);
      }              
    });
/*==========================================================
        mOVER ARCHIVO VIEW archivo.blade.php
============================================================*/
  Route::post('/mover-archivo', function (Request $request) { 

        try{
           $util = new Utilidades();
           $archivo = Archivo::find($request->id);
           $categoria = Categoria::find($archivo->categoriaId);
           $rutaDerogados = "archivos/".$util->crearSlug($categoria->nombre)."/derogados/";
           $rutaObsoletos = "archivos/".$util->crearSLug($categoria->nombre)."/obsoletos/";
           $rutaFuente = "archivos/".$util->crearSLug($categoria->nombre)."/archivos-fuente/";
           $rutaActual = $archivo->src_archivo."/".$archivo->slug;
                if ($request->mover == 1 OR $rutaObsoletos.$archivo->slug == $rutaActual OR $rutaFuente.$archivo->slug == $rutaActual) {
                  $crearDerogado =  rename($archivo->src_archivo."/".$archivo->slug, $rutaDerogados.$archivo->slug);
                   if ($crearDerogado) {
                       $archivo->nombre = $archivo->nombre;
                       $archivo->tipo = $archivo->tipo;
                       $archivo->src_archivo = $rutaDerogados; 
                       $archivo->usuarioId = $archivo->usuarioId;
                       $archivo->visible = $archivo->visible;
                       $archivo->slug  = $archivo->slug;
                       $archivo->n_subcategoria = null;
                       $archivo->carpeta = 1;
                       $archivo->save(); 
                   }else{
                     return response()->json(["estado" => false, "detalle" => "No se pudo mover a la carpeta Derogados"]);
                   }
                }elseif ($request->mover == 2 OR $rutaDerogados.$archivo->slug == $rutaActual OR $rutaFuente.$archivo->slug == $rutaActual) {
                    $crearObsoleto = rename($archivo->src_archivo."/".$archivo->slug,$rutaObsoletos.$archivo->slug);
                    if ($crearObsoleto) {
                       $archivo->nombre = $archivo->nombre;
                       $archivo->tipo = $archivo->tipo;
                       $archivo->src_archivo = $rutaObsoletos; 
                       $archivo->usuarioId = $archivo->usuarioId;
                       $archivo->visible = $archivo->visible;
                       $archivo->slug  = $archivo->slug;
                       $archivo->n_subcategoria = null;
                       $archivo->carpeta = 2;
                       $archivo->save();
                   }else{
                    return response()->json(["estado" => false, "detalle" => "No se  la pudo mover a la carpeta Obsoletos"]);
                   }
                }elseif ($request->mover == 3 OR $rutaDerogados.$archivo->slug == $rutaActual OR $rutaObsoletos.$archivo->slug == $rutaActual) { 
                    $crearFuente = rename($archivo->src_archivo."/".$archivo->slug, $rutaFuente.$archivo->slug);
                   if ($crearFuente) {
                       $archivo->nombre = $archivo->nombre;
                       $archivo->tipo = $archivo->tipo;
                       $archivo->src_archivo = $rutaFuente; 
                       $archivo->usuarioId = $archivo->usuarioId;
                       $archivo->visible = $archivo->visible;
                       $archivo->slug  = $archivo->slug;
                       $archivo->n_subcategoria = null;
                       $archivo->carpeta = 3;
                       $archivo->save();
                   }else{
                    return response()->json(["estado" => false, "detalle" => "No se pudo mover a la carpeta Archivos Fuente"]);
                   }
                }
            return response()->json(["estado" => true, "mensaje"=>"Se Movio Archivo"]);
                
        }catch(Exception $ex){

            return response()->json(["estado" => false, "detalle" => $ex]);
        }
    });
/*==========================================================
        mOVER ARCHIVO VIEW categoria.blade.php
============================================================*/
   Route::post('/movimiento-archivo', function (Request $request) { 

        try{
           $util = new Utilidades();
           $archivo = Archivo::find($request->id);
           $categoria = Categoria::find($archivo->categoriaId);
           $rutaDerogados = "archivos/".$util->crearSlug($categoria->nombre)."/derogados/";
           $rutaObsoletos = "archivos/".$util->crearSLug($categoria->nombre)."/obsoletos/";
           $rutaFuente = "archivos/".$util->crearSLug($categoria->nombre)."/archivos-fuente/";
           $rutaActual = $archivo->src_archivo."/".$archivo->slug;
                if ($request->mover == 1 OR $rutaObsoletos.$archivo->slug == $rutaActual OR $rutaFuente.$archivo->slug == $rutaActual) {
                    $crearDerogado = rename($archivo->src_archivo.$archivo->slug, $rutaDerogados.$archivo->slug);
                   if ($crearDerogado) {
                       $archivo->nombre = $archivo->nombre;
                       $archivo->tipo = $archivo->tipo;
                       $archivo->src_archivo = $rutaDerogados; 
                       $archivo->usuarioId = $archivo->usuarioId;
                       $archivo->visible = $archivo->visible;
                       $archivo->slug  = $archivo->slug;
                       $archivo->n_subcategoria = null;
                       $archivo->carpeta = 1;
                       $archivo->save();
                   }else{
                      return response()->json(["estado" => false, "detalle" => "No se pudo mover a la carpeta Derogados"]);
                   }
                }elseif ($request->mover == 2 OR $rutaDerogados.$archivo->slug == $rutaActual OR $rutaFuente.$archivo->slug == $rutaActual) {
                    $crearObsoleto = rename($archivo->src_archivo.$archivo->slug,$rutaObsoletos.$archivo->slug);
                    if ($crearObsoleto) {
                       $archivo->nombre = $archivo->nombre;
                       $archivo->tipo = $archivo->tipo;
                       $archivo->src_archivo = $rutaObsoletos; 
                       $archivo->usuarioId = $archivo->usuarioId;
                       $archivo->visible = $archivo->visible;
                       $archivo->slug  = $archivo->slug;
                       $archivo->n_subcategoria = null;
                       $archivo->carpeta = 2;
                       $archivo->save();
                   }else{
                      return response()->json(["estado" => false, "detalle" => "No se  la pudo mover a la carpeta Obsoletos"]);
                   }
                }elseif ($request->mover == 3 OR $rutaDerogados.$archivo->slug == $rutaActual OR $rutaObsoletos.$archivo->slug == $rutaActual) { 
                    $crearFuente = rename($archivo->src_archivo.$archivo->slug, $rutaFuente.$archivo->slug);
                   if ($crearFuente) {
                       $archivo->nombre = $archivo->nombre;
                       $archivo->tipo = $archivo->tipo;
                       $archivo->src_archivo = $rutaFuente; 
                       $archivo->usuarioId = $archivo->usuarioId;
                       $archivo->visible = $archivo->visible;
                       $archivo->slug  = $archivo->slug;
                       $archivo->n_subcategoria = null;
                       $archivo->carpeta = 3;
                       $archivo->save();
                   }else{
                      return response()->json(["estado" => false, "detalle" => "No se pudo mover a la carpeta Archivos Fuente"]);
                   }
                }
                
            return response()->json(["estado" => true, "mensaje"=>"Se Movio Archivo"]);
                
        }catch(Exception $ex){

            return response()->json(["estado" => false, "detalle" => $ex]);
        }
    });
/*==========================================================
                      ELImINAR ARCHIVO 
============================================================*/
 Route::get('/eliminar-archivo/{id}', function (Request $request,$id) {
        if($request->ajaX()){
          $archivo = Archivo::find($id);
          $tipoCarpeta = $archivo->carpeta;
            if ($archivo) {
                unlink($archivo->src_archivo.$archivo->slug);              
                $archivo->delete();
               return response()->json(["estado" => false, "detalle" => true]);
            }else{
               return response()->json(["estado" => false, "detalle" => "No se pudo eliminar archivo"]);
            }
        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }           
    });

/*==========================================================
                      AGREGAR ARCHIVO
============================================================*/
Route::post('/agregar-archivo/categoria', function (Request $request) {

        //try{
            $extensionDisponible = array("docx","doc","xls","xlsx","ppt","pptx","pdf","xlsx","jpg");
            $util = new Utilidades();
            $subcategoria = Subcategoria::find($request->subcategoriaId);
            $categoria = Categoria::find($subcategoria->categoriaId);

    /*
     *  ESTA OBTIENIENDO EL ID DEL USUARIO, PERO ESTA EN LA SESION DE ADMINISTRADOR
     */

            //$usuario = Usuario::find(Session::get('usuario')->id);

    /*$slug = $util->crearSlug($request->nombre);
            $ruta = "archivos/".$categoria->carpeta."/".$util->crearSlug($subcategoria->nombre)."/";
            $file = $_FILES['entradaArchivo']['name'][0];
            $info = pathinfo($file);
            if (!(in_array($info['extension'], $extensionDisponible))) {
                return response()->json(["estado" => false, "detalle" => "Asegurate de que el archivo tenga extension .doc .docx ppt. pptx. .xls .xlsx .pdf"]);
             }
            $archivo = new Archivo();
            if ($file && move_uploaded_file($_FILES['entradaArchivo']['tmp_name'][0],$ruta.$slug.".".$info['extension'])) {
                $archivo->nombre = $request->nombre;
                $archivo->tipo = $request->tipo;
                $archivo->visible = $request->visible;
                $archivo->usuarioId = $usuario->id;
                $archivo->categoriaId = $categoria->id;
                $archivo->carpeta = null;
                $archivo->n_subcategoria = $subcategoria->nombre;
                $archivo->slug = $slug.".".$info['extension'];
                $archivo->src_archivo = $ruta;
                $archivo->save();
            }else{
                return response()->json(["estado" => false, "detalle" => "Verifica que los campos no esten vacios"]);
            }
            
            return response()->json(["estado" => true, "mensaje"=>"Se agrego archivo"]);
    */

        //}catch(Exception $ex){

            //return response()->json(["estado" => false, "detalle" => $ex]);
        //}
    });
/*==========================================================
                     SELECT CATEGORIA categora.blade.php
============================================================*/

  Route::get('/categoria/{id}/nivel/{id_cat}', function (Request $request,$id,$id_cat) {

        if($request->ajaX()){
           
            $niveles = SubCategoria::where('categoriaId', $id_cat)->get();
          
           return response()->json($niveles);       
        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }
                   
    });
    Route::get('/categoria/{id}/subcategoria-id/{ids}/', function (Request $request,$id,$ids) {

        if($request->ajaX()){
           
            $idSubcategoria = SubCategoria::where('nombre',$ids)->first();
          
           return response()->json(["sub"=>$idSubcategoria]);       
        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }
                   
    });

    Route::post('/edicion-subcategoria', function (Request $request) { 
        try{
            $util = new Utilidades();
            
            $subcategoria = Subcategoria::find($request->id);
            $editarArchivo = Subcategoria::find($request->id);
            $categoria = Categoria::find($subcategoria->categoriaId);
            
            $rutaAnterior = "archivos/".$categoria->carpeta."/".$util->crearSlug($subcategoria->nombre);
            $rutaNueva = "archivos/".$categoria->carpeta."/".$util->crearSlug($request->nombre);
            
            $archivo = Archivo::where('n_subcategoria',$editarArchivo->nombre)->get();
          
            foreach ($archivo as $archive) {
               
                $archive->nombre = $archive->nombre;
                $archive->tipo = $archive->tipo;
                $archive->usuarioId = $archive->usuarioId;
                $archive->categoriaId = $archive->categoriaId;
                $archive->carpeta = $archive->carpeta;
                $archive->visible = $archive->visible;
                $archive->slug = $archive->slug;
                $archive->n_subcategoria = $request->nombre;
                $archive->src_archivo = $rutaNueva."/";
                $archive->save();
                
            }
              rename($rutaAnterior, $rutaNueva);
            
            
            if ($subcategoria) {
               $subcategoria->nombre = $request->nombre;
               $subcategoria->categoriaId = $categoria->id;
               $subcategoria = $subcategoria->save();
            }
            
            return response()->json(["estado" => true, "mensaje"=>"Se agrego archivo"]);

        }catch(Exception $ex){

            return response()->json(["estado" => false, "detalle" => $ex]);
        }
    });
    Route::get('/eliminar-subcategoria/{id}', function (Request $request,$id) {

        if($request->ajaX()){
           
            $subcategoria = Subcategoria::find($id);
            $archivo = Archivo::where('n_subcategoria',$subcategoria->nombre)->get();
            $nombreSubcategoria  = Archivo::where('n_subcategoria',$subcategoria->nombre)->first();

            foreach ($archivo as $archive) {
               $archivoEliminado =  $archive->delete();
               unlink($archive->src_archivo.$archive->slug);
            }
            if ($archivoEliminado) {
                $subcategoria->delete();
            }
             if ($nombreSubcategoria) {
                rmdir($nombreSubcategoria->src_archivo);
            }
           return response()->json(["estado" => true]);       
        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }
                   
    });

    Route::post('/edicion-categoria', function(Request $request){
        try {
            $util = new Utilidades();
            $categoria = Categoria::find($request->id); 
            
            $archivo = Archivo::where('categoriaId',$categoria->id)->get();
           
            // $archivoUrl = Archivo::where('categoriaId',$categoria->id)->first();
            $categoriaAnterior = "archivos/".$categoria->carpeta;

            $categoriaNueva = "archivos/".$util->crearSlug($request->nombre);

            rename($categoriaAnterior, $categoriaNueva);

            foreach ($archivo as $archive) {
            $archive->nombre = $archive->nombre;
            $archive->tipo = $archive->tipo;
            $archive->usuarioId = $archive->usuarioId;
            $archive->categoriaId = $archive->categoriaId;
            $archive->src_archivo = "archivos/".$util->crearSlug($request->nombre)."/".$util->crearSlug($archive->n_subcategoria)."/";
            $archive->visible = $archive->visible;
            $archive->slug = $archive->slug;
            $archive->carpeta = $archive->carpeta;
            $archive->n_subcategoria = $archive->n_subcategoria;
            $archive->save();                  # code...
            }
            if ($categoria) {
                $categoria->nombre = $request->nombre;
                $categoria->carpeta = $util->crearSlug($request->nombre);
                $categoria->posicion = 7;
                $categoria->save();               # code...
            }
            return response()->json(["estado" => true, "mensaje"=>"Se edito categoria"]);

        } catch (Exception $ex) {
            return response()->json(["estado" => false, "detalle" => $ex]);
        }
   
    });
    Route::get('/categoria/{id}/verificar-archivo/{idArc}', function (Request $request,$id,$idArc) {

        if($request->ajaX()){
           
            $archivos = Archivo::where('id', $idArc)->get();
            $archivoSub = Archivo::find($idArc);
            $categoria = Categoria::all();
            $subcatego  = SubCategoria::where('categoriaId',$archivoSub->categoriaId)->get();  
           
    return response()->json(["archivos"=>$archivos, "categoria"=>$categoria,"subcatego"=>$subcatego]);      
        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }           
    }); 
        Route::get('/eliminar-categoria/{id}', function (Request $request,$id) {

        if($request->ajaX()){

            $util = new Utilidades();
            $categoria = Categoria::find($id);
            $archivo = Archivo::where('categoriaId',$categoria->id)->get();
            $subcategoria = Subcategoria::where('categoriaId', $categoria->id)->get();
                foreach ($archivo as $archivos) {
                  $archivos->delete();

                }
            foreach ($subcategoria as $subcategorias) {
                $subcategorias->delete();
            }
             eliminarCarpeta("archivos/".$categoria->carpeta."/archivos-fuente/");
             eliminarCarpeta("archivos/".$categoria->carpeta."/derogados/");
             eliminarCarpeta("archivos/".$categoria->carpeta."/obsoletos/");
             eliminarCarpeta("archivos/".$categoria->carpeta."/");
            $categoria->delete();
           return response()->json(["estado" => true]); 
        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }     
    }); 
  Route::post('/agregar-archivo/registro', function (Request $request) {

        try{
           

            $util = new Utilidades();
            $archivo = new Archivo();

            $file = $_FILES['entradaArchivo']['name'][0];

            $info = pathinfo($file);

            $nombre = $util->crearSlug($request->nombre);

            $verificacion = Archivo::where('nombre',$request->nombre)->first();
               $categoria = Categoria::find($request->categoriaId);
                $subcategoria = Subcategoria::find($request->subcategoriaId);
                $ruta = "archivos/".$util->crearSlug($categoria->nombre)."/".$util->crearSlug($subcategoria->nombre)."/";

            if(!$verificacion){

                $archivo->nombre = $request->nombre;
                
                $archivo->tipo= $request->tipo;
                
                $archivo->usuarioId= NULL;
                
                $archivo->categoriaId= $request->categoriaId;
                
                $archivo->n_subcategoria= $subcategoria->nombre;
                
                $archivo->carpeta= null;

                $archivo->slug = $nombre.".".$info['extension'];

                $archivo->src_archivo = $ruta;
                
                $archivo->visible= $request->visible;
                
                $archivo->save();
            
                if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta.$util->crearSlug($request->nombre) . "." . $info['extension'])) {
                }else {
                    return response()->json(["estado" => false, "mensaje"=>"No se pudo guardar archivo"]);
                }      
            }else{
                return response()->json(["estado" => false, "detalle" =>"Ya existe un archivo similar" ]);
            }
           
        }catch(Exception $ex){

             return response()->json(["estado" => true, "mensaje"=>"Se agrego Archivo"]);     
        }
    });
  Route::get('/eliminar-mover/{id}', function (Request $request,$id) {

        if($request->ajaX()){
           
            $archivo = Archivo::find($id);
            $eliminarArchivo = unlink($archivo->src_archivo.$archivo->slug);
            if ($eliminarArchivo) {
                if ($archivo) {
                $eliminado = $archivo->delete();
            }else{
                return response()->json(["estado" => false, "detalle" => "no se encontro el archivo"]);
            }
            }else{
                return response()->json(["estado" => false, "detalle" => "no se pudo eliminar el archivo de la carpeta"]);
            }
           return response()->json(["estado" => true]);       
        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }
                   
    });
});
function eliminarCarpeta($path) {
  if (!is_dir($path)) {
    throw new InvalidArgumentException("$path Debe ser um directorio");
  }
  if (substr($path, strlen($path) - 1, 1) != DIRECTORY_SEPARATOR) {
    $path .= DIRECTORY_SEPARATOR;
  }
  $files = glob($path . '*', GLOB_MARK);
  foreach ($files as $file) {
    if (is_dir($file)) {
      eliminaCarpeta($file);
    } else {
      unlink($file);
    }
  }
  rmdir($path);
}