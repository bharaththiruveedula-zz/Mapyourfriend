function func_group(){
	var name = $('#name').val();
	var group = $('#groupid').val();
	$.ajax({
		type: "POST",
		url: "src/php/check1.php",
		data: {  
			'groupid': group,
			'name': name,
		},
        
		success: function(data){
			if(data==1){
				$('#area').html("Valid group id");
			}
			else if(data==2){
				$('#area').html("Valid group ID");
				   	$('#join_submit_btn').attr('disabled', false);
			}
			else if (data==0) {
				$('#area').html( "In-Valid group ID");
				$('#join_submit_btn').attr('disabled', true);
			}
		},
	});
}

function func_nick(){
	var name = $('#name').val();
	var group = $('#groupid').val();
	$.ajax({
		type: "POST",
		url: "src/php/check2.php",
		data: {  
			'name': name,
			'groupid': group
		},
        
		success: function(data){
			if(data==1){
				
                $('#area1').html("Valid user for the above group");
				$('#join_submit_btn').attr('disabled', false);
			}else { 
				$('#area1').html("In-Valid user for the above group");
				$('#join_submit_btn').attr('disabled', true);
			}
		},
	});
}

function check_group_validate(){
	var nickname = $('#nickname').val();
	var group = $('#group').val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	var emailaddressVal = $("#email").val();
	$.ajax({
		type: "POST",
		url: "src/php/check3.php",
		data: {  
			'group': group
		},
		success: function(data){
			if(data==1){
				$('#area2').html("Group name taken");
				$('#create_btn').attr('disabled', true);
			}
			else if (data==2) {
				$('#area2').html("Empty group name");
				$('#create_btn').attr('disabled', true);
			}
			else if (data==0){ 
				$('#area2').html("Group name unique");
				if(  (!emailReg.test(emailaddressVal)&&nickname.length<4) ) {
					$('#create_btn').attr('disabled', true);	    	
				}
				else if ( (emailReg.test(emailaddressVal)&&nickname.length>=4&&emailaddressVal!="") ) {
                    $('#create_btn').attr('disabled', false);
                }
        	}
        	
		},
	});
}

function check_nickname(){
	var nickname = $('#nickname').val();
	var group = $('#group').val();
	if(nickname.length<4){
		$('#area3').html("Nickname is too short");	
		$('#create_btn').attr('disabled', true);	
	}
	else if (nickname.length>=4) {
		$('#area3').html("Looks clean");
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var emailaddressVal = $("#email").val();
        $.ajax({
			type: "POST",
			url: "src/php/check3.php",
			data: {  
				'group': group
			},
            
			success: function(data){
				if(  (!emailReg.test(emailaddressVal)&&data==1) || (!emailReg.test(emailaddressVal)&&data==0) || (emailReg.test(emailaddressVal)&&data==1)  ) {
            		$('#create_btn').attr('disabled', true);
        		}
        		else if ( (emailReg.test(emailaddressVal)&&data==0&&emailaddressVal!="") ) {
					$('#create_btn').attr('disabled', false);
        		}
        	},
		});
	}
}

function check_email(){
	
	var nickname = $('#nickname').val();
	var group = $('#group').val();
	var hasError = false;
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	var emailaddressVal = $("#email").val();
    if(emailaddressVal == '') {
        $("#area4").html('Please enter your email address.');
		$('#create_btn').attr('disabled', true);
    }
    else if(!emailReg.test(emailaddressVal)) {
        $("#area4").html('Enter a valid email address.');
        $('#create_btn').attr('disabled', true);
    }
    else if (emailReg.test(emailaddressVal) )
    {
        //$("#area4").html('Email id looks gud');
	    $.ajax({
			type: "POST",
			url: "src/php/check3.php",
			data: {  
				'group': group,
                'email': emailaddressVal

			},
            
			success: function(data){
		 		if(  (nickname.length<4&&data==1) || (nickname.length<4&&data==0) || (nickname.length>=4&&data==1)  ) 
		 		{
            		$('#create_btn').attr('disabled', true);
        		}
        		else if ( nickname.length>=4&&data==0 ) {
					$('#create_btn').attr('disabled', false);
        		}
                else if ( data==3){
                    $("#area4").html('Email ID has already been taken');
                    $('#create_btn').attr('disabled', true);
                }
                else{
                    $("#area4").html('Email ID is correct');
                    $('#create_btn').attr('disabled', false);                    
                }
                
			},
		});
	}
}
