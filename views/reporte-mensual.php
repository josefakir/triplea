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
                        <div class="card-header">Reportes: 
                            <form action="<?php echo BASE_URL ?>reporte-mensual" method="GET">
                            <select name="anio" id="" style="margin-left:10px" onchange="this.form.submit()">
                            <option value="2020" <?php if($_GET['anio']==2020){ echo ' selected '; } ?>>2020</option>
                            <option value="2021" <?php if($_GET['anio']==2021){ echo ' selected '; } ?>>2021</option>
                            <option value="2022" <?php if($_GET['anio']==2022){ echo ' selected '; } ?>>2022</option>
                            </select>
                            <select name="mes" id="" onchange="this.form.submit()">
                                <?php 
                                    for($i=1;$i<13;$i++){
                                        ?>
                                        <option value="<?php echo $i ?>" <?php if($_GET['mes']==$i){ echo ' selected '; } ?>><?php echo traducirMes($i) ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
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
                                    <th>INT</th>
                                    <th>Total de eventos</th>
                                    <th>$ total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tbody>
                                        <?php 
                                            $anio = $_GET['anio'];
                                            $mes = $_GET['mes'];
                                            $usuario = new Usuario();
                                            $usuario = $usuario->where('rol',3)->orderBy('personaje','ASC')->get();
                                            foreach ($usuario as $u) {
                                                $total = 0;
                                                $costo_total = 0;
                                                ?>
                                                <tr>
                                                    <td><?php echo $u->id ?></td>
                                                    <td><?php echo $u->personaje ?></td>
                                                    <td>
                                                        <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$anio.'-'.$mes.'-01')->where('fecha','<=',$anio.'-'.$mes.'-31')->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',1)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$anio.'-'.$mes.'-01')->where('fecha','<=',$anio.'-'.$mes.'-31')->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',2)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$anio.'-'.$mes.'-01')->where('fecha','<=',$anio.'-'.$mes.'-31')->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',3)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$anio.'-'.$mes.'-01')->where('fecha','<=',$anio.'-'.$mes.'-31')->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',4)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$anio.'-'.$mes.'-01')->where('fecha','<=',$anio.'-'.$mes.'-31')->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',5)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$anio.'-'.$mes.'-01')->where('fecha','<=',$anio.'-'.$mes.'-31')->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',6)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td> 
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$anio.'-'.$mes.'-01')->where('fecha','<=',$anio.'-'.$mes.'-31')->where('id_usuario',$u->id)->where('status',1)->where('id_tipo',7)->get();
                                                            echo count($b);
                                                        ?>
                                                    </td> 
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$anio.'-'.$mes.'-01')->where('fecha','<=',$anio.'-'.$mes.'-31')->where('id_usuario',$u->id)->where('status',1)->get();
                                                            echo count($b)
                                                            
                                                    ?>
                                                    </td>  
                                                    <td>
                                                    <?php
                                                            $b = new Booking();
                                                            $b = $b->where('fecha','>=',$anio.'-'.$mes.'-01')->where('fecha','<=',$anio.'-'.$mes.'-31')->where('id_usuario',$u->id)->where('status',1)->get();
                                                            $money = 0;
                                                            foreach ($b as $m) {
                                                                if($m->recibo_honorarios==1){
                                                                    $money += retenciones($m->precio);
                                                                    $money += $m->ajuste;
                                                                }else{
                                                                    $money += $m->precio;
                                                                    $money += $m->ajuste;
                                                                }
                                                            }
                                                            echo '$'.number_format($money,2);
                                                    ?>
                                                    </td> 
                                                </tr>
                                                <?php
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