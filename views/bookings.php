<?php include('header.php');
    use Mainclass\Models\Booking;
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
                      

            
            <div class="row">
                <?php if(!empty($_GET['m'])){ ?>
                <div class="col-md-12">
                    <p class="mensaje btn-success" style="padding:5px"><?php echo base64_decode(htmlentities($_GET['m'])); ?></p>
                </div>
            <?php } ?>
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Solicitudes de booking:</div>
                        <!--<div class="p10">
                            <div id='calendar'></div>
                        </div>-->

  
                        <div class="table-responsive">
                            <?php 
                            $booking = new Booking();
                            $booking = $booking->where('status',0)->get();
                            ?>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Solicitante</th>
                                        <th>Talento</th>
                                        <th>Tipo de evento</th>
                                        <th>Fecha y Hora</th>
                                        <th>Indumentaria</th>
                                        <?php 
                                            if($_SESSION['rol']==1){
                                                ?>
                                                <th class="text-center">Aprobar</th>
                                                <th class="text-center">Rechazar</th>
                                                <?php 
                                            }
                                        ?>
                                        <th class="text-center">Editar</th>
                                        <th class="text-center">Eliminar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($booking as $r) {
                                        ?>
                                         <tr>
                                        <td class="text-center text-muted"><?php echo $r->id ?></td>
                                        <td class="text-muted"><?php echo traducirUsuario($r->id_solicitante) ?></td>
                                        <td class="text-muted"><?php echo traducirUsuario($r->id_usuario) ?></td>
                                        <td class="text-muted"><?php echo traducirTipo($r->id_tipo) ?></td>
                                        <td class="text-muted"><?php echo $r->fecha ?></td>
                                        <td class="text-muted"><?php echo traducirIndumentaria($r->id_indumentaria) ?></td>
                                        <?php 
                                            if($_SESSION['rol']==1){
                                                ?>
                                                <td class="text-center">
                                                    <a onclick="return confirm('¿Está seguro de querer aprobar?');" href="<?php echo BASE_URL ?>aprobar-booking/<?php echo $r->id ?>" class="btn btn-success btn-sm">Aprobar</a>
                                                </th>
                                                <td class="text-center">
                                                    <a onclick="return confirm('¿Está seguro de querer rechazar?');" href="<?php echo BASE_URL ?>rechazar-booking/<?php echo $r->id ?>" class="btn btn-danger btn-sm">Rechazar</a>
                                                </th>
                                                <?php 
                                            }
                                        ?>
                                        <td class="text-center">
                                            <a href="<?php echo BASE_URL ?>editar-booking/<?php echo $r->id ?>" class="btn btn-primary btn-sm">Editar</a>
                                        </td>
                                        <td class="text-center">
                                            <a onclick="return confirm('¿Está seguro de querer eliminar?');" href="<?php echo BASE_URL ?>delete/booking/<?php echo $r->id ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                        </td>
                                        
                                    </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-block text-center card-footer">
                                <a href="<?php echo BASE_URL ?>agregar-booking" class="btn-wide btn btn-success">Agregar Solicitud</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>