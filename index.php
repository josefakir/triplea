<?php
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true ");
        header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
        header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
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
	use Mainclass\Middleware\Authentication as Authentication;



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
				if(!empty($request->getParsedBodyParam('redirect'))){
					$redirect = ($request->getParsedBodyParam('redirect'));
					return $response->withHeader('Location', $redirect );
				}else{
					return $response->withHeader('Location', BASE_URL.'/inicio' );
				}
		}else{
			return $response->withHeader('Location', BASE_URL."?m=".base64_encode('Usuario o contraseña incorrectos') );
		}
	});

	$app->get("/inicio",function($request, $response, $args){
		include("views/inicio.php");
	})->add(new Authentication());


	$app->get("/usuarios",function($request, $response, $args){
		include("views/usuarios.php");
	})->add(new Authentication());

	$app->get("/agregar-usuario",function($request, $response, $args){
		include("views/agregar-usuario.php");
	})->add(new Authentication());

	$app->get("/editar-usuario/{id}",function($request, $response, $args){
		include("views/editar-usuario.php");
	})->add(new Authentication());

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
	})->add(new Authentication());

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
	})->add(new Authentication());

	$app->get("/delete/usuario/{id}",function($request, $response, $args){
		$usuario = new Usuario();
		$usuario = $usuario->find($args['id']);
		try {
			$usuario->delete();
			return $response->withHeader('Location', BASE_URL."usuarios?m=".base64_encode('Usuario eliminado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	})->add(new Authentication());
	
	$app->get("/roles",function($request, $response, $args){
		include("views/roles.php");
	})->add(new Authentication());
	$app->get("/agregar-rol",function($request, $response, $args){
		include("views/agregar-rol.php");
	})->add(new Authentication());
	$app->post("/insert/rol",function($request, $response, $args){
		
		$rol = $request->getParsedBodyParam('rol');
		$permiso_dashboard = $request->getParsedBodyParam('permiso_dashboard');
		if($permiso_dashboard==''){
			$permiso_dashboard = 0;
		}
		$permiso_usuarios = $request->getParsedBodyParam('permiso_usuarios');
		if($permiso_usuarios==''){
			$permiso_usuarios = 0;
		}
		$permiso_roles = $request->getParsedBodyParam('permiso_roles');
		if($permiso_roles==''){
			$permiso_roles = 0;
		}
		$permiso_indumentaria = $request->getParsedBodyParam('permiso_indumentaria');
		if($permiso_indumentaria==''){
			$permiso_indumentaria = 0;
		}
		$permiso_bookings_aprobar = $request->getParsedBodyParam('permiso_bookings_aprobar');
		if($permiso_bookings_aprobar==''){
			$permiso_bookings_aprobar = 0;
		}
		$permiso_bookings_editar = $request->getParsedBodyParam('permiso_bookings_editar');
		if($permiso_bookings_editar==''){
			$permiso_bookings_editar = 0;
		}
		$permiso_reportes = $request->getParsedBodyParam('permiso_reportes');
		if($permiso_reportes==''){
			$permiso_reportes = 0;
		}
		$rols = new Rol();
		$rols->nombre = $rol;
		$rols->status = "1";
		$rols->permiso_usuarios = $permiso_dashboard;
		$rols->permiso_usuarios = $permiso_usuarios;
		$rols->permiso_roles = $permiso_roles;
		$rols->permiso_indumentaria = $permiso_indumentaria;
		$rols->permiso_bookings_aprobar = $permiso_bookings_aprobar;
		$rols->permiso_bookings_editar = $permiso_bookings_editar;
		$rols->permiso_reportes = $permiso_reportes;
		try {
			$rols->save();
			return $response->withHeader('Location', BASE_URL."roles?m=".base64_encode('Rol agregado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	})->add(new Authentication());
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
	})->add(new Authentication());

	$app->get("/editar-rol/{id}",function($request, $response, $args){
		include("views/editar-rol.php");
	})->add(new Authentication());

	$app->post("/update/rol",function($request, $response, $args){
		$id = $request->getParsedBodyParam('id');
		$nombre = $request->getParsedBodyParam('rol');

		$permiso_dashboard = $request->getParsedBodyParam('permiso_dashboard');
		if($permiso_dashboard==''){
			$permiso_dashboard = 0;
		}
		$permiso_usuarios = $request->getParsedBodyParam('permiso_usuarios');
		if($permiso_usuarios==''){
			$permiso_usuarios = 0;
		}
		$permiso_roles = $request->getParsedBodyParam('permiso_roles');
		if($permiso_roles==''){
			$permiso_roles = 0;
		}
		$permiso_indumentaria = $request->getParsedBodyParam('permiso_indumentaria');
		if($permiso_indumentaria==''){
			$permiso_indumentaria = 0;
		}
		$permiso_bookings_aprobar = $request->getParsedBodyParam('permiso_bookings_aprobar');
		if($permiso_bookings_aprobar==''){
			$permiso_bookings_aprobar = 0;
		}
		$permiso_bookings_editar = $request->getParsedBodyParam('permiso_bookings_editar');
		if($permiso_bookings_editar==''){
			$permiso_bookings_editar = 0;
		}
		$permiso_reportes = $request->getParsedBodyParam('permiso_reportes');
		if($permiso_reportes==''){
			$permiso_reportes = 0;
		}


		$rol = new Rol();
		$rol = $rol->find($id);
		$rol->nombre = $nombre;

		$rol->permiso_dashboard = $permiso_dashboard;
		$rol->permiso_usuarios = $permiso_usuarios;
		$rol->permiso_roles = $permiso_roles;
		$rol->permiso_indumentaria = $permiso_indumentaria;
		$rol->permiso_bookings_aprobar = $permiso_bookings_aprobar;
		$rol->permiso_bookings_editar = $permiso_bookings_editar;
		$rol->permiso_reportes = $permiso_reportes;

		print_r($permiso_reportes."asdf");
		try {
			$rol->save();
			return $response->withHeader('Location', BASE_URL."roles?m=".base64_encode('Rol modificado correctamente') );
		} catch (Exception $e) {
			print_r($e);
		}
	})->add(new Authentication());

	$app->get("/tipos",function($request, $response, $args){
		include("views/tipos.php");
	})->add(new Authentication());
	$app->get("/agregar-tipo",function($request, $response, $args){
		include("views/agregar-tipo.php");
	})->add(new Authentication());

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
	})->add(new Authentication());

	$app->get("/editar-tipo/{id}",function($request, $response, $args){
		include("views/editar-tipo.php");
	})->add(new Authentication());

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
	})->add(new Authentication());

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
	})->add(new Authentication());


	$app->get("/bookings",function($request, $response, $args){
		include("views/bookings.php");
	})->add(new Authentication());

	$app->get("/agregar-booking",function($request, $response, $args){
		include("views/agregar-booking.php");
	})->add(new Authentication());

	$app->post("/insert/booking",function($request, $response, $args){
		/* 
			LEYENDA DE STATUS :
			0 = Solicitado
			1 = Aprobado
			2 = Rechazado
		*/

		try {
			$id_usuario = $request->getParsedBodyParam('id_usuario');
			$fecha = $request->getParsedBodyParam('fecha')." ".$request->getParsedBodyParam('hora').":00";

			$id_indumentaria = $request->getParsedBodyParam('id_indumentaria');
			$comentarios = $request->getParsedBodyParam('comentarios');
			$id_solicitante = $_SESSION['id_usuario'];
			$direccion = $request->getParsedBodyParam('direccion');
			$latlong = $request->getParsedBodyParam('latlong');
			$id_tipo = $request->getParsedBodyParam('id_tipo');
			$latlong =str_replace("(","",$latlong);
			$latlong =str_replace(")","",$latlong);
			$status  = 0;

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


			$html ="
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
				<p>Tipo de evento: <strong>".traducirTipo($id_tipo)."</strong></p>
				<p>Indumentaria: <strong>".traducirIndumentaria($id_indumentaria)."</strong></p>
				<p>Fecha: <strong>".$fecha."</strong></p>
				<p>Talento: </p>
				<ul>
			";


			foreach ($id_usuario as $i) {
				
				$usuario = new Usuario();
				$usuario = $usuario->find($i);
				$precio = $usuario->{$tipo_evento};	
				
				$html .= "
					<li>".traducirUsuario($i)."</li>
				";
				$booking = new Booking();
				$booking->id_usuario = $i;
				$booking->id_tipo = $id_tipo;
				$booking->fecha = $fecha;
				$booking->id_indumentaria = $id_indumentaria;
				$booking->comentarios = $comentarios;
				$booking->id_solicitante = $id_solicitante;
				$booking->status = $status;
				$booking->precio = $precio;
				$booking->direccion = $direccion;
				$booking->latlong = $latlong;

				$booking->save();
			}
			$html .= "
				</ul>
				<p>Comentarios: <strong>".$comentarios."</strong></p>
				<p>&nbsp;</p>
				<p>Para aprobar o rechazar la solicitud haga click <a href='".BASE_URL."bookings'>aquí</a></p>
			</body>
			</html>
			";
			enviarCorreo($a->id, "Se ha creado una nueva solicitud - Intranet AAA" ,$html);
			return $response->withHeader('Location', BASE_URL."bookings?m=".base64_encode('Solicituda agregada correctamente'));
		} catch (Exception $e) {
			return $response->withHeader('Location', BASE_URL."bookings?m=".base64_encode('Hubo un error') );
		}
	})->add(new Authentication());
	
	$app->get("/operacion-solicitud/{id}",function($request, $response, $args){
		include("views/operacion-solicitud.php");
	})->add(new Authentication());

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
	})->add(new Authentication());

	$app->get("/editar-booking/{id}",function($request, $response, $args){
		include("views/editar-booking.php");
	})->add(new Authentication());
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
	})->add(new Authentication());
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
	})->add(new Authentication());
	$app->get("/indumentarias",function($request, $response, $args){
		include("views/indumentarias.php");
	})->add(new Authentication());
	$app->get("/agregar-indumentaria",function($request, $response, $args){
		include("views/agregar-indumentaria.php");
	})->add(new Authentication());
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
	})->add(new Authentication());
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
	})->add(new Authentication());
	$app->get("/editar-indumentaria/{id}",function($request, $response, $args){
		include("views/editar-indumentaria.php");
	})->add(new Authentication());
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
	})->add(new Authentication());

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
	})->add(new Authentication());

	$app->get("/reportes",function($request, $response, $args){
		include("views/reportes.php");
	})->add(new Authentication());
	$app->get("/reporte-anual",function($request, $response, $args){
		include("views/reporte-anual.php");
	})->add(new Authentication());
	$app->get("/reporte-mensual",function($request, $response, $args){
		include("views/reporte-mensual.php");
	})->add(new Authentication());
	$app->get("/reporte-por-fecha",function($request, $response, $args){
		include("views/reporte-por-fecha.php");
	})->add(new Authentication());

	$app->get("/ranking-anual-cantidad",function($request, $response, $args){
		include("views/ranking-anual-cantidad.php");
	})->add(new Authentication());

	$app->get("/ranking-anual-dinero",function($request, $response, $args){
		include("views/ranking-anual-dinero.php");
	})->add(new Authentication());

	$app->post("/excel",function($request, $response, $args){
		$filename = "Reporte.xlsx";
		$table  = $request->getParsedBodyParam('html_tabla');

		// save $table inside temporary file that will be deleted later
		$tmpfile = tempnam(sys_get_temp_dir(), 'html');
		file_put_contents($tmpfile, $table);

		// insert $table into $objPHPExcel's Active Sheet through $excelHTMLReader
		$objPHPExcel     = new PHPExcel();
		$excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
		$excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
		$objPHPExcel->getActiveSheet()->setTitle('any name you want'); // Change sheet's title if you want

		unlink($tmpfile); // delete temporary file because it isn't needed anymore

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // header for .xlxs file
		header('Content-Disposition: attachment;filename='.$filename); // specify the download file name
		header('Cache-Control: max-age=0');

		// Creates a writer to output the $objPHPExcel's content
		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$writer->save('php://output');
		exit;
	})->add(new Authentication());


