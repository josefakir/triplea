<?php 
    include('header.php');
    use Mainclass\Models\Booking; 
    $booking = new Booking();
    $booking = $booking->find($args['id']);
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
                        <div><h1>Aprobar o rechazar booking</h1></div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-12">
                    <p>Solicita: <strong><?php echo traducirUsuario($booking->id_solicitante) ?></strong></p>
                    <p>Talento: <strong><?php echo traducirUsuario($booking->id_usuario) ?></strong></p>
                    <p>Tipo de evento: <strong><?php echo traducirTipo($booking->id_tipo) ?></strong></p>
                    <p>Indumentaria: <strong><?php echo traducirIndumentaria($booking->id_indumentaria) ?></strong></p>
                    <p>Fecha: <strong><?php echo $booking->fecha ?></strong></p>
                    <p>Comentarios: <strong><?php echo $booking->comentarios ?></strong></p>
                    <p>&nbsp;</p>
                    <p>
                        <a class="btn btn-primary btn-sm btn-success" href="<?php echo BASE_URL ?>aprobar-booking/<?php echo $args[id] ?>" onclick="return confirm('¿Está seguro de querer aprobar?');">Aprobar</a> 
                        <a class="btn btn-primary btn-sm btn-danger" href="<?php echo BASE_URL ?>rechazar-booking/<?php echo $args[id] ?>" onclick="return confirm('¿Está seguro de querer rechazar?');">Rechazar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>