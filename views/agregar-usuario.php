<?php 
    include('header.php');
    use Mainclass\Models\Rol; 
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
                            <label for="">Correo electrónico</label>
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
                                <label for="">$ oficina</label>
                                <small>(Cantidad que se le paga por una runión en la oficina)</small>
                                <input type="number" class="form-control" name="oficina" >
                            </div>
                            <div class="form-group">
                                <label for="">$ house</label>
                                <small>(Cantidad que se le paga por un house show)</small>
                                <input type="number" class="form-control" name="house" >
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

