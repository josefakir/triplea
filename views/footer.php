<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>views/assets/scripts/main.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
      
<script src='<?php echo BASE_URL ?>views/assets/scripts/fullcalendar/packages/core/main.js'></script>
<script src='<?php echo BASE_URL ?>views/assets/scripts/fullcalendar/packages/daygrid//main.js'></script>
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.4/dist/latest/bootstrap-autocomplete.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
			todayHighlight: true
		});
		$('.datepicker2').datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
			todayHighlight: true
		});
		$('.basicAutoComplete').keyup(function(){
			$.ajax({
				url : "<?php echo BASE_URL ?>api/v1/evt/"+$('#fecha_buscar').val()+"/"+$(this).val(),
				success : function(data){
					$('.autocomplete').slideDown('fast');
					var output = '';
					$.each( data, function( key, value ) {
						output +='<li><a hfref="#" class="autocomplete_click" data-id="'+value.id+'">'+value.nombre+'</a></li>';
					});
					if(data.length==0){
						$('.autocomplete ul').html('<li>No encontramos eventos, se creará uno nuevo</li>');
					}else{
						$('.autocomplete ul').html(output);
					}
				},error : function(){
					$('.autocomplete').slideDown('fast');
					$('.autocomplete ul').html('<li>No encontramos eventos (¿Elegiste una fecha?)</li>');
				}
			})
		});
		$(document).on("click",".autocomplete_click",function() {
			$('#autocomplete').val($(this).html());
			$('#id_evento').val($(this).attr('data-id'));
			$('.autocomplete').slideUp('fast');
		});
		$(document).on("blur",".basicAutoComplete",function() {
			$('.autocomplete').slideUp('fast');
		});
		//
	})
</script>
</body>
</html>