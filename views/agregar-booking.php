<?php 
    include('header.php');
    use Mainclass\Models\Usuario; 
    use Mainclass\Models\Tipo; 
    use Mainclass\Models\Indumentaria; 
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
                        <div><h1>Agregar solicitud de booking</h1></div>
                    </div>
                </div>
            </div>            


            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="<?php echo BASE_URL ?>insert/booking">
                        <div class="form-group">
                            <label for="">Talento (Luchador)</label>
                            <select name="id_usuario" class="form-control" required>
                                <option value="">-Seleccione-</option>
                                <?php
                                    $usuario = new Usuario();
                                    $usuario = $usuario->where('rol',3)->orderBy('nombre','ASC')->get();
                                    foreach ($usuario as $u) {
                                        ?>
                                <option value="<?php echo $u->id ?>"><?php echo $u->nombre ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tipo de evento</label>
                            <select name="id_tipo" class="form-control" required>
                                <option value="">-Seleccione-</option>
                                <?php
                                    $tipo = new Tipo();
                                    $tipo = $tipo->where('status',1)->orderBy('nombre','ASC')->get();
                                    foreach ($tipo as $u) {
                                        ?>
                                <option value="<?php echo $u->id ?>"><?php echo $u->nombre ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Fecha de solicitud</label>
                            <input type="text" name="fecha" class="datepicker form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Hora de solicitud</label>
                            <select name="hora" class="form-control">
                                <?php
                                for ($i=0; $i < 24 ; $i++) { 
                                        $ipadded = sprintf("%02d", $i);
                                        echo "<option value='$ipadded:00' $selected0>$ipadded:00</option>\n";
                                        echo "<option value='$ipadded:00' $selected1>$ipadded:30</option>\n";

                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Indumentaria</label>
                            <select name="id_indumentaria" class="form-control" requred>
                                <option value="">-Seleccione-</option>
                                <?php
                                    $tipo = new Indumentaria();
                                    $tipo = $tipo->where('status',1)->orderBy('nombre','ASC')->get();
                                    foreach ($tipo as $u) {
                                        ?>
                                <option value="<?php echo $u->id ?>"><?php echo $u->nombre ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Comentarios:</label>
                            <textarea name="comentarios" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-success">Solicitar booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>