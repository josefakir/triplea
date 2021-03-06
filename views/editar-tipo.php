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
                        <div><h1>Editar Tipo</h1></div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        $rol = new Tipo();
                        $rol = $rol->find($args['id']);
                    ?>
                    <form method="post" action="<?php echo BASE_URL ?>update/tipo">
                        <div class="form-group">
                            <label for="">Tipo de evento:</label>
                            <input class="form-control" type="text" required name="rol" value="<?php echo $rol->nombre ?>">
                            <input type="hidden" name="id" value="<?php echo $args['id'] ?>">
                        </div>
                        <button class="btn btn-success">Editar Tipo de evento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>