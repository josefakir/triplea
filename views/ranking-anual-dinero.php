<?php include('header.php');
    use Mainclass\Models\Booking;
    use Mainclass\Models\Usuario;
    use Illuminate\Database\Capsule\Manager as Capsule;
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
                        <div class="card-header">Reportes: 
                            <form action="<?php echo BASE_URL ?>ranking-anual-cantidad" method="GET">
                            <select name="anio" id="" style="margin-left:10px" onchange="this.form.submit()">
                            <option value="2020" <?php if($_GET['anio']==2020){ echo ' selected '; } ?>>2020</option>
                            <option value="2021" <?php if($_GET['anio']==2021){ echo ' selected '; } ?>>2021</option>
                            <option value="2022" <?php if($_GET['anio']==2022){ echo ' selected '; } ?>>2022</option>
                            </select>
                            
                            </form>
                            <br>
                            <form action="excel" method="POST">
                                <input type="hidden" name="html_tabla" id="hidden_tabla">
                                <button style="margin-left:10px"><img src="<?php echo BASE_URL ?>views/assets/images/descargar-excel.png" alt="" style="width: 72px;margin-left: 10px;"></button>
                            </form>
                        </div>  
                        <div class="table-responsive">
                            <table id="table" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Talento</th>
                                    <th>Cantidad de $</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tbody>
                                        <?php 
                                            $anio = $_GET['anio'];
                                            $luchadores = Capsule::select("select usuarios.id , usuarios.personaje , sum(bookings.precio) as 'conteo' from usuarios left join bookings on usuarios.id = bookings.id_usuario where (fecha >= '$anio-01-01' and fecha <= '$anio-12-31') group by usuarios.id order by conteo DESC;");
                                            foreach($luchadores as $l){
                                                ?>
                                                <tr>
                                                    <td><?php echo $l->id ?></td>
                                                    <td><?php echo $l->personaje ?></td>
                                                    <td><?php echo $l->conteo ?></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="chart_div"></div>
                            <script>
                            google.charts.load('current', {packages: ['corechart', 'bar']});
                            google.charts.setOnLoadCallback(drawMultSeries);

                            function drawMultSeries() {
                                var options = {
                                    title: 'Rerpote luchadores',
                                    chartArea: {width: '50%'},
                                    hAxis: {
                                        title: 'Talento',
                                        minValue: 0
                                    },
                                    vAxis: {
                                        title: 'Cantidad'
                                    }
                                };
                                var data = google.visualization.arrayToDataTable([
                                    ['Talento', 'Cantidad'],
                                    <?php 
                                        foreach($luchadores as $l){
                                            ?>
                                    ['<?php echo $l->personaje ?>', <?php echo $l->conteo ?>],            // RGB value
                                            <?php
                                        }
                                    ?>
                                ]);

                                var chart = new google.visualization.ColumnChart(
                                document.getElementById('chart_div'));

                                chart.draw(data,options);
                                }
                            </script>
                            <!--<div class="d-block text-center card-footer">
                                <a href="<?php echo BASE_URL ?>agregar-booking" class="btn-wide btn btn-success">Descargar a Excel</a>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>
<script>
    $(document).ready(function(){
        $('#hidden_tabla').val($('#table').parent().html());
    })
</script>