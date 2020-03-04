<?php 
    include('header.php');
    use Mainclass\Models\Usuario; 
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
                            <label for="">Correo electrónico</label>
                            <input type="text" class="form-control" name="correo" required readonly value="<?php echo $usuario->correo ?>">
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
                            <label for="">Avatar</label>
                            <input type="file" class="form-control" name="avatar">
                        </div>
                        <div class="form-group">
                            <label for="">Rol</label>
                            <select name="rol" id="rol_usuario" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="1" <?php if($usuario->rol==1){ echo " selected "; } ?>>Administrdor</option>
                                <option value="2" <?php if($usuario->rol==2){ echo " selected "; } ?>>Editor</option>
                                <option value="3" <?php if($usuario->rol==3){ echo " selected "; } ?>>Talento (Luchador)</option>
                            </select>
                        </div>
                        <div id="solotalento">
                            <div class="form-group">
                                <label for="">$ Show TV</label>
                                <small>(Cantidad que se le paga por un show de tv)</small>
                                <input type="number" class="form-control" name="tv" value="<?php echo $usuario->tv ?>">
                            </div>
                            <div class="form-group">
                                <label for="">$ Firma</label>
                                <small>(Cantidad que se le paga por una firma de autógrafos)</small>
                                <input type="number" class="form-control" name="firma" value="<?php echo $usuario->firma ?>">
                            </div>
                            <div class="form-group">
                                <label for="">$ Privado</label>
                                <small>(Cantidad que se le paga por un show privado)</small>
                                <input type="number" class="form-control" name="privado" value="<?php echo $usuario->privado ?>">
                            </div>
                            <div class="form-group">
                                <label for="">$ oficina</label>
                                <small>(Cantidad que se le paga por una runión en la oficina)</small>
                                <input type="number" class="form-control" name="oficina" value="<?php echo $usuario->oficina ?>">
                            </div>
                            <div class="form-group">
                                <label for="">$ house</label>
                                <small>(Cantidad que se le paga por un house show)</small>
                                <input type="number" class="form-control" name="house" value="<?php echo $usuario->house ?>">
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