

function submitForm(url){
	$('#adminForm').attr('action', url);
	$('#adminForm').submit();
}

$(document).ready(function() {

	/* This is basic - uses default settings */
	
	$("a#single_image").fancybox();

	$("a.tab1").click(function(e){
		$("div#tab1").css('display','block');
		$("div#tab2").css('display','none');
		$("a.tab2").removeClass('active');
		$("a.tab1").addClass('active');
		return false;
	});
	$("a.tab2").click(function(e){
		$("div#tab2").css('display','block');
		$("div#tab1").css('display','none');
		$("a.tab1").removeClass('active');
		$("a.tab2").addClass('active');
		return false;
	});
		
	
    
  
});

