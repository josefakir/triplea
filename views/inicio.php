<?php include('header.php');
    use Mainclass\Models\Usuario;
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="padding">
                            <h2 class="tac text-warning">Solicitudes pendientes: 
                                <?php 
                                    $booking = new Booking(); 
                                    $booking = $booking->where('status',0)->get();
                                    $count = count($booking);
                                    echo $count;
                                ?>
                            </h2>
                            <p class="tac"><a href="<?php echo BASE_URL ?>bookings" class="btn btn-warning">Aprobar - Rechazar</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="padding">
                            <h2 class="tac text-success">Solicitudes aprobadas: 
                                <?php 
                                    $booking = new Booking(); 
                                    $booking = $booking->where('status',1)->get();
                                    $count = count($booking);
                                    echo $count;
                                ?>
                            </h2>
                           <p class="tac"><a class="btn btn-success">Ver solicitudes</a></p>
                        </div>
                    </div>
                </div>
               <div class="col-md-4">
                    <div class="card">
                            <div class="padding">
                                <h2 class="tac text-danger">Solicitudes rechazadas: 
                                    <?php 
                                            $booking = new Booking(); 
                                            $booking = $booking->where('status',2)->get();
                                            $count = count($booking);
                                            echo $count;
                                        ?>
                                </h2>
                                <p class="tac"><a class="btn btn-danger">Ver solicitudes</a></p>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-12">
                        <p>&nbsp;</p>
                        <div class="p10">
                            <div id='calendar'></div>
                        </div>
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
            /*
            events: [
    {
      title: 'Event Title1',
      start: '2020-03-03T13:13:55.008',
    },
    {
      title: 'Event Title2',
      start: '2015-03-17T13:13:55-0400',
      end: '2015-03-19T13:13:55-0400'
    }
  ],
  */
          plugins: [ 'dayGrid' ],
          eventSources: [

            // your event source
            {
            url: '<?php echo BASE_URL ?>todos-los-eventos', // use the `url` property
            textColor: 'white'  // an option!
            }

        ]
        });

        calendar.render();
      });

    </script>