////// APP MOVIL API

	$app->post("/api/v1/login",function($request, $response, $args){
		$correo = $request->getHeader('correo')[0];
		$contrasena = md5($request->getHeader('contrasena')[0]);
		$user = new Usuario();
		$users = $user->where('correo', $correo)->where('contrasena', $contrasena)->where('status', 1)->get();
		if($users->count()>0){
			$payload = [];
			foreach($users as $u){
				$payload[] = ['auth' => true, 'apikey' => $u->apikey, 'user_id' => $u->id, 'nombre' => $u->nombre, 'correo' => $u->correo,'avatar' => $u->avatar];
			}
			return $response->withStatus(200)->withJson($payload);
		}else{
			$payload = array(
				'status' => 'error',
				'message' => 'Usuario o contraseña incorrectas'
			);
			return $response->withStatus(401)->withJson($payload);
		}
	});

	$app->get("/api/v1/eventos/{id_usuario}/{fecha}",function($request, $response, $args){
		$booking = new Booking();
		$booking = $booking->where('id_usuario','=',$args['id_usuario'])->where('fecha','>=',$args['fecha']." 00:00:00")->where('fecha','<=',$args['fecha']." 23:59:59")->where('status',1)->orderBy('fecha','ASC')->get();
		$return = array();
		foreach($booking as $b){
			$r = array(
				'id' => $b->id,
				'solicitante' => traducirUsuario($b->id_solicitante),
				'talento' => traducirUsuario($b->id_usuario),
				'indumentaria' => traducirIndumentaria($b->id_indumentaria),
				'fecha' => $b->fecha,
				'comentarios' => $b->comentarios,
				'direccion' => $b->direccion,
				'latlong' => $b->latlong,
				'evento' => traducirTipo($b->id_tipo)
			);
			array_push($return,$r);
		}
		


		return $response->withStatus(200)->withJson($return);
	});

	$app->get("/api/v1/disponibles/{fecha}/{hora}",function($request, $response, $args){
		$fecha = $args['fecha']." ".$args['hora'];
		$date1 = new \DateTime($fecha);
		$date1->modify('-1 hours');
		$formatted_date1 = $date1->format('Y-m-d H:i:s');

		$date2 = new \DateTime($fecha);
		$date2->modify('+2 hours');
		$formatted_date2 = $date2->format('Y-m-d H:i:s');

		$booking = new Booking();
		$booking = $booking->join('usuarios', 'usuarios.id', '=','bookings.id_usuario')->select('usuarios.id')->where('fecha','>=',$formatted_date1 )->where('fecha','<=',$formatted_date2 )->where('bookings.status',1 )->get();
		$notin = array();
		foreach ($booking as $b) {
			array_push($notin,$b->id);
		}
		$available = new Usuario();
		$available = $available->whereNotIn('id',$notin)->where('rol',3)->where('status',1)->orderBy('nombre', 'ASC')->get();
		$disponibles = array();
		$return = array();
		foreach ($available as $a) {
			$luchador = array(
				'id' => $a->id,
				'nombre' => $a->nombre
			);
			array_push($disponibles,$luchador);
		}
		array_push($return,array('disponibles' => $disponibles));


		$unavailable = new Usuario();
		$unavailable = $unavailable->whereIn('id',$notin)->where('rol',3)->where('status',1)->orderBy('nombre', 'ASC')->get();
		$nodisponibles = array();
		foreach ($unavailable as $a) {
			$luchador = array(
				'id' => $a->id,
				'nombre' => $a->nombre
			);
			array_push($nodisponibles,$luchador);
		}
		array_push($return,array('nodisponibles' => $nodisponibles));
		return $response->withStatus(200)->withJson($return);
	});

	$app->run();
