<?php include('header.php');
    use Mainclass\Models\Evento;
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
                        <div class="card-header">Eventos:</div>
                        <!--<div class="p10">
                            <div id='calendar'></div>
                        </div>-->

  
                        <div class="table-responsive">
                            <?php 
                            $evento = new Evento();
                            $evento = $evento->where('status',1)->get();
                            ?>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nombre</th>
                                        <th class="text-center">Cancelar</th>
                                        <th class="text-center">Archivar</th>
                                        <!--<th class="text-center">Eliminar</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($evento as $r) {
                                        ?>
                                        <tr>
                                        <td class="text-center text-muted"><?php echo $r->id ?></td>
                                        <td class="text-muted"><?php echo $r->nombre ?></td>
                                        <!--<td class="text-center">
                                            <a href="<?php echo BASE_URL ?>editar-evento/<?php echo $r->id ?>" class="btn btn-primary btn-sm">Editar</a>
                                        </td>-->
                                        <td class="text-center">
                                            <a onclick="return confirm('¿Está seguro de querer cancelar el evento (Se eliminarán todos los booking asociados a este evento)?');" href="<?php echo BASE_URL ?>cancel/evento/<?php echo $r->id ?>" class="btn btn-danger btn-sm">Cancelar Evento</a>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                $date_now = new DateTime();
                                                $date2    = new DateTime($r->fecha);
                                                if ($date_now > $date2) {
                                                    echo 'Aún no se puede archivar';
                                                }else{
                                                    ?>
                                            <a onclick="return confirm('¿Está seguro de querer archivar (Se ocultará de esta lista, pero su información seguirá disponible)?');" href="<?php echo BASE_URL ?>archive/evento/<?php echo $r->id ?>" class="btn btn-danger btn-sm">Archivar Evento</a>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>