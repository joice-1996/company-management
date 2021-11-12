var cartdata=[];
var product_data=[];
var company_details=[];
var phones=[];
var branches1=[];

var product_xmlhttp = new XMLHttpRequest();
product_xmlhttp.onreadystatechange = function() {
   if (product_xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
      if (product_xmlhttp.status == 200) {
        product_data = JSON.parse(product_xmlhttp.responseText);             
        //console.log(product_data);
      }
   }
};
var requestVariable = 'http://localhost/company-management/public/client/get_product';
product_xmlhttp.open("GET", requestVariable, true);
product_xmlhttp.send();

 /* function checkbranch()
{
    
    document.getElementById('btn-branch').style.display="block";
    return false;
}
function checkphone()
{ 
    document.getElementById('btn-phone').style.display="block";  
    return false;   
} 
 */
function start_date()
{
    document.getElementById('start_date').value = new Date().toDateInputValue();
    return false;
}
function expiry_date()
{
    document.getElementById('expiry_date').value = new Date().toDateInputValue();
    return false;
}
/*
This script is identical to the above JavaScript function.
*/

/* $(document).ready(function() {
	var max_fields      = 5; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	  var add_button      = $(".btn-branch"); //Add button ID
	//var data="";
	var x = 1; 
    var i=1 ;
    //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
            //$(wrapper).append('<div><input type="text" id="dynamic_id"   onchange=newFn(dynamic_id)  class="form-control"  name="branches[]"/><a href="#" class="remove_field btn btn-danger">Remove</a></div>'); //add input box
            //newFn(dynamic_id){}
			$(wrapper).append('<div><input type="text" id="branch_id'+i+'" oninput="getbranchValue(branch_id);"  class="form-control"  name="branches"/><a href="#" class="remove_field btn btn-danger">Remove</a></div>'); //add input box
            /* data=document.getElementsByName("branches").value;
            branches1.push(data); 
            i++;

		}
	});
     function getbranchValue(id)
    {
       var data=document.getElementById(id).value;
       branches1.push(data);
    } 
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
        branches1.pop();
        
	})

	
    var max_fields1     = 5; //maximum input boxes allowed
	var wrapper1   		= $(".input_fields_wrap1"); //Fields wrapper
	var add_button1     = $(".btn-phone"); //Add button ID
    var data1="";
	
	var x = 1; //initlal text box count
	$(add_button1).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields1){ //max input box allowed
			x++; //text box increment
			$(wrapper1).append('<div><input type="text" class="form-control" name="phone_numbers[]"/><a href="#" class="remove_field btn btn-danger">Remove</a></div>'); //add input box
            data1=document.getElementsByName("phone_numbers").value;
            phones.push(data1);
        }

	});
	
	$(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
 */


/* var ct = 1;
function new_link()
{
	ct++;
	var div1 = document.createElement('div');
	div1.id = ct;
   
	// link to delete extended form elements
	var delLink = '<div ><a href="javascript:delIt('+ ct +')">Del</a></div>';
	div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
	document.getElementById('newlink').appendChild(div1);
    
}
// function to delete the newly added set of elements
function delIt(eleId)
{
    //alert(1);
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('newlink');
	parentEle.removeChild(ele);
}

var ct1 = 1;
function new_link1()
{
	ct1++;
	var div1 = document.createElement('div');
	div1.id = ct1;
	// link to delete extended form elements
	var delLink = '<div ><a href="javascript:delIt1('+ ct1 +')">Del</a></div>';
	div1.innerHTML = document.getElementById('newlinkphone').innerHTML + delLink;
	document.getElementById('newphone').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt1(eleId1)
{
	d1 = document;
	var ele1 = d1.getElementById(eleId1);
	var parentEle = d1.getElementById('newphone');
	parentEle.removeChild(ele1);
} */


