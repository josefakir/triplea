<?php 
    include('header.php');
    use Mainclass\Models\Usuario; 
    use Mainclass\Models\Tipo; 
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
                    <form method="post" action="<?php echo BASE_URL ?>insert/usuario">
                        <div class="form-group">
                            <label for="">Talento (Luchador)</label>
                            <select class="form-control" required>
                                <option value="">-Seleccione-</option>
                                <?php
                                    $usuario = new Usuario();
                                    $usuario = $usuario->where('rol',3)->get();
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
                            <select class="form-control" required>
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
                            <input type="text" name="fecha" class="datepicker form-control">
                        </div>
                        <div class="form-group">
                            <label>Hora de solicitud</label>
                            <select class="form-control">
                                <option value="">- Seleccione -</option>
                                <option value="00:00">00:00</option>
                                <option value="00:30">00:30</option>
                                <option value="01:00">01:00</option>
                                <option value="01:30">01:30</option>
                                <option value="02:00">02:00</option>
                                <option value="02:30">02:30</option>
                                <option value="03:00">03:00</option>
                                <option value="03:30">03:30</option>
                                <option value="04:00">04:00</option>
                                <option value="04:30">04:30</option>
                                <option value="05:00">05:00</option>
                                <option value="05:30">05:30</option>
                                <option value="06:00">06:00</option>
                                <option value="06:30">06:30</option>
                                <option value="07:00">07:00</option>
                                <option value="07:30">07:30</option>
                                <option value="08:00">08:00</option>
                                <option value="08:30">08:30</option>
                                <option value="09:00">09:00</option>
                                <option value="09:30">09:30</option>
                                <option value="10:00">10:00</option>
                                <option value="10:30">10:30</option>
                                <option value="11:00">11:00</option>
                                <option value="11:30">11:30</option>
                                <option value="12:00">12:00</option>
                                <option value="12:30">12:30</option>
                                <option value="13:00">13:00</option>
                                <option value="13:30">13:30</option>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                                <option value="21:30">21:30</option>
                                <option value="22:00">22:00</option>
                                <option value="22:30">22:30</option>
                                <option value="23:00">23:00</option>
                                <option value="23:30">23:30</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Indumentaria</label>
                            <select class="form-control" requred>
                                <option value="">-Seleccione-</option>
                                <option value="equipo-completo">Equipo Completo </option>
                                <option value="formal">Formal (bien vestidos) </option>
                                <option value="pantsaaa">Pants AAA</option>
                                <option value="ropa-entrenamiento">Ropa de Entrenamiento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Comentarios:</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <button class="btn btn-success">Solicitar booking</button>
                    </form>
                </div>
            </div>
            <?php include("footer.php") ?>
        </div>
    </div>
</div>
<?php include("footer.php") ?>