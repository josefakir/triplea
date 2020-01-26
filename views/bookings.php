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
                        <div class="p10">
                            <div id='calendar'></div>
                        </div>

  
                        <!--<div class="table-responsive">
                            <?php 
                            $booking = new Booking();
                            $booking = $booking->all();
                            ?>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nombre</th>
                                        <th class="text-center">Editar</th>
                                        <th class="text-center">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($booking as $b) {
                                        ?>
                                         <tr>
                                        <td class="text-center text-muted"><?php echo $b->id ?></td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img width="40" class="rounded-circle" src="<?php echo BASE_URL ?>views/assets/images/avatars/4.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading"><?php echo $u->nombre ?></div>
                                                        <div class="widget-subheading opacity-7"><?php echo $u->rol ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo BASE_URL ?>editar-usuario/<?php echo $u->id ?>" class="btn btn-primary btn-sm">Editar</a>
                                        </td>
                                        <td class="text-center">
                                            <a onclick="return confirm('¿Está seguro de querer eliminar?');" href="<?php echo BASE_URL ?>delete/usuario/<?php echo $u->id ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>
<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'dayGrid' ]
        });

        calendar.render();
      });

    </script>