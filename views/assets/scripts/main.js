$(document).ready(function(){
	$('a[data-toggle="dropdown"]').click(function(e){
		e.preventDefault();
		$('.dropdown-menu ').stop().slideToggle();
	})
})