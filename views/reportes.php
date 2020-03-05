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
                        <div class="card-header">Reportes:</div>
                        <!--<div class="p10">
                            <div id='calendar'></div>
                        </div>-->

  
                        <div class="table-responsive">
                           
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Reporte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tbody>
                                    <tr><td><a href="<?php echo BASE_URL ?>reporte-anual">Reporte anual</a></td></tr>
                                    <tr><td><a href="<?php echo BASE_URL ?>reporte-mensual">Reporte mensual</a></td></tr>
                                    <tr><td><a href="<?php echo BASE_URL ?>ranking-anual">Ranking luchadores anual</a></td></tr>
                                    <tr><td><a href="<?php echo BASE_URL ?>ranking-mensual">Ranking luchadores mensual</a></td></tr>
                                    <tr><td><a href="<?php echo BASE_URL ?>reporte-usuarios">Usuarios en el sistema</a></td></tr>
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