function customize()
{
        var customize = document.forms["myForm"]["cust"].value;
        if(customize=="")
        {
            document.getElementById("customize").style.display = "none";
            alert("Please Select Customize field");
            return false;
        }
        else if(customize=="yes")
        {
            document.getElementById("customize").style.display = "block";
        }
        else if(customize=="no")
        {
            document.getElementById("customize").style.display = "none";
        }
}



function productAddToCart() {

    //alert(products.length);
     
    /*----Cart Validation----*/
    
    
    //product field
    var product = document.forms["myForm"]["productname"].value;
    
    if (product == "" || product == 'Open this select menu')
    {
        document.getElementById("productnameEr").innerHTML="Please Select product";
        return false;
    }

    //start date field
    var start_date=document.forms["myForm"]["start_date"].value;
    if(start_date == "")
    {
        document.getElementById("start_dateEr").innerHTML="Start Date is required";
        return false;
    }

     //expiry date field
     var expiry_date=document.getElementById("expiry_date").value;
     if(expiry_date == "")
     {
         document.getElementById("expiry_dateEr").innerHTML="Expiry Date is required";
         return false;
     }

     //expiry date field
     var expiry_date=document.getElementById("expiry_date").value;
     if(expiry_date == "")
     {
         document.getElementById("expiry_dateEr").innerHTML="Expiry Date is required";
         return false;
     }

     //no of license  field
     var license=document.getElementById("license").value;
     if(license == 0)
     {
         document.getElementById("licenseEr").innerHTML="no.of license is required";
         return false;
     }

     //license amount  field
     var license_amount=document.getElementById("license_amount").value;
     if(license_amount == "")
     {
         document.getElementById("license_amountEr").innerHTML="license amount is required";
         return false;
     }

     //installation amount  field
     var installation_charge=document.getElementById("installation_charge").value;
     if(installation_charge == "")
     {
         document.getElementById("installation_chargeEr").innerHTML="Installation Charge is required";
         return false;
     }

     //platform amount  field
     var platform_charge=document.getElementById("platform_charge").value;
     if(platform_charge == "")
     {
         document.getElementById("platform_chargeEr").innerHTML="Platform Charge is required";
         return false;
     }
     

    document.getElementById("table1").style.display = "block";
    
    if ($("#productname").val() != null && $("#productname").val() != '') {

       //alert(1);
       
       var datas= {
        "id":$("#productname").val(),
        "start_date":$("#start_date").val(),
        "expiry_date":$("#expiry_date").val(),
        "licenses":$("#license").val(),
        "license_amount":$("#license_amount").val(),
        "customization_description":$("#customization_description").val(),
        "customization_amount": $("#customization_amount").val(),
        "installation_charge":$("#installation_charge").val(),
        "platform_charge":$("#platform_charge").val()
       };
        cartdata.push(datas);
        console.log(cartdata);
    
       
        // Add product to Table
        productAddToTable();
        //cartdata.forEach(productAddToTable);

        // Clear form fields
        formClear();

        // Focus to product name field
        $("#productname").focus();
    }
}


function getbranchesValues()
{
    var branch = $( "[name=branches]" ).serializeArray();
    jQuery.each( branch, function( branchV ) {
      branches1.push(branchV.value);
    });
}

function productAddToTable() {
     
    
   /*  document.getElementById("div1").style.display = "block";
    document.write(1); */
    // First check if a <tbody> tag exists, add one if not
    if ($("#productTable tbody").length == 0) {
        $("#productTable").append("<tbody></tbody>");
    }
    

    // Append product to the table
    var product_id=$("#productname").val();
    
 $("#productTable tbody").append("<tr id='"+product_id+"'>" +
        "<td>" + product_data[$("#productname").val()]+ "</td>" +
        "<td>" + $("#start_date").val() + "</td>" +
        "<td>" + $("#expiry_date").val() + "</td>" +
        "<td>" + $("#license").val() + "</td>" +
        "<td>" + $("#license_amount").val() + "</td>" +
        "<td>" + $("#customization_description").val() + "</td>" +
        "<td>" + $("#customization_amount").val() + "</td>" +
        "<td>" + $("#installation_charge").val() + "</td>" +
        "<td>" + $("#platform_charge").val() + "</td>" +
        "<td>" +
        "<button type='button' onclick='productDelete("+product_id+");' class='btn btn-default btn-primary'>" +
        "Delete" +
        "</button>" +
        "</td>" +
        "</tr>"); 

}

