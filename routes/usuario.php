<?php
/*
* dev: Oscar Peralta
* date: 2019
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Archivo;
use App\Categoria;
use App\Inicio;
use App\Usuario;
use App\Utilidades;
use App\SesionUsuario;
use App\Subcategoria;
use App\MovimientoUsuario;

Route::get('/', function () {

    return view('usuario/login');

})->name("usuario.login");

Route::post('/login', function (Request $request) {

    $usuario = Usuario::where("correo", $request->correo)->first();
   
    if (!$usuario)

        return response()->json(["estado" => false, "detalle" => "incorrecto"]);

    if (!Hash::check($request->password, $usuario->password))

        return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        
        Session::put("usuario", $usuario);
         $agregarSesion = new SesionUsuario();
        $agregarSesion->usuarioId = $usuario->id;
        $agregarSesion->save();
        return response()->json(["estado" => true, "estatus"=>$usuario->estatus]);
});

Route::get('/logout', function () {
    if (Session::has("usuario"))

        Session::forget("usuario");

    return response()->redirectToRoute("usuario.login");

})->name("usuario.logout");

Route::group(["middleware" => "UsuarioAutentificado"],function(){

    Route::get('/dashboard', function (Request $request) {

        $user = Usuario::find(Session::get('usuario')->id);

        $categoria = Categoria::orderBy('nombre', 'ASC')->get();
        $inicio = Inicio::find(1);

        return view('usuario/dashboard',array('user'=> $user,'inicio'=>$inicio))->with(compact('categoria'));

    })->name("usuario.dashboard");

    Route::get('/primerInicio', function () {

        $usuarios = Usuario::find(Session::get("usuario")->id);

        return view("usuario.primerInicio",array("usuarios"=>$usuarios));

    })->name("usuario.primerInicio");

    Route::get('/inicio',function(Request $request){

        $categoria = Categoria::orderBy('nombre', 'ASC')->get();
        
        $user = Usuario::find(Session::get('usuario')->id);
        
        $inicio = Inicio::find(1);

        return view('usuario/inicio', array('user'=> $user, 'inicio'=>$inicio))->with(compact('categoria'));

    })->name("usuario.inicio");

    Route::get('/categoria/{id}/',function(Request $request,$id){
        
        $user = Usuario::find(Session::get("usuario")->id);
        $categorias = Categoria::find($id);
        $rutaFuente = "archivos/".$categorias->carpeta."/archivos-fuente/";
        // $archivoFuente = Archivo::where('src_archivo',$rutaFuente)->get();
        $rutaObsoleto = "archivos/".$categorias->carpeta."/obsoletos/";
        // $archivoObsoleto = Archivo::where('src_archivo',$rutaObsoleto)->get();
        $rutaDerogado = "archivos/".$categorias->carpeta."/derogados/";
        // $archivoDerogado = Archivo::where('src_archivo',$rutaDerogado)->get();
        $categoria = Categoria::all();
        $subcategoria = Subcategoria::where('categoriaId',$id)->get();
        $sub = Subcategoria::all();
        $util= new Utilidades();
           
        $archivos = Archivo::where("categoriaId",$id)->get();
        $archivoSoloY = [];
        $normales = [];
        $archivoDerogado = [];

       //RESTRICCIONES ARCHIVOS USUARIOS
       $archivoFuente = [];
       $archivoObsoleto = [];

       if($user->tipo == 2){            
            $archivosYo = Archivo::where('usuarioId',$user->id)->where('visible',1)->get();
            $archivoNormal = Archivo::whereIn('visible',[2,3,4])->get();
            foreach ($archivosYo as $normal) {
                array_push($normales,$normal);
            }

            foreach ($archivoNormal as $normal) {
                array_push($normales,$normal);
            }

            foreach ($normales as $normal) {
                array_push($archivoSoloY,$normal);
            }
            $archivoFuente = Archivo::where('src_archivo',$rutaFuente)->where('usuarioId',$user->id)->whereIn('visible',[1,2,3,4])->get();
            $archivoObsoleto = Archivo::where('src_archivo',$rutaObsoleto)->where('usuarioId',$user->id)->whereIn('visible',[1,2,3,4])->get();
            $archivoDerogado = Archivo::where('src_archivo',$rutaDerogado)->where('usuarioId',$user->id)->whereIn('visible',[1,2,3,4])->get();
            array_unique($archivoSoloY);

       }elseif ($user->tipo == 1) {        
            $archivosNormal = Archivo::whereIn('visible',[3,4])->get();            
            foreach ($archivosNormal as $normal) {
                 $archivoFuente = Archivo::where('src_archivo',$rutaFuente)->whereIn('visible',[3,4])->get();
                 $archivoObsoleto = Archivo::where('src_archivo',$rutaObsoleto)->whereIn('visible',[3,4])->get();
                 $archivoDerogado = Archivo::where('src_archivo',$rutaDerogado)->whereIn('visible',[3,4])->get();
                array_push($archivoSoloY,$normal);
            }
       }
        

        return view('usuario/categoria',array('user'=> $user, 'categoria'=>$categoria, 'categorias'=>$categorias, 'subcategoria'=>$subcategoria, 'sub'=>$sub, 'archivos'=>$archivos,'fuentes'=>$archivoFuente,'obsoletos'=>$archivoObsoleto,'derogados'=>$archivoDerogado,'archivosYo'=>$archivoSoloY));

    })->name("usuario.categoria");
     

    /*==================
      PRIMER INICIO
    ==================*/
    Route::post('/primer-inicio', function (Request $request) {

        $usuario = Usuario::find($request->id);

        if($usuario){

            $usuario->nombre = $request->nombre; 

            $usuario->apellidoPaterno = $request->apellidoPaterno;

            $usuario->apellidoMaterno = $request->apellidoMaterno;

            $usuario->correo = $request->correo;

            $usuario->password = bcrypt($request->password);

            $usuario->tipo = $request->tipo;

            $usuario->estatus = $request->estatus;

            $usuario->codigo = $request->codigo;

            $usuario->save();

            return response()->json(["estado" => true]);

        }else{

            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }
    });

    Route::post('/agregar-categoria', function(Request $request){
                
        
        //try{

            $verificacion = Categoria::where('nombre',$request->nombre)->first();
            
            
            if(!$verificacion){
                
                $categoria = new Categoria();
                
                $util = new Utilidades();

                $categoria->nombre = $request->nombre;

                $categoria->carpeta = $util->crearSlug($request->nombre);

                $categoria->posicion = $request->posicion;
                
                $categoria->save(); 

                $crearCarpetaCategoria = mkdir("archivos/".$util->crearSlug($request->nombre), 0700, true);

                if($crearCarpetaCategoria){
                    if (!file_exists("archivos/".$util->crearSlug($request->nombre)."/archivos-fuente")){

                        $crearCarpetaArchivosFuente = mkdir("archivos/".$util->crearSlug($request->nombre)."/archivos-fuente", 0700, true);  
                    }else {
                         return response()->json(["estado" => false, "mensaje"=>"Carpeta existente"]);
                    }
                    if (!file_exists("archivos/".$util->crearSlug($request->nombre)."/obsoletos")){
                        $crearCarpetaobsoletos = mkdir("archivos/".$util->crearSlug($request->nombre)."/obsoletos", 0700, true);
                    } else {
                         return response()->json(["estado" => false, "mensaje"=>"Carpeta existente"]);
                    }
                    if (!file_exists("archivos/".$util->crearSlug($request->nombre)."/derogados")){
                        $crearCarpetaderogados = mkdir("archivos/".$util->crearSlug($request->nombre)."/derogados", 0700, true);
                    } else {
                        return response()->json(["estado" => false, "mensaje"=>"Carpeta existente"]);
                    }

                }else {
                    return response()->json(["estado" => false, "mensaje"=>"Carpeta con nombre existente"]);
                    $categoria->delete();
                }

                return response()->json(["estado" => true, "mensaje"=>"Se agrego correctamente"]);
              
            }else{

                return response()->json(["estado" => false, "mensaje"=>"Categoria con nombre existente"]);
            }
            

        //}catch(Exception $ex){

            //return response()->json(["estado" => false, "detalle" => $ex->getMessage()]);
        //}
    });

    Route::post('/edicion-categoria', function(Request $request){
        try {
            $util = new Utilidades();
            $categoria = Categoria::find($request->id); 
            
            $archivo = Archivo::where('categoriaId',$categoria->id)->get();
           
            // $archivoUrl = Archivo::where('categoriaId',$categoria->id)->first();
            $categoriaAnterior = "archivos/".$categoria->carpeta;

            $categoriaNueva = "archivos/".$util->crearSlug($request->nombre);

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
            rename($categoriaAnterior, $categoriaNueva);
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

    Route::post('/agregar-subcategoria', function (Request $request) {

        try{
            $subcategoria = new SubCategoria();
            
            $util = new Utilidades();
            
            $subcategoria->nombre = $request->nombre;
            
            $subcategoria->categoriaId= $request->categoriaId;
            
            $subcategoria->save();

            $buscarCategoria = Categoria::find($request->categoriaId);

            $crearCarpetaCategoria = mkdir("archivos/".$util->crearSlug($buscarCategoria->nombre)."/".$util->crearSlug($request->nombre),0700,true);

            return response()->json(["estado" => true, "mensaje"=>"Se agrego subcategoria"]);
                
        }catch(Exception $ex){

            return response()->json(["estado" => false, "detalle" => $ex]);
        }
    });
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


    Route::post('/agregar-archivo', function (Request $request) {

        try{
            $archivo = new Archivo();

            $util = new Utilidades();

            $file = $_FILES['archivo']['name'][0];

            $info = pathinfo($file);

            $nombre = $request->nombreArchivo;

            $verificacion = Archivo::where('nombre',$request->nombre)->first();

            if(!$verificacion){

                $archivo->nombre = $request->nombre;
                
                $archivo->tipo= $request->tipo;
                
                $archivo->usuarioId= $request->usuarioId;
                
                $archivo->categoriaId= $request->categoriaId;
                
                $archivo->subCategoriaId= $request->subCategoriaId;
                
                $archivo->carpeta= $util->crearSlug($request->nombre);
                
                $archivo->ubicacion= $request->ubicacion;
                
                $archivo->visible= $request->visible;
                
                $archivo->save();

                $categoria = Categoria::find($request->categoriaId);
                $subcategoria = Subcategoria::find($request->subcategoriaId);

                $ruta = "archivos/".$util->crearSlug($categoria->nombre)."/".$util->crearSlug($subcategoria->nombre)."/";
            
                if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta.$util->crearSlug($request->nombre) . "." . $info['extension'])) {
                }else {
                    return response()->json(["estado" => false, "mensaje"=>"No se pudo guardar archivo"]);
                }      
          
            return response()->json(["estado" => true, "mensaje"=>"Se agrego Archivo"]);     

            }else{
                return response()->json(["estado" => false, "detalle" =>"Ya existe un archivo similar" ]);
            }
           
        }catch(Exception $ex){

            return response()->json(["estado" => false, "detalle" => $ex]);
        }
    });
    
    Route::post('/editar-archivo', function (Request $request) {

        try{
           $util = new Utilidades();
           $archivo = Archivo::find($request->id);
           $sesionUsuario = Usuario::find(Session::get('usuario')->id);
           
           $subcategoria = Subcategoria::find($request->subcategoriaId);
           $categoria = Categoria::find($request->categoriaId);
           $extension = explode(".", $archivo->slug);
           $rutaNueva = "archivos/".$categoria->carpeta."/".$util->crearSlug($subcategoria->nombre)."/";
           $cambioSlug = $util->crearSlug($request->nombre).".".$extension[1];

           rename($archivo->src_archivo.$archivo->slug,$rutaNueva.$cambioSlug);
           
         if ($archivo) {
            $archivo->nombre = $request->nombre;
            $archivo->tipo = $request->tipo;
            $archivo->categoriaId = $request->categoriaId;
            $archivo->visible = $request->visible;
            $archivo->usuarioId = $sesionUsuario->id;
            $archivo->carpeta = null;
            $archivo->n_subcategoria = $subcategoria->nombre;
            $archivo->slug = $util->crearSlug($request->nombre).".".$extension[1];
            $archivo->src_archivo = $rutaNueva;
            $archivo->save();
         }

            return response()->json(["estado" => true, "mensaje"=>"Se edito el archivo"]);
                
        }catch(Exception $ex){

            return response()->json(["estado" => false, "detalle" => $ex]);
        }
    });
    Route::get('/eliminar-archivo/{id}', function (Request $request,$id) {

        if($request->ajaX()){
           
            $archivo = Archivo::find($id);
            if ($archivo && unlink($archivo->src_archivo.$archivo->slug)) {

                $archivo->delete();
            }
          
           return response()->json(["estado" => true]);       
        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }
                   
    });
    Route::post('/agregar-archivo', function (Request $request) { 
        try{
            $extensionDisponible = array("docx","doc","xls","xlsx","ppt","pptx","pdf","PDF");
            $util = new Utilidades();
            $subcategoria = Subcategoria::find($request->subcategoriaId);
            $categoria = Categoria::find($subcategoria->categoriaId);
            $usuario = Usuario::find(Session::get('usuario')->id);
            $slug = $util->crearSlug($request->nombre);
            $ruta = "archivos/".$categoria->carpeta."/".$util->crearSlug($subcategoria->nombre)."/";
            $file = $_FILES['entradaArchivo']['name'][0];
            $info = pathinfo($file);
            if (!(in_array($info['extension'], $extensionDisponible))) {
                return response()->json(["estado" => false, "detalle" => "Asegurate de que el archivo tenga extension .doc .docx ppt. pptx. .xls .xlsx"]);
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
            $movimientoUser = new MovimientoUsuario();
            $movimientoUser->movimiento = "Archivo Agregado";
            $movimientoUser->informe = "Se agrego archivo con el nombre ".$request->nombre." y con extension .".$info['extension']." por el usuario ".$usuario->nombre;
            $movimientoUser->save();
            }else{
                return response()->json(["estado" => false, "detalle" => "Verifica que los campos no esten vacios"]);
            }
            
            return response()->json(["estado" => true, "mensaje"=>"Se agrego archivo"]);

        }catch(Exception $ex){

            return response()->json(["estado" => false, "detalle" => $ex]);
        }
    });
    Route::post('/edicion-subcategoria', function (Request $request) { 
        try{
            $util = new Utilidades();
            $usuario = Usuario::find(Session::get('usuario')->id);

            $subcategoria = Subcategoria::find($request->id);
            $editarArchivo = Subcategoria::find($request->id);
            $categoria = Categoria::find($subcategoria->categoriaId);
            
            $rutaAnterior = "archivos/".$categoria->carpeta."/".$util->crearSlug($subcategoria->nombre);
            $rutaNueva = "archivos/".$categoria->carpeta."/".$util->crearSlug($request->nombre);
            
            $archivo = Archivo::where('n_subcategoria',$editarArchivo->nombre)->get();
            $movimientoUser = new MovimientoUsuario();
            $movimientoUser->movimiento = "Subcategoria Edicion";
            $movimientoUser->informe = "Subcategoria ".$subcategoria->nombre." editada por ".$usuario->nombre;
            $movimientoUser->save();
          if ($archivo) {
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
          }
           
              rename($rutaAnterior, $rutaNueva);
            
            
            if ($subcategoria) {
               $subcategoria->nombre = $request->nombre;
               $subcategoria->categoriaId = $categoria->id;
               $subcategoria = $subcategoria->save();
            }
           
            
            return response()->json(["estado" => true, "mensaje"=>"Se edito subcategoria"]);

        }catch(Exception $ex){

            return response()->json(["estado" => false, "detalle" => $ex]);
        }
    });
    Route::get('/eliminar-subcategoria/{id}/{idCat}', function (Request $request,$id,$idCat) {

        if($request->ajaX()){
          $util = new Utilidades();
          $usuario = Usuario::find(Session::get('usuario')->id);
          $subcategoria = Subcategoria::find($id);
          $categoria = Categoria::find($idCat);
          $archivo = Archivo::where('n_subcategoria',$subcategoria->nombre)->get();
          foreach ($archivo as $archivos) {
                $archivos->delete();
          }
            eliminaCarpeta('archivos/'.$categoria->carpeta."/".$util->crearSlug($subcategoria->nombre)."/");
            $subcategoria->delete();
            $movimientoUser = new MovimientoUsuario();
            $movimientoUser->movimiento = "Subcategoria Eliminada";
            $movimientoUser->informe = "La Subcategoria  ".$subcategoria->nombre." fue eliminada por Usuario ".$usuario->nombre;
            $movimientoUser->save();

             return response()->json(["estado" => true, "mensaje"=>"Se elimino la subcategoria"]);

        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }
                   
    });
    Route::get('/eliminar-mover/{id}', function (Request $request,$id) {

        if($request->ajaX()){
           
            $archivo = Archivo::find($id);
            if ($archivo->carpeta == 3) {
                $movimientoUser = new MovimientoUsuario();
                $movimientoUser->movimiento = "Archivo eliminado";
                $movimientoUser->informe = "Archivo con nombre ".$archivo->nombre." eliminado de carpeta Archivos Fuente";
                $movimientoUser->save();
            }
            if ($archivo->carpeta == 2) {
                $movimientoUser = new MovimientoUsuario();
                $movimientoUser->movimiento = "Archivo eliminado";
                $movimientoUser->informe = "Archivo con nombre ".$archivo->nombre." eliminado de carpeta Obsoletos";
                $movimientoUser->save();
            }
            if ($archivo->carpeta == 1) {
                $movimientoUser = new MovimientoUsuario();
                $movimientoUser->movimiento = "Archivo eliminado";
                $movimientoUser->informe = "Archivo con nombre ".$archivo->nombre." eliminado de carpeta Derogados";
                $movimientoUser->save();
            }
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
    Route::post('/movimiento-archivo', function (Request $request) { 

        try{
           $util = new Utilidades();
           $archivo = Archivo::find($request->id);
           $categoria = Categoria::find($archivo->categoriaId);
           $usuario = Usuario::find(Session::get('usuario')->id);
          

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

                        $movimientoUser = new MovimientoUsuario();
                        $movimientoUser->movimiento = "Archivo movido a carpeta";
                        $movimientoUser->informe = "Archivo  ".$archivo->nombre." movido a Derogados por Usuario ".$usuario->nombre;
                        $movimientoUser->save();
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
                        $movimientoUser = new MovimientoUsuario();
                        $movimientoUser->movimiento = "Archivo movido a carpeta";
                        $movimientoUser->informe = "Archivo  ".$archivo->nombre." movido a Obsoletos por Usuario ".$usuario->nombre;
                        $movimientoUser->save();
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
                        $movimientoUser = new MovimientoUsuario();
                        $movimientoUser->movimiento = "Archivo movido a carpeta";
                        $movimientoUser->informe = "Archivo  ".$archivo->nombre." movido a Ruta Fuente por Usuario ".$usuario->nombre;
                        $movimientoUser->save();
                   }else{
                      return response()->json(["estado" => false, "detalle" => "No se pudo mover a la carpeta Archivos Fuente"]);
                   }
                }
                
            return response()->json(["estado" => true, "mensaje"=>"Se Movio Archivo"]);
                
        }catch(Exception $ex){

            return response()->json(["estado" => false, "detalle" => $ex]);
        }
    });
    Route::get('/eliminar-categoria/{id}', function (Request $request,$id) {

        if($request->ajaX()){

            $util = new Utilidades();
            $usuario = Usuario::find(Session::get('usuario')->id);
            $categoria = Categoria::find($id);
            $archivo = Archivo::where('categoriaId',$categoria->id)->get();
            $subcategoria = Subcategoria::where('categoriaId', $categoria->id)->get();

            $movimientoUser = new MovimientoUsuario();
            $movimientoUser->movimiento = "Categoria Eliminada";
            $movimientoUser->informe = "Categoria ".$categoria->nombre." eliminada por ".$usuario->nombre;
            $movimientoUser->save();
            
                if ($archivo) {
                    foreach ($archivo as $archivos) {
                   $archivos->delete();
                       
                    }   
                }
                 if ($subcategoria) {
                     foreach ($subcategoria as $subcategorias) {
                         $subcategorias->delete();      
                    }
                         $categoria->delete();
                 }  
         eliminaCarpeta("archivos/".$categoria->carpeta."/archivos-fuente/");
         eliminaCarpeta("archivos/".$categoria->carpeta."/derogados/");
         eliminaCarpeta("archivos/".$categoria->carpeta."/obsoletos/");
         eliminaCarpeta("archivos/".$categoria->carpeta."/");
           
            

           return response()->json(["estado" => true]); 
        }else{
            return response()->json(["estado" => false, "detalle" => "incorrecto"]);
        }     
    }); 

});

function eliminaCarpeta($path) {
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