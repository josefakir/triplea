$(document).ready(function(){
	$('a[data-toggle="dropdown"]').click(function(e){
		e.preventDefault();
		$('.dropdown-menu ').stop().slideToggle();
	});
	$('#rol_usuario').change(function(){
		if($(this).val()=='3'){
			$('#solotalento').fadeIn('fast');
			$('#solotalento input').prop('required',true);
		}else{
			$('#solotalento').hide();
			$('#solotalento input').prop('required',false);
		}
	})
})