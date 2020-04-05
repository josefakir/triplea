<?php 
    include('header.php');
    use Mainclass\Models\Usuario; 
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
                        <div><h1>Editar usuario</h1></div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        $usuario = new Usuario();
                        $usuario = $usuario->find($args['id']);
                        //print_r($usuario);
                    ?>
                    <form method="post" action="<?php echo BASE_URL ?>update/usuario" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nombre de usuario</label>
                            <input type="text" class="form-control" name="usuario" required readonly value="<?php echo $usuario->usuario ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Correo</label>
                            <input type="text" class="form-control" name="correo" required value="<?php echo $usuario->correo ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="password" class="form-control" name="password">
                            <small>Deje en blanco para no modificar</small>
                        </div>
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required value="<?php echo $usuario->nombre ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Paterno</label>
                            <input type="text" class="form-control" name="paterno" required value="<?php echo $usuario->paterno ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Materno</label>
                            <input type="text" class="form-control" name="materno" required value="<?php echo $usuario->materno ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Avatar</label>
                            <input type="file" class="form-control" name="avatar">
                            <img src="<?php echo $usuario->avatar; ?>" alt="" style="width:50px; padding:10px">
                        </div>
                        <div class="form-group">
                            <label for="">Rol</label>
                            <select name="rol" id="rol_usuario" class="form-control" required>
                                <option value="">Seleccione</option>
                                <?php 
                                    $rol = new Rol();
                                    $rol = $rol->all();
                                    foreach ($rol as $r) {
                                        ?>
                                <option value="<?php echo $r->id ?>" <?php if($usuario->rol==$r->id){ echo " selected "; } ?>><?php echo $r->nombre ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div id="solotalento" style="display:block !important">
							<div class="form-group">
								<label for="">Personaje</label>
								<input type="text" class="form-control" name="personaje" value="<?php echo $usuario->personaje ?>">
							</div>
							<div class="form-group">
								<label for="">$ Show TV</label>
								<small>(Cantidad que se le paga por un show de tv)</small>
								<input type="number" class="form-control" name="tv" value="<?php echo $usuario->tv ?>" >
							</div>
							<div class="form-group">
								<label for="">$ Firma</label>
								<small>(Cantidad que se le paga por una firma de autógrafos)</small>
								<input type="number" class="form-control" name="firma"  value="<?php echo $usuario->firma ?>">
							</div>
							<div class="form-group">
								<label for="">$ Privado</label>
								<small>(Cantidad que se le paga por un show privado)</small>
								<input type="number" class="form-control" name="privado" value="<?php echo $usuario->privado ?>" >
							</div>
							<div class="form-group">
								<label for="">$ Prensa</label>
								<small>(Cantidad que se le paga por un evento de prensa)</small>
								<input type="number" class="form-control" name="prensa"  value="<?php echo $usuario->prensa ?>">
							</div>
							<div class="form-group">
								<label for="">$ oficina</label>
								<small>(Cantidad que se le paga por una runión en la oficina)</small>
								<input type="number" class="form-control" name="oficina" value="<?php echo $usuario->oficina ?>" >
							</div>
							<div class="form-group">
								<label for="">$ house</label>
								<small>(Cantidad que se le paga por un house show)</small>
								<input type="number" class="form-control" name="house"  value="<?php echo $usuario->house ?>">
							</div>
							<div class="form-group">
								<label for="">Género</label>
								<select name="genero" id="" class="form-control">
									<option value="">-Seleccione-</option>
									<option value="H" <?php if($usuario->genero=='H'){ echo " selected "; } ?>>Hombre</option>
									<option value="M" <?php if($usuario->genero=='M'){ echo " selected "; } ?>>Mujer</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Licencia</label>
								<input type="text" class="form-control" name="licencia" value="<?php echo $usuario->licencia ?>"  >
							</div>
							<div class="form-group">
								<label for="">Fecha de nacimiento</label>
								<input type="text" class="form-control datepicker2" name="fecha_nacimiento"  value="<?php echo $usuario->fecha_nacimiento ?>" >
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
									<option value="<?php echo $p->id ?>" <?php if($p->id==$usuario->id_nacionalidad){ echo " selected "; } ?> ><?php echo $p->nombre ?></option>
											<?php
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="">Celular</label>
								<input type="text" class="form-control" name="celular"  value="<?php echo $usuario->celular ?>">
							</div>
							<div class="form-group">
								<label for="">RFC</label>
								<input type="text" class="form-control" name="rfc"  value="<?php echo $usuario->rfc ?>">
							</div>
							<div class="form-group">
								<label for="">Dirección</label>
								<input type="text" class="form-control" name="direccion"  value="<?php echo $usuario->direccion ?>">
							</div>
							<div class="form-group">
								<label for="">INE</label>
								<input type="text" class="form-control" name="ine" value="<?php echo $usuario->ine ?>" >
							</div>
							<div class="form-group">
								<label for="">Pasaporte</label>
								<input type="text" class="form-control" name="pasaporte" value="<?php echo $usuario->pasaporte ?>" >
							</div>
							<div class="form-group">
								<label for="">Vigencia de pasaporte</label>
								<input type="text" class="form-control datepicker2" name="vigencia_pasaporte"  value="<?php echo $usuario->vigencia_pasaporte ?>" >
							</div>
							<div class="form-group">
								<label for="">Visa</label>
								<input type="text" class="form-control" name="visa"  value="<?php echo $usuario->visa ?>">
							</div>
							<div class="form-group">
								<label for="">Vigencia visa</label>
								<input type="text" class="form-control datepicker2" name="vigencia_visa"  value="<?php echo $usuario->vigencia_visa ?>">
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
									<option value="<?php echo $p->id ?>" <?php if($p->id==$usuario->id_banco){ echo " selected "; } ?> ><?php echo $p->nombre ?></option>
											<?php
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for=""># Cuenta</label>
								<input type="text" class="form-control" name="cuenta"  value="<?php echo $usuario->cuenta ?>">
							</div>
							<div class="form-group">
								<label for=""># CLABE</label>
								<input type="text" class="form-control" name="clabe" value="<?php echo $usuario->clabe ?>" >
							</div>
							<div class="form-group">
								<label for="">Sucursal</label>
								<input type="text" class="form-control" name="sucursal" value="<?php echo $usuario->sucursal ?>" >
							</div>
							<div class="form-group">
								<label for="">Talla playera</label>
								<select name="talla_playera" id="" class="form-control">
									<option value="">-Seleccione-</option>
									<option value="ch" <?php if($usuario->talla_playera=='ch'){ echo " selected "; } ?>>Chica</option>
									<option value="m" <?php if($usuario->talla_playera=='m'){ echo " selected "; } ?>>Mediana</option>
									<option value="g" <?php if($usuario->talla_playera=='g'){ echo " selected "; } ?>>Grande</option>
									<option value="xg" <?php if($usuario->talla_playera=='xg'){ echo " selected "; } ?>>X Grande</option>
									<option value="xxg" <?php if($usuario->talla_playera=='xxg'){ echo " selected "; } ?>>XX Grande</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Talla Pants</label>
								<select name="talla_pants" id="" class="form-control">
                                <option value="">-Seleccione-</option>
									<option value="ch" <?php if($usuario->talla_pants=='ch'){ echo " selected "; } ?>>Chica</option>
									<option value="m" <?php if($usuario->talla_pants=='m'){ echo " selected "; } ?>>Mediana</option>
									<option value="g" <?php if($usuario->talla_pants=='g'){ echo " selected "; } ?>>Grande</option>
									<option value="xg" <?php if($usuario->talla_pants=='xg'){ echo " selected "; } ?>>X Grande</option>
									<option value="xxg" <?php if($usuario->talla_pants=='xxg'){ echo " selected "; } ?>>XX Grande</option>
								</select>
							</div>
						</div>
                        <input type="hidden" name="id" value="<?php echo $args['id'] ?>">
                        <button class="btn btn-warning">Editar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php") ?>
<script>
    $(document).ready(function(){
        $('#rol_usuario').trigger('change');
    })
</script>