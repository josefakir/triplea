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
                    <div class="main-card mb-3 card">
                        <div class="card-header">Reportes:</div>
                        <!--<div class="p10">
                            <div id='calendar'></div>
                        </div>-->

  
                        <div class="table-responsive">
                           
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Talento</th>
                                    <th>Enero</th>
                                    <th>Febrero</th>
                                    <th>Marzo</th>
                                    <th>Abril</th>
                                    <th>Mayo</th>
                                    <th>Junio</th>
                                    <th>Julio</th>
                                    <th>Agosto</th>
                                    <th>Septiembre</th>
                                    <th>Octubre</th>
                                    <th>Noviembre</th>
                                    <th>Diciembre</th>
                                    <th>Total</th>
                                    <th>$</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tbody>
                                        <?php 
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
                                                            $enero = new Booking();
                                                            $enero = $enero->where('fecha','>=','2020-01-01')->where('fecha','<','2020-02-01')->where('id_usuario',$u->id)->where('status',1)->get();
                                                            $valoresenero = $enero[0];
                                                            $enero = count($valoresenero);
                                                            $costo = $valoresenero->precio;
                                                            echo $enero;
                                                            $total += $enero;
                                                            $costo_total += $costo;
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $febrero = new Booking();
                                                            $febrero = $febrero->where('fecha','>=','2020-02-01')->where('fecha','<','2020-03-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $febrero;
                                                            $total += $febrero;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $marzo = new Booking();
                                                            $marzo = $marzo->where('fecha','>=','2020-03-01')->where('fecha','<','2020-04-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $marzo;
                                                            $total += $marzo;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $abril = new Booking();
                                                            $abril = $abril->where('fecha','>=','2020-04-01')->where('fecha','<','2020-05-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $abril;
                                                            $total += $abril;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $mayo = new Booking();
                                                            $mayo = $mayo->where('fecha','>=','2020-05-01')->where('fecha','<','2020-06-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $mayo;
                                                            $total += $mayo;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $junio = new Booking();
                                                            $junio = $junio->where('fecha','>=','2020-06-01')->where('fecha','<','2020-07-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $junio;
                                                            $total += $junio;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $julio = new Booking();
                                                            $julio = $julio->where('fecha','>=','2020-07-01')->where('fecha','<','2020-08-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $julio;
                                                            $total += $julio;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $agosto = new Booking();
                                                            $agosto = $agosto->where('fecha','>=','2020-08-01')->where('fecha','<','2020-09-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $agosto;
                                                            $total += $agosto;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $septiembre = new Booking();
                                                            $septiembre = $septiembre->where('fecha','>=','2020-09-01')->where('fecha','<','2020-10-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $septiembre;
                                                            $total += $septiembre;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $octubre = new Booking();
                                                            $octubre = $octubre->where('fecha','>=','2020-10-01')->where('fecha','<','2020-11-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $octubre;
                                                            $total += $octubre;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $noviembre = new Booking();
                                                            $noviembre = $noviembre->where('fecha','>=','2020-11-01')->where('fecha','<','2020-12-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $noviembre;
                                                            $total += $noviembre;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $diciembre = new Booking();
                                                            $diciembre = $diciembre->where('fecha','>=','2020-12-01')->where('fecha','<','2021-01-01')->where('id_usuario',$u->id)->where('status',1)->count();
                                                            echo $diciembre;
                                                            $total += $diciembre;
                                                    ?>
                                                    </td>
                                                    <td><?php echo $total; ?></td>
                                                    <td><?php echo $costo_total; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-block text-center card-footer">
                                <a href="<?php echo BASE_URL ?>agregar-booking" class="btn-wide btn btn-success">Descargar a Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>