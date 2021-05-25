// thay đổi 1 phần tử status
function changeStatus(url) {
	$.get(	url,
	 		function(data){
	 			console.log(data);
               	var element		= 'a#status-' + data[0];
                var id = data[0];
                var status = data[1];
                var link = data[2];
                var removeclass = 'state publish';
                var addclass = 'state unpublish';
                if(status == 1){
                	removeclass = 'state unpublish';
                	addclass 	= 'state publish';                	
                }
                $(element).attr('href', "javascript:changeStatus('"+link+"')");
                $(element+' span').removeClass(removeclass).addClass(addclass);     
			},
			'json');
}

// 
$(document).ready(function(){   
    $("#select_all").click(function(){
        $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
    });
    $("input[type=checkbox]").click(function() {
      if (!$(this).prop("checked")) {
        $("#select_all").prop("checked", false);
    }
    });
    $('#filter-bar button[name=submit-keyword]').click(function(){
        $('#adminForm').submit();
    });
    
    $('#filter-bar button[name=clear-keyword]').click(function(){
        $('#filter-bar input[name=filter_search]').val("");
        $('#adminForm').submit();
    });

    $('#filter-bar select[name=filter_state]').change(function(){
        $('#adminForm').submit();
    });

    $('#filter-bar select[name=filter_state_gr]').change(function(){
        $('#adminForm').submit();
    });

})

//submit Form
function submitForm(url){
    $('#adminForm').attr('action', url);
    $('#adminForm').submit();
}


//sortList
function sortList(colum,order){    
    $('input[name=colum]').val(colum);
    $('input[name=columdir]').val(order);
    $('#adminForm').submit();
}
function changePage(page){
    $('input[name=filter_page]').val(page);
    $('#adminForm').submit();
}




