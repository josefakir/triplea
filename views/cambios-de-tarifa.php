<?php include('header.php');
    use Mainclass\Models\Logprecio;
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
                        <div class="card-header">Cambios de tarifa:</div>
                        <!--<div class="p10">
                            <div id='calendar'></div>
                        </div>-->

  
                        <div class="table-responsive">
                            <?php 
                            $logprecio = new Logprecio();
                            $logprecio = $logprecio->all();
                            ?>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Usuario que modifica</th>
                                        <th>Luchador</th>
                                        <th>TV</th>
                                        <th>Firma</th>
                                        <th>Privado</th>
                                        <th>Prensa</th>
                                        <th>Oficina</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($logprecio as $r) {
                                    ?>
                                    <tr>
                                    <td class="text-muted cenet"><?php echo ($r->id) ?></td>
                                    <td class="text-muted"><?php echo traducirUsuario($r->id_usuario) ?></td>
                                    <td class="text-muted"><?php echo traducirPersonaje($r->id_luchador) ?></td>
                                    <td class="text-muted"><?php echo ($r->tv) ?></td>
                                    <td class="text-muted"><?php echo ($r->firma) ?></td>
                                    <td class="text-muted"><?php echo ($r->privado) ?></td>
                                    <td class="text-muted"><?php echo ($r->prensa) ?></td>
                                    <td class="text-muted"><?php echo ($r->oficina) ?></td>
                                    <td class="text-muted"><?php echo ($r->created_at) ?></td>
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