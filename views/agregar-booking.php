<?php 
    include('header.php');
    use Mainclass\Models\Usuario; 
    use Mainclass\Models\Tipo; 
    use Mainclass\Models\Indumentaria; 
    use Mainclass\Models\Vendedor; 
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
                            <label>Fecha de solicitud</label>
                            <input type="text" name="fecha" class="datepicker form-control buscar_disponibles" autocomplete="off" id="fecha_buscar">
                        </div>
                        <div class="form-group" style="position:relative">
                            <label>Evento</label>
                            <input type="text" name="evt" class="form-control basicAutoComplete" autocomplete="off" id="autocomplete">
                            <input type="hidden" name="id_evento" id="id_evento">
                            <div class="autocomplete">
                                <ul></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Hora de solicitud</label>
                            <select name="hora" class="form-control buscar_disponibles" id="hora_buscar">
                                <?php
                                for ($i=7; $i < 21 ; $i++) { 
                                        $ipadded = sprintf("%02d", $i);
                                        echo "<option value='$ipadded:00' $selected0>$ipadded:00</option>\n";
                                        //echo "<option value='$ipadded:00' $selected1>$ipadded:30</option>\n";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                        <div class="form-group col">
                            <label for="">Talento (Luchador) Disponible</label>
                            <select name="id_usuario[]" class="form-control" required multiple id="id_usuario"  style="height: 400px;">
                                <option value="">-Seleccione-</option>
                            </select>
                        </div>
                        
                        <div class="form-group col">
                            <label for="">No disponibles</label>
                            <ul id="lista_no_disponibles"></ul>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="">Vendedor:</label>
                            <select name="id_vendedor" class="form-control" required id="id_vendedor"  >
                                <option value="">-Seleccione-</option>
                                <?php
                                    $tipo = new Vendedor();
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
                            <input type="checkbox" value="1" name="recibo_honorarios">
                            <label>Recibo de honorarios:</label>
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
                            <label for="">Dirección</label>
                            <div class="pac-card" id="pac-card">
                                <div id="pac-container">
                                    <input id="pac-input" type="text" placeholder="Escriba una dirección" class="form-control">
                                </div>
                            </div>
                            <div id="map"></div>
                            <div id="infowindow-content">
                                <img src="" width="16" height="16" id="place-icon">
                                <span id="place-name"  class="title"></span><br>
                                <span id="place-address"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Comentarios:</label>
                            <textarea name="comentarios" class="form-control"></textarea>
                        </div>
                        <input type="hidden" id="input_direccion" name="direccion">
                        <input type="hidden" id="input_latlong" name="latlong">
                        <button class="btn btn-success">Solicitar booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 19.4109627, lng: -99.1865804},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        autocomplete.setFields(
            ['address_components', 'geometry']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("No encontramos la dirección: '" + place.name + "'");
            return;
          }
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
          var latlong = place.geometry.location;
          if(place.name !=undefined){
            var address = place.name+' '+place.address_components[1].short_name+' '+place.address_components[0].short_name+' '+place.address_components[2].short_name+' '+place.address_components[6].short_name+' '+place.address_components[3].short_name+' '+place.address_components[4].short_name+' '+place.address_components[5].short_name;
          }else{
            var address = place.address_components[1].short_name+' '+place.address_components[0].short_name+' '+place.address_components[2].short_name+' '+place.address_components[6].short_name+' '+place.address_components[3].short_name+' '+place.address_components[4].short_name+' '+place.address_components[5].short_name;
          }
          $('#input_direccion').val(address);
          $('#input_latlong').val(latlong);
        });
      }
    </script>
    <script src="<?php echo base64_decode("aHR0cHM6Ly9tYXBzLmdvb2dsZWFwaXMuY29tL21hcHMvYXBpL2pzP2tleT1BSXphU3lDU2RNWGtMMTVsNkxLRk1RcWRzTUQ3LWRBaFVIWGRGUjgmbGlicmFyaWVzPXBsYWNlcyZjYWxsYmFjaz1pbml0TWFw") ?>"
        async defer></script>


       
<?php include("footer.php") ?>
<script>
    $(document).ready(function(){
        $('.buscar_disponibles').change(function(){
            $.ajax({
                url : '<?php echo BASE_URL ?>api/v1/disponibles/'+$('#fecha_buscar').val()+'/'+$('#hora_buscar').val(),
                success : function(data){
                    var disponibles = data[0].disponibles;
                    var nodisponibles = data[1].nodisponibles;
                    var outputdisponibles = '';
                    var outputnodisponibles = '';
                    $.each(disponibles,function( index, value ) {
                        outputdisponibles += '<option value="'+value.id+'">'+value.nombre+'</option>';
                    });
                    $.each(nodisponibles,function( index, value ) {
                        outputnodisponibles += '<li>'+value.nombre+'</li>';
                    });
                    $('#id_usuario').html(outputdisponibles)
                    $('#lista_no_disponibles').html(outputnodisponibles)
                }
            })
        })
    })
</script>