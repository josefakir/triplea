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
                        <div><h1>Editar Rol</h1></div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        $rol = new Rol();
                        $rol = $rol->find($args['id']);
                    ?>
                    <form method="post" action="<?php echo BASE_URL ?>update/rol">
                        <div class="form-group">
                            <label for="">Rol:</label>
                            <input class="form-control" type="text" required name="rol" value="<?php echo $rol->nombre ?>">
                            <input type="hidden" name="id" value="<?php echo $args['id'] ?>">
                        </div>


                        <div class="checkbox">
                            <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Activado" data-off="Desactivado" name="permiso_dashboard" value="1" <?php if($rol->permiso_dashboard==true){ echo 'checked'; } ?>>
                            <label class="custom-control-label">Dashboard</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Activado" data-off="Desactivado" name="permiso_usuarios" value="1" <?php if($rol->permiso_usuarios==true){ echo 'checked'; } ?>>
                            <label class="custom-control-label">Usuarios</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Activado" data-off="Desactivado" name="permiso_roles" value="1" <?php if($rol->permiso_roles==true){ echo 'checked'; } ?>>
                            <label class="custom-control-label">Roles</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Activado" data-off="Desactivado" name="permiso_indumentaria" value="1" <?php if($rol->permiso_indumentaria==true){ echo 'checked'; } ?>>
                            <label class="custom-control-label">Tipos de indumentaria</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Activado" data-off="Desactivado" name="permiso_bookings_aprobar" value="1" <?php if($rol->permiso_bookings_aprobar==true){ echo 'checked'; } ?>>
                            <label class="custom-control-label">Bookings Aprobar / Rechazar</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Activado" data-off="Desactivado" name="permiso_bookings_editar" value="1" <?php if($rol->permiso_bookings_editar==true){ echo 'checked'; } ?>>
                            <label class="custom-control-label">Bookings Editar / Eliminar</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Activado" data-off="Desactivado" name="permiso_reportes" value="1" <?php if($rol->permiso_reportes==true){ echo 'checked'; } ?>>
                            <label class="custom-control-label">Reportes</label>
                        </div>




                        
                        <br>
                        <button class="btn btn-success">Editar Rol</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>