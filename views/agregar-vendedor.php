<?php 
    include('header.php');
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
                        <div><h1>Agregar Vendedor</h1></div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="<?php echo BASE_URL ?>insert/vendedor">
                        <div class="form-group">
                            <label for="">Nombre de vendedor:</label>
                            <input class="form-control" type="text" required name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="">Tipo de evento</label>
                            <select name="id_tipo_evento" class="form-control" required>
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
                        <button class="btn btn-success">Agregar Vendedor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>