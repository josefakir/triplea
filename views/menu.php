<?php 
    use Mainclass\Models\Rol; 
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $actual_link = explode("?", $actual_link);
    $actual_link = $actual_link[0];

?>
<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <?php 
                $rol = new Rol();
                $rol = $rol->find($_SESSION['rol']);
            ?>

            <?php 
                if($rol->permiso_dashboard==true){
                    ?>
            <li><a href="<?php echo BASE_URL ?>inicio" class="<?php if (strpos($actual_link, 'inicio') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-display1"></i>Dashboard</a></li>
                    <?php
                }
            ?>
            <?php 
                if($rol->permiso_roles==true){
                    ?>
            <li><a href="<?php echo BASE_URL ?>roles"  class="<?php if (strpos($actual_link, 'roles') || strpos($actual_link, 'agregar-rol') || strpos($actual_link, 'editar-rol') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-tools"></i>Roles</a></li>
                    <?php
                }
            ?>
            <?php 
                if($rol->permiso_indumentaria==true){
                    ?>
            <li><a href="<?php echo BASE_URL ?>indumentarias"  class="<?php if (strpos($actual_link, 'indumentarias') || strpos($actual_link, 'agregar-indumentaria') || strpos($actual_link, 'editar-indumentaria') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-scissors"></i>Tipos de indumentaria</a></li>
                    <?php
                }
            ?>
            <?php 
                if($rol->permiso_usuarios==true){
                    ?>
            <li><a href="<?php echo BASE_URL ?>usuarios"  class="<?php if (strpos($actual_link, 'usuarios') || strpos($actual_link, 'agregar-usuario') || strpos($actual_link, 'editar-usuario') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-user"></i>Usuarios</a></li>
                    <?php
                }
            ?>
            <?php 
                if($rol->permiso_bookings_editar==true or $rol->permiso_bookings_aprobar==true){
                    ?>
            <li><a href="<?php echo BASE_URL ?>bookings"  class="<?php if (strpos($actual_link, 'bookings') || strpos($actual_link, 'agregar-booking') || strpos($actual_link, 'editar-booking') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-gleam"></i>Bookings</a></li>
                    <?php
                }
            ?>
            <?php 
                if($rol->permiso_reportes==true){
                    ?>
            <li><a href="<?php echo BASE_URL ?>reportes"  class="<?php if (strpos($actual_link, 'reportes') || strpos($actual_link, 'reporte-anual') || strpos($actual_link, 'reporte-por-mes') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-graph2"></i>Reportes</a></li>
                    <?php
                }
            ?>
        </ul>
    </div>
</div>