function formClear() {
    $("#productname").val("");
    $("#start_date").val("");
    $("#expiry_date").val("");
    $("#license").val("");
    $("#license_amount").val("");
    $("#customization_description").val("");
    $("#customization_amount").val("");
    $("#installation_charge").val("");
    $("#platform_charge").val("");
}

function productDelete(ctl) {
    console.log(1);
    cartdata.splice(cartdata.findIndex(function(i){
       return i.id === ct1;
     }), 1); 
    console.log(cartdata);
    deleteFromCart(ctl);
    //$(ctl).parents("tr").remove();
    alert("deleted");
}
function deleteFromCart(id)
{
    var data=document.getElementById(id);
    data.parentNode.removeChild(data);
}



function validate_clientForm()
{
    
    var company_name=document.forms["myForm"]["company_name"].value;
    if(company_name=="")
    {
        document.getElementById("company_name").innerHTML="company name field is required";
        return false;
    }
    //alert(1);
     var branches=document.forms["myForm"]["branches"].value;
  /* branches1.push(branches);
   alert(branches1);  */
    var contact_person=document.forms["myForm"]["contact_person_name"].value;
    if(contact_person=="")
    {
        document.getElementById("contact_person_name").innerHTML="contact filed is required";
        return false;
    }

    var email=document.forms["myForm"]["email"].value;
    if(email=="")
    {
        document.getElementById("email").innerHTML="email field is required";
    }

    var phone=document.getElementById("phone").value;
    //alert(phone);
    if(phone=="")
    {
        document.getElementById("phone_numbers").innerHTML="phone number filed is required";
        return false;
    }
    


    var address=document.forms["myForm"]["address"].value;
    if(address=="")
    {
        document.getElementById("address").innerHTML="address filed is required";
        return false;
    }

    var company_logo=document.forms["myForm"]["company_logo"].value;
    if(company_logo=="")
    {
        document.getElementById("company_logo").innerHTML="logo is required";
        return false;
    }

    var consultant=document.forms["myForm"]["consultant"].value;

    var companydata= {
        "compayname":company_name,
        "branches":branches,
        "contact_person":contact_person,
        "email":email,
        "phone":phone,
        "address":address,
        "consultant":consultant
       };
       company_details.push(companydata);
        console.log(company_details);
 
        /* getbranchesValues();
        alert(branches1);
 */

        if (Array.isArray(cartdata) && cartdata.length == 0)
        {
           alert("add product details");
        }
        else if (Array.isArray(company_details) && company_details.length == 0)
        {
            alert("add client details");
        }
        else
        {
            //console.log(1);
            console.log(branches1);
            console.log(phones);
            
            var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
          if (xmlhttp.status == 200) {
            var resp = xmlhttp.responseText; 
        
                alert(resp);
                filter_data();
                
              
           
           

          }
          else if (xmlhttp.status == 400) {
             alert('There was an error 400');
          }
          else {
              alert('something else other than 200 was returned');
          }
       }
   };
   var requestVariable = 'http://localhost/company-management/public/client/add_client';
   xmlhttp.open("POST", requestVariable, true);
    var data = new FormData(); 
    data.append('logo',  document.getElementById("company_logoo").files[0]);
    data.append('client',  JSON.stringify({companydata}));
    data.append('product',  JSON.stringify({cartdata}));
   xmlhttp.send(data);
        
}

}





    








