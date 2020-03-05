<?php
	require "vendor/autoload.php";
	include "bootstrap.php";
	include "defines.php";
	include "functions.php";

	use Mainclass\Models\Usuario;
	use Mainclass\Models\Booking;
	use Mainclass\Models\Tipo;
	use Mainclass\Models\Rol;
	use Mainclass\Models\Indumentaria;

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

		$tv = $request->getParsedBodyParam('tv');
		$firma = $request->getParsedBodyParam('firma');
		$privado = $request->getParsedBodyParam('privado');
		$prensa = $request->getParsedBodyParam('prensa');
		$oficina = $request->getParsedBodyParam('oficina');
		$house = $request->getParsedBodyParam('house');


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
		$usuario->tv = $tv;
		$usuario->firma = $firma;
		$usuario->privado = $privado;
		$usuario->prensa = $prensa;
		$usuario->oficina = $oficina;
		$usuario->house = $house;

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

		$tv = $request->getParsedBodyParam('tv');
		$firma = $request->getParsedBodyParam('firma');
		$privado = $request->getParsedBodyParam('privado');
		$prensa = $request->getParsedBodyParam('prensa');
		$oficina = $request->getParsedBodyParam('oficina');
		$house = $request->getParsedBodyParam('house');

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

		$usuario->tv = $tv;
		$usuario->firma = $firma;
		$usuario->privado = $privado;
		$usuario->prensa = $prensa;
		$usuario->oficina = $oficina;
		$usuario->house = $house;
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


	$app->get("/bookings",function($request, $response, $args){
		include("views/bookings.php");
	});

	$app->get("/agregar-booking",function($request, $response, $args){
		include("views/agregar-booking.php");
	});

	$app->post("/insert/booking",function($request, $response, $args){
		$id_usuario = $request->getParsedBodyParam('id_usuario');
		$id_tipo = $request->getParsedBodyParam('id_tipo');

		$usuario = new Usuario();
		$usuario = $usuario->find($id_usuario);

		switch ($id_tipo) {
			case '1':
				$tipo_evento = 'tv';
			break;
			case '2':
				$tipo_evento = 'firma';
			break;
			case '3':
				$tipo_evento = 'privado';
			break;
			case '4':
				$tipo_evento = 'prensa';
			break;
			case '6':
				$tipo_evento = 'oficina';
			break;
			case '7':
				$tipo_evento = 'house';
			break;
		}
		$precio = $usuario->{$tipo_evento};	
		
		$fecha = $request->getParsedBodyParam('fecha')." ".$request->getParsedBodyParam('hora').":00";
		$id_indumentaria = $request->getParsedBodyParam('id_indumentaria');
		$comentarios = $request->getParsedBodyParam('comentarios');
		$id_solicitante = $_SESSION['id_usuario'];
		$status  = 0;

		$booking = new Booking();
		$booking = $booking->where('id_usuario',$id_usuario)->where('fecha',$fecha)->where('status','<>',1)->get();
		$count = count($booking);

		if($count==0){
			$booking = new Booking();
			$booking->id_usuario = $id_usuario;
			$booking->id_tipo = $id_tipo;
			$booking->fecha = $fecha;
			$booking->id_indumentaria = $id_indumentaria;
			$booking->comentarios = $comentarios;
			$booking->id_solicitante = $id_solicitante;
			$booking->status = $status;
			$booking->precio = $precio;
			try {
				$booking->save();

				//Administradores;
				$admins = new Usuario();
				$admins = $admins->where('rol',1)->get();
				foreach ($admins as $a) {
					// Enviar correos a los administradores (que pueden aprobar las solicitudes //Gonzalo)
					$html = "
						<!DOCTYPE html>
						<html lang='en'>
						<head>
							<meta charset='UTF-8'>
							<title>Document</title>
						</head>
						<body>
							<p style='text-align: center;'>
								<img src='".BASE_URL."assets/img/logo.png' alt='' style='width: 80px'>
							</p>
							<p style='font-family: arial'>Has recibido una solicitud de talento:</p>
							<p>Solicita: <strong>".traducirUsuario($id_solicitante)."</strong></p>
							<p>Talento: <strong>".traducirUsuario($id_usuario)."</strong></p>
							<p>Tipo de evento: <strong>".traducirTipo($id_tipo)."</strong></p>
							<p>Indumentaria: <strong>".traducirIndumentaria($id_indumentaria)."</strong></p>
							<p>Fecha: <strong>".$fecha."</strong></p>
							<p>Comentarios: <strong>".$comentarios."</strong></p>
							<p>&nbsp;</p>
							<p>Para aprobar o rechazar la solicitud haga click <a href='".BASE_URL."operacion-solicitud/".$booking->id."'>aquí</a></p>
						</body>
						</html>

					";
					enviarCorreo($a->id, "Se ha creado una nueva solicitud - Intranet AAA" ,$html);
				}
				return $response->withHeader('Location', BASE_URL."bookings?m=".base64_encode('Solicituda agregada correctamente'));
			} catch (Exception $e) {
				print_r($e);
			}
		}else{
			return $response->withHeader('Location', BASE_URL."bookings?m=".base64_encode('Ya hay una solicitud aprobada para ese talento en esa fecha y hora') );
		}
		/* 
			LEYENDA DE STATUS :
			0 = Solicitado
			1 = Aprobado
			2 = Rechazado
		*/
	});
	
	$app->get("/operacion-solicitud/{id}",function($request, $response, $args){
		include("views/operacion-solicitud.php");
	});

	$app->get("/delete/booking/{id}",function($request, $response, $args){
		$booking = new Booking();
		$booking = $booking->find($args['id']);
		$booking->status = 4;
		try {
			$booking->save();
			return $response->withHeader('Location', BASE_URL."bookings?m=".base64_encode('Solicitud eliminada correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});

	$app->get("/editar-booking/{id}",function($request, $response, $args){
		include("views/editar-booking.php");
	});

	$app->get("/aprobar-booking/{id}",function($request, $response, $args){
		$booking = new Booking();
		$booking = $booking->find($args['id']);
		$booking->status = 1;
		try {
			$booking->save();
			return $response->withHeader('Location', BASE_URL."bookings?m=".base64_encode('Solicitud aprobada correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});
	$app->get("/rechazar-booking/{id}",function($request, $response, $args){
		$booking = new Booking();
		$booking = $booking->find($args['id']);
		$booking->status = 2;
		try {
			$booking->save();
			return $response->withHeader('Location', BASE_URL."bookings?m=".base64_encode('Solicitud rechazada correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});



	$app->get("/indumentarias",function($request, $response, $args){
		include("views/indumentarias.php");
	});
	$app->get("/agregar-indumentaria",function($request, $response, $args){
		include("views/agregar-indumentaria.php");
	});
	$app->post("/insert/indumentaria",function($request, $response, $args){
		$nombre = $request->getParsedBodyParam('indumentaria');
		$indumentaria = new Indumentaria();
		$indumentaria->nombre = $nombre;
		$indumentaria->status = "1";
		try {
			$indumentaria->save();
			return $response->withHeader('Location', BASE_URL."indumentarias?m=".base64_encode('Indumentaria agregada correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});
	$app->get("/delete/indumentaria/{id}",function($request, $response, $args){
		$indumentaria = new Indumentaria();
		$indumentaria = $indumentaria->find($args['id']);
		$indumentaria->status = 0;
		try {
			$indumentaria->save();
			return $response->withHeader('Location', BASE_URL."indumentarias?m=".base64_encode('Indumentaria eliminada correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});

	$app->get("/editar-indumentaria/{id}",function($request, $response, $args){
		include("views/editar-indumentaria.php");
	});

	$app->post("/update/indumentaria",function($request, $response, $args){
		$id = $request->getParsedBodyParam('id');
		$nombre = $request->getParsedBodyParam('rol');

		$rol = new Indumentaria();
		$rol = $rol->find($id);
		$rol->nombre = $nombre;
		try {
			$rol->save();
			return $response->withHeader('Location', BASE_URL."indumentarias?m=".base64_encode('Indumentaria modificada correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	});

	$app->get("/todos-los-eventos",function($request, $response, $args){
		$start = $_GET['start'];
		$start = explode("T",$start);
		$start =  $start[0];
		$end = $_GET['end'];
		$end = explode("T",$end);
		$end =  $end[0];
		$booking = new Booking();
		$booking = $booking->where('fecha','>=',$start)->where('fecha','<=',$end)->get();
		$return = array();
		foreach ($booking as $b) {
			$talento = traducirUsuario($b->id_usuario);
			$indumentaria = traducirIndumentaria($b->id_indumentaria);
			$r = array(
				'title' => $talento." ".$indumentaria,
				'start' => $b->fecha
			);
			array_push($return,$r);
		}
		return $response->withStatus(200)->withJson($return);
	});

	$app->get("/reportes",function($request, $response, $args){
		include("views/reportes.php");
	});
	$app->get("/reporte-anual",function($request, $response, $args){
		include("views/reporte-anual.php");
	});

	$app->run();
