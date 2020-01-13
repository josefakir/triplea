<?php
	require "vendor/autoload.php";
	include "bootstrap.php";
	include "defines.php";
	include "functions.php";

	use Mainclass\Models\Usuario;
	use Mainclass\Models\Booking;
	use Mainclass\Models\Tipo;
	use Mainclass\Models\Rol;

	use Mainclass\Middleware\Logging as Logging;
	use Mainclass\Middleware\Redirectlogin as Redirectlogin;

	$app = new \Slim\App();
	$app->add(new Logging());
	session_start();

	$app->get("/",function($request, $response, $args){
		include("views/login.php");
	})->add(new Redirectlogin());

	$app->get("/logout",function($request, $response, $args){
		session_destroy();
		return $response->withHeader('Location', BASE_URL.'' );
		
	});

	$app->post("/login",function($request, $response, $args){
		$email = $request->getParsedBodyParam('email');
		$pass = md5($request->getParsedBodyParam('password'));
		$user = new Usuario();
		$users = $user::where('correo', $email)->where('contrasena', $pass)->where('status',1)->get();
			if($users->count()>0){
				$_SESSION['auth'] = true;
				$_SESSION['id_usuario'] = $users[0]->id;
				$_SESSION['nombre'] = $users[0]->nombre;
				$_SESSION['rol'] = $users[0]->rol;
				$_SESSION['apikey'] = $users[0]->apikey;
				$avatar = $users[0]->avatar;
				if(empty($avatar)){
					$_SESSION['avatar'] = BASE_URL."assets/img/default.jpg";
				}else{
					$_SESSION['avatar'] = $users[0]->avatar;
				}
				return $response->withHeader('Location', BASE_URL.'/inicio' );
		}else{
			return $response->withHeader('Location', BASE_URL."?m=".base64_encode('Usuario o contraseña incorrectos') );
		}
	});

	$app->get("/inicio",function($request, $response, $args){
		include("views/inicio.php");
	});


	$app->get("/usuarios",function($request, $response, $args){
		include("views/usuarios.php");
	});

	$app->get("/agregar-usuario",function($request, $response, $args){
		include("views/agregar-usuario.php");
	});

	$app->get("/editar-usuario/{id}",function($request, $response, $args){
		include("views/editar-usuario.php");
	});

	$app->post("/insert/usuario",function($request, $response, $args){
		$correo = $request->getParsedBodyParam('correo');
		$password = md5($request->getParsedBodyParam('password'));
		$nombre = $request->getParsedBodyParam('nombre');
		$rol = $request->getParsedBodyParam('rol');
		$apikey = md5(date('Ymdhsi').$contrasena);


		$uploadedFiles = $request->getUploadedFiles();
	    $uploadedFile = $uploadedFiles['avatar'];
	    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
			$directory = "assets/img";
			$filename = date('Ymdhsi').$uploadedFile->getClientFilename();
			$uploadedFile->moveTo($directory ."/". $filename);
			$avatar = BASE_URL.$directory."/".$filename;

			$im = imagecreatefromjpeg($avatar);
			ob_start();
			imagejpeg(cropAlign($im, 250, 250, 'center', 'middle'));
  			imagedestroy( $im );
  			$i = ob_get_clean();
  			file_put_contents($directory ."/". $filename, $i);
			
	    }
		$usuario = new Usuario();
		$usuario->correo = $correo;
		$usuario->contrasena = $password;
		$usuario->nombre = $nombre;
		$usuario->rol = $rol;
		$usuario->apikey = $apikey;
		$usuario->status = 1;
		if(!empty($avatar)){
			$usuario->avatar = $avatar;
		}
		try {
			$usuario->save();
			return $response->withHeader('Location', BASE_URL."usuarios?m=".base64_encode('Usuario agregado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});

	$app->post("/update/usuario",function($request, $response, $args){
		$id = $request->getParsedBodyParam('id');
		$correo = $request->getParsedBodyParam('correo');
		$password = $request->getParsedBodyParam('password');
		$nombre = $request->getParsedBodyParam('nombre');
		$rol = $request->getParsedBodyParam('rol');
		$contrasena = md5($password);
		$apikey = md5(date('Ymdhsi').$contrasena);



		$usuario = new Usuario();
		$usuario = $usuario->find($id);


		$uploadedFiles = $request->getUploadedFiles();
		if(!empty($uploadedFiles)){
		    $uploadedFile = $uploadedFiles['avatar'];
		    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
				$directory = "assets/img";
				$filename = date('Ymdhsi').$uploadedFile->getClientFilename();
				$uploadedFile->moveTo($directory ."/". $filename);
				$avatar = BASE_URL.$directory."/".$filename;

				$im = imagecreatefromjpeg($avatar);
				ob_start();
				imagejpeg(cropAlign($im, 250, 250, 'center', 'middle'));
	  			imagedestroy( $im );
	  			$i = ob_get_clean();
	  			file_put_contents($directory ."/". $filename, $i);
				
		    }
	    }

		$usuario->correo = $correo;
		$usuario->contrasena = $password;
		$usuario->nombre = $nombre;
		$usuario->rol = $rol;
		$usuario->apikey = $apikey;
		$usuario->status = 1;
		if(!empty($avatar)){
			$usuario->avatar = $avatar;
		}

		$usuario->correo = $correo;
		if(!empty($password)){
			$usuario->contrasena = $contrasena;
		}
		$usuario->nombre = $nombre;
		$usuario->rol = $rol;
		try {
			$usuario->save();
			return $response->withHeader('Location', BASE_URL."usuarios?m=".base64_encode('Usuario modificado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});

	$app->get("/delete/usuario/{id}",function($request, $response, $args){
		$usuario = new Usuario();
		$usuario = $usuario->find($args['id']);
		try {
			$usuario->delete();
			return $response->withHeader('Location', BASE_URL."usuarios?m=".base64_encode('Usuario eliminado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});
	
	$app->get("/roles",function($request, $response, $args){
		include("views/roles.php");
	});
	$app->get("/agregar-rol",function($request, $response, $args){
		include("views/agregar-rol.php");
	});
	$app->post("/insert/rol",function($request, $response, $args){
		$rol = $request->getParsedBodyParam('rol');
		$rols = new Rol();
		$rols->nombre = $rol;
		$rols->status = "1";
		try {
			$rols->save();
			return $response->withHeader('Location', BASE_URL."roles?m=".base64_encode('Rol agregado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});
	$app->get("/delete/rol/{id}",function($request, $response, $args){
		$rol = new Rol();
		$rol = $rol->find($args['id']);
		$rol->status = 0;
		try {
			$rol->save();
			return $response->withHeader('Location', BASE_URL."roles?m=".base64_encode('Rol eliminado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});

	$app->get("/editar-rol/{id}",function($request, $response, $args){
		include("views/editar-rol.php");
	});

	$app->post("/update/rol",function($request, $response, $args){
		$id = $request->getParsedBodyParam('id');
		$nombre = $request->getParsedBodyParam('rol');

		$rol = new Rol();
		$rol = $rol->find($id);
		$rol->nombre = $nombre;
		try {
			$rol->save();
			return $response->withHeader('Location', BASE_URL."roles?m=".base64_encode('Rol modificado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});

	$app->get("/tipos",function($request, $response, $args){
		include("views/tipos.php");
	});
	$app->get("/agregar-tipo",function($request, $response, $args){
		include("views/agregar-tipo.php");
	});

	$app->post("/insert/tipo",function($request, $response, $args){
		$tipo = $request->getParsedBodyParam('tipo');
		$tipos = new Tipo();
		$tipos->nombre = $tipo;
		$tipos->status = "1";
		try {
			$tipos->save();
			return $response->withHeader('Location', BASE_URL."tipos?m=".base64_encode('Tipo de evento agregado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});

	$app->get("/editar-tipo/{id}",function($request, $response, $args){
		include("views/editar-tipo.php");
	});

	$app->get("/delete/tipo/{id}",function($request, $response, $args){
		$rol = new Tipo();
		$rol = $rol->find($args['id']);
		$rol->status = 0;
		try {
			$rol->save();
			return $response->withHeader('Location', BASE_URL."tipos?m=".base64_encode('Rol eliminado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});

	$app->post("/update/tipo",function($request, $response, $args){
		$id = $request->getParsedBodyParam('id');
		$nombre = $request->getParsedBodyParam('rol');

		$rol = new Tipo();
		$rol = $rol->find($id);
		$rol->nombre = $nombre;
		try {
			$rol->save();
			return $response->withHeader('Location', BASE_URL."tipos?m=".base64_encode('Rol modificado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});
/* 

	


	

	


*/


	$app->get("/bookings",function($request, $response, $args){
		include("views/bookings.php");
	});

	$app->get("/agregar-booking",function($request, $response, $args){
		include("views/agregar-booking.php");
	});

	$app->run();
