  $(document).ready(function() {
	var max_fields      = 5; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	  var add_button      = $(".add_field_button"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div><input type="text"  name="branches[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})

	
    var max_fields1     = 5; //maximum input boxes allowed
	var wrapper1   		= $(".input_fields_wrap1"); //Fields wrapper
	var add_button1     = $(".add_phone_filed_button"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button1).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields1){ //max input box allowed
			x++; //text box increment
			$(wrapper1).append('<div><input type="text" name="phone_numbers[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
		}
	});
	
	$(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});