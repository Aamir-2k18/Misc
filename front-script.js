(function ($){
	$(document).ready(function(e) {

	//----------------------------------------***********----------------------------------------
	
	
	//----------------------------------------***********----------------------------------------
		 function validateEmail(email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }


 $('#qbtn').click(function(e){
	 e.preventDefault();
	 console.log('clicked!');
	var err = 1;
	$(this).addClass('clicked');
	


	if($('#f_name').val() == ""){$('#f_name').focus().addClass('inp_err'); 
		if($("#fname_holder .err").length < 1){$('#fname_holder').append('<span class="err">Please enter First Name</span>');}
	 }
	else if($('#s_name').val() == ""){$('#s_name').focus().addClass('inp_err');  
		if($("#sname_holder .err").length < 1){$('#sname_holder').append('<span class="err">Please enter Last Name</span>');}
	 }
	else if($('#email').val() == ""){$('#email').focus().addClass('inp_err'); 
		if($("#email_holder .err").length < 1){$('#email_holder').append('<span class="err">Please enter Email</span>'); }
	}
	else if(!validateEmail($('#email').val())){$('#email').focus().addClass('inp_err');  
		if($("#validEmail span").length < 1){$('#validEmail').append('<span class="err">Please enter a valid Email</span>');}
	 }
	
	else if($('#tel').val() == ""){$('#tel').focus().addClass('inp_err');  
		if($("#tel_holder .err").length < 1){$('#tel_holder').append('<span class="err">Please enter Telephone</span>');}
	}
	else if($('#address').val() == ""){$('#address').focus().addClass('inp_err');  
		if($("#address_holder .err").length < 1){$('#address_holder').append('<span class="err">Please enter your address</span>'); }
	}
	else if($('#request').val() == ""){$('#request').focus().addClass('inp_err');  
		if($("#request_holder .err").length < 1){$('#request_holder').append('<span class="err">Please enter request</span>'); }
	}
	
	else{err = 0;}
	$('#f_name').keyup(function(){ $(this).removeClass('inp_err'); $('#fname_holder .err').hide(); $('#fname_holder .form-icon').css('bottom','14px') });
	$('#s_name').keyup(function(){ $(this).removeClass('inp_err'); $('#sname_holder .err').hide(); $('#sname_holder .form-icon').css('bottom','14px') });
	$('#email').keyup(function(){  $(this).removeClass('inp_err');$('#email_holder .err').hide(); $('#email_holder .form-icon').css('bottom','14px') });
	$('#tel').keyup(function(){  $(this).removeClass('inp_err');$('#tel_holder .err').hide(); $('#tel_holder .form-icon').css('bottom','14px') });
	$('#address').keyup(function(){  $(this).removeClass('inp_err');$('#address_holder .err').hide(); $('#address_holder .form-icon').css('bottom','14px') });
	$('#request').keyup(function(){  $(this).removeClass('inp_err');$('#request_holder .err').hide(); $('#request_holder .form-icon').css('bottom','14px') });
	
	if(err == 0){ //alert('Good to Go!'); 
				var _this = $(this);  
		var data = jQuery('#quote_form').serialize();
		$.post(ajaxurl, {data:data, action:'quote_form'}, function(response) {
			window.location=response.success_url;
		}, 'json');
	
	}
	
	  
 });
	
	
	//----------------------------------------***********----------------------------------------
	//----------------------------------------***********----------------------------------------
	$( ".sidebar_set a.active" ).trigger( "click" );
});

})(jQuery)


