<?php 
	include('header.php');
	use Mainclass\Models\Rol; 
	use Mainclass\Models\Pais; 
	use Mainclass\Models\Banco; 
?>
<div class="app-main">
	<div class="app-sidebar sidebar-shadow">
		<div class="app-header__logo">
			<div class="logo-src"></div>
			<div class="header__pane ml-auto">
				<div>
					<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>
			</div>
		</div>
		<div class="app-header__mobile-menu">
			<div>
				<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
		<div class="app-header__menu">
			<span>
				<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
					<span class="btn-icon-wrapper">
						<i class="fa fa-ellipsis-v fa-w-6"></i>
					</span>
				</button>
			</span>
		</div>
		<?php include("menu.php"); ?>
	</div>
	<div class="app-main__outer">
		<div class="app-main__inner">
			<div class="app-page-title">
				<div class="page-title-wrapper">
					<div class="page-title-heading">
						<div><h1>Agregar usuario</h1></div>
					</div>
				</div>
			</div>            


			<div class="row">
				<div class="col-md-12">
					<form method="post" action="<?php echo BASE_URL ?>insert/usuario" enctype="multipart/form-data">
						<div class="form-group">
							<label for="">Nombre de usuario</label>
							<input type="text" class="form-control" name="usuario" required>
						</div>
						<div class="form-group">
							<label for="">Correo</label>
							<input type="text" class="form-control" name="correo" required>
						</div>
						<div class="form-group">
							<label for="">Contraseña</label>
							<input type="password" class="form-control" name="password" required>
						</div>
						<div class="form-group">
							<label for="">Nombre</label>
							<input type="text" class="form-control" name="nombre" required>
						</div>
						<div class="form-group">
							<label for="">Paterno</label>
							<input type="text" class="form-control" name="paterno" required>
						</div>
						<div class="form-group">
							<label for="">Materno</label>
							<input type="text" class="form-control" name="materno" required>
						</div>
						<div class="form-group">
								<label for="">Avatar</label>
								<input type="file" class="form-control" name="avatar">
							</div>
						<div class="form-group">
							<label for="">Rol</label>
							<select name="rol" id="rol_usuario" class="form-control" required>
								<option value="">Seleccione</option>
								<?php 
									$rol = new Rol();
									$rol = $rol->where('status',1)->get();
									foreach ($rol as $r) {
									?>
								<option value="<?php echo $r->id ?>"><?php echo $r->nombre ?></option>
									<?php
									}
								?>
							</select>
						</div>
						<div id="solotalento">
							<div class="form-group">
								<label for="">Personaje</label>
								<input type="text" class="form-control" name="personaje" >
							</div>
							<div class="form-group">
								<label for="">$ Show TV</label>
								<small>(Cantidad que se le paga por un show de tv)</small>
								<input type="number" class="form-control" name="tv" >
							</div>
							<div class="form-group">
								<label for="">$ Firma</label>
								<small>(Cantidad que se le paga por una firma de autógrafos)</small>
								<input type="number" class="form-control" name="firma" >
							</div>
							<div class="form-group">
								<label for="">$ Privado</label>
								<small>(Cantidad que se le paga por un show privado)</small>
								<input type="number" class="form-control" name="privado" >
							</div>
							<div class="form-group">
								<label for="">$ Prensa</label>
								<small>(Cantidad que se le paga por un evento de prensa)</small>
								<input type="number" class="form-control" name="prensa" >
							</div>
							<div class="form-group">
								<label for="">$ oficina</label>
								<small>(Cantidad que se le paga por una runión en la oficina)</small>
								<input type="number" class="form-control" name="oficina" >
							</div>
							<div class="form-group">
								<label for="">$ house</label>
								<small>(Cantidad que se le paga por un house show)</small>
								<input type="number" class="form-control" name="house" >
							</div>
							<div class="form-group">
								<label for="">Género</label>
								<select name="genero" id="" class="form-control">
									<option value="">-Seleccione-</option>
									<option value="H">Hombre</option>
									<option value="M">Mujer</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Licencia</label>
								<input type="text" class="form-control" name="licencia" >
							</div>
							<div class="form-group">
								<label for="">Fecha de nacimiento</label>
								<input type="text" class="form-control datepicker2" name="fecha_nacimiento" >
							</div>
							<div class="form-group">
								<label for="">Nacionalidad</label>
								<select name="id_nacionalidad" id="" class="form-control">
									<option value="">-Seleccione-</option>
									<?php 
										$pais = new Pais();
										$pais = $pais->all();
										foreach($pais as $p){
											?>
									<option value="<?php echo $p->id ?>" <?php if($p->id==146){ echo " selected "; } ?> ><?php echo $p->nombre ?></option>
											<?php
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="">Celular</label>
								<input type="text" class="form-control" name="celular" >
							</div>
							<div class="form-group">
								<label for="">RFC</label>
								<input type="text" class="form-control" name="rfc" >
							</div>
							<div class="form-group">
								<label for="">Dirección</label>
								<input type="text" class="form-control" name="direccion" >
							</div>
							<div class="form-group">
								<label for="">INE</label>
								<input type="text" class="form-control" name="ine" >
							</div>
							<div class="form-group">
								<label for="">Pasaporte</label>
								<input type="text" class="form-control" name="pasaporte" >
							</div>
							<div class="form-group">
								<label for="">Vigencia de pasaporte</label>
								<input type="text" class="form-control datepicker2" name="vigencia_pasaporte" >
							</div>
							<div class="form-group">
								<label for="">Visa</label>
								<input type="text" class="form-control" name="visa" >
							</div>
							<div class="form-group">
								<label for="">Vigencia visa</label>
								<input type="text" class="form-control datepicker2" name="vigencia_visa" >
							</div>
							<div class="form-group">
								<label for="">Banco</label>
								<select name="id_banco" id="" class="form-control">
									<option value="">-Seleccione-</option>
									<?php 
										$banco = new Banco();
										$banco = $banco->all();
										foreach($banco as $p){
											?>
									<option value="<?php echo $p->id ?>" <?php if($p->id==146){ echo " selected "; } ?> ><?php echo $p->nombre ?></option>
											<?php
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for=""># Cuenta</label>
								<input type="text" class="form-control" name="cuenta" >
							</div>
							<div class="form-group">
								<label for=""># CLABE</label>
								<input type="text" class="form-control" name="clabe" >
							</div>
							<div class="form-group">
								<label for="">Sucursal</label>
								<input type="text" class="form-control" name="sucursal" >
							</div>
							<div class="form-group">
								<label for="">Talla playera</label>
								<select name="talla_playera" id="" class="form-control">
									<option value="">-Seleccione-</option>
									<option value="ch">Chica</option>
									<option value="m">Mediana</option>
									<option value="g">Grande</option>
									<option value="xg">X Grande</option>
									<option value="xxg">XX Grande</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Talla Pants</label>
								<select name="talla_pants" id="" class="form-control">
									<option value="">-Seleccione-</option>
									<option value="ch">Chica</option>
									<option value="m">Mediana</option>
									<option value="g">Grande</option>
									<option value="xg">X Grande</option>
									<option value="xxg">XX Grande</option>
								</select>
							</div>
						</div>
						<button class="btn btn-success">Agregar Usuario</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php") ?>

