$(document).ready(function () {  
    $('.dropdown-toggle').dropdown();  
    $('.carousel').carousel('cycle');
    $('.dialogBox').modal('toggle');    
    $("input[type='submit']").click(function(){ 
	var nickname = $('#nickname').val();
	var group = $('#group').val();
	var email = $('#email').val();
	
	$.ajax({
	    type : "POST",
	    url : "http://localhost/Map-your-friend/src/php/create.php",
	    data : {
                nickname : nickname,
		group : group,
		email : email
            },
	    success : function(data){
		if(data=='SUCCESS'){
		    console.log(data);
		    $('#dialogBox').modal('hide');
		    message = "Congratulations you have successfully registered your group in Map your friend"
		    alertify.log(message);
		}
	    }
	});
	return false; 
    });
});
