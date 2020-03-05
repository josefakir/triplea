<?php 
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $actual_link = explode("?", $actual_link);
    $actual_link = $actual_link[0];

?>
<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Administración</li>
            <li><a href="<?php echo BASE_URL ?>inicio" class="<?php if (strpos($actual_link, 'inicio') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-display1"></i>Dashboard</a></li>
            <li><a href="<?php echo BASE_URL ?>roles"  class="<?php if (strpos($actual_link, 'roles') || strpos($actual_link, 'agregar-rol') || strpos($actual_link, 'editar-rol') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-tools"></i>Roles</a></li>
            <!--<li><a href="<?php echo BASE_URL ?>tipos"  class="<?php if (strpos($actual_link, 'tipos') || strpos($actual_link, 'agregar-tipo') || strpos($actual_link, 'editar-tipo') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-ticket"></i>Tipos de evento</a></li>-->
            <li><a href="<?php echo BASE_URL ?>indumentarias"  class="<?php if (strpos($actual_link, 'indumentarias') || strpos($actual_link, 'agregar-indumentaria') || strpos($actual_link, 'editar-indumentaria') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-scissors"></i>Tipos de indumentaria</a></li>
            <li><a href="<?php echo BASE_URL ?>usuarios"  class="<?php if (strpos($actual_link, 'usuarios') || strpos($actual_link, 'agregar-usuario') || strpos($actual_link, 'editar-usuario') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-user"></i>Usuarios</a></li>
            <li><a href="<?php echo BASE_URL ?>bookings"  class="<?php if (strpos($actual_link, 'bookings') || strpos($actual_link, 'agregar-booking') || strpos($actual_link, 'editar-booking') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-gleam"></i>Bookings</a></li>
            <li><a href="<?php echo BASE_URL ?>reportes"  class="<?php if (strpos($actual_link, 'reportes') || strpos($actual_link, 'reporte-anual') || strpos($actual_link, 'reporte-por-mes') ){echo "mm-active";} ?>"><i class="metismenu-icon pe-7s-graph2"></i>Reportes</a></li>
        </ul>
    </div>
</div>