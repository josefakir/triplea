<?php include('header.php');
    use Mainclass\Models\Booking;
    use Mainclass\Models\Usuario;
    
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
                <p>Leyenda: TV: Televisión, FA: Firma de autógrafos, EP: Evento privado, PR: Prensa, RO: Reunión en la oficina, HS: House show</p>
                    <div class="main-card mb-3 card">
                        
                        <div class="card-header">
                        <?php 
                            if(!empty($_GET['fecha_inicial']) and !empty($_GET['fecha_final']) ){
                                Reportes:
                            }else{
                                echo "Elija Fechas para el reporte";
                            }
                        ?>
                        
                            <form action="<?php echo BASE_URL ?>reporte-por-fecha" method="GET">
                            <input type="text" name="fecha_inicial" class="datepicker2 " autocomplete="off" style="margin-left:10px" placeholder="Fecha inicial"  onchange="this.form.submit()" value="<?php echo $_GET['fecha_inicial'] ?>">
                            <input type="text" name="fecha_final" class="datepicker2 " autocomplete="off" style="margin-left:10px" placeholder="Fecha inicial"  onchange="this.form.submit()" value="<?php echo $_GET['fecha_final'] ?>">
                            </form>
                            <br>
                            <form action="excel" method="POST">
                                <input type="hidden" name="html_tabla" id="hidden_tabla">
                                <button style="margin-left:10px"><img src="<?php echo BASE_URL ?>views/assets/images/descargar-excel.png" alt="" style="width: 72px;margin-left: 10px;"></button><br>

                            </form>
                           
                        </div>  
                        <div class="table-responsive">
                        
                            <table id="table" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                   
                                    <tr>
                                    <th>#</th>
                                    <th>Talento</th>
                                    <th>TV</th>
                                    <th>FA</th>
                                    <th>EP</th>
                                    <th>PR</th>
                                    <th>RO</th>
                                    <th>HS</th>
                                    <th>Total de eventos</th>
                                    <th>$ total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tbody>
                                        <?php 

                                        if(!empty($_GET['fecha_inicial']) and !empty($_GET['fecha_final']) ){
                                            $usuario = new Usuario();
                                            $usuario = $usuario->where('rol',3)->orderBy('nombre','ASC')->get();
                                            foreach ($usuario as $u) {
                                                $total = 0;
                                                $costo_total = 0;
                                                ?>
                                                <tr>
                                                    <td><?php echo $u->id ?></td>
                                                    <td><?php echo $u->nombre ?></td>
                                                    <td>
                                                        <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$_GET['fecha_inicial'])->where('fecha','<=',$_GET['fecha_final'])->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',1)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$_GET['fecha_inicial'])->where('fecha','<=',$_GET['fecha_final'])->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',2)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$_GET['fecha_inicial'])->where('fecha','<=',$_GET['fecha_final'])->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',3)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$_GET['fecha_inicial'])->where('fecha','<=',$_GET['fecha_final'])->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',4)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$_GET['fecha_inicial'])->where('fecha','<=',$_GET['fecha_final'])->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',5)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$_GET['fecha_inicial'])->where('fecha','<=',$_GET['fecha_final'])->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',6)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td> 
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$_GET['fecha_inicial'])->where('fecha','<=',$_GET['fecha_final'])->where('id_usuario',$u->id)->where('status',1)->get();
                                                            echo count($b)
                                                            
                                                    ?>
                                                    </td>  
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$_GET['fecha_inicial'])->where('fecha','<=',$_GET['fecha_final'])->where('id_usuario',$u->id)->where('status',1)->get();
                                                            $money = 0;
                                                            foreach ($b as $m) {
                                                                $money += $m->precio;
                                                            }
                                                            echo '$'.number_format($money,2);
                                                    ?>
                                                    </td>  
                                                  
                                                  
                                                </tr>
                                                <?php
                                            }
                                        }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
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