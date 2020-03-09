<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>views/assets/scripts/main.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script src='<?php echo BASE_URL ?>views/assets/scripts/fullcalendar/packages/core/main.js'></script>
<script src='<?php echo BASE_URL ?>views/assets/scripts/fullcalendar/packages/daygrid//main.js'></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').datepicker({
		 format: 'yyyy-mm-dd',
		 startDate: '+0d',
		 autoclose: true,
    	todayHighlight: true
	 });
	})
</script>
</body>
</html>