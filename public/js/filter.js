
var to_filter;
function filter_data()
{
    //console.log(1);
    
    var search=document.getElementById("search").value;
    var product=document.getElementById("product_id").value;
    var consultant=document.getElementById("consultant_id").value;
    var customization=document.getElementById("customization").value;
     to_filter= {
        "search":search,
        "product_id":product,
        "consultant_id":consultant,
        "customization":customization,
       };
      
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
             if (xmlhttp.status == 200) {
               var resp = xmlhttp.responseText;     
               document.getElementById("myDiv").innerHTML=resp;          
            //    document.write(resp);
               document.getElementById("product_id").value = product;
               document.getElementById("search").value = search;
               document.getElementById("consultant_id").value=consultant;
               document.getElementById("customization").value=customization;
               document.getElementById("search_client").value = search;
               document.getElementById("product_id1").value = product;
               document.getElementById("consultant_id1").value = consultant;
               document.getElementById("cust").value = customization;


             }
             else if (xmlhttp.status == 400) {
                alert('There was an error 400');
             }
             else {
                 alert('something else other than 200 was returned');
             }
          }
      };
      var requestVariable = 'http://localhost/company-management/public/client/client_details_search';
      xmlhttp.open("POST", requestVariable, true);
       var data = new FormData();
       data.append('data',  JSON.stringify({to_filter}));
      xmlhttp.send(data);
}


//To delete The client
function delete_client(id)
{
   var confirm1 = confirm("Are you sure to delete?");
   if(confirm1)
   {
   }
   else
   {
      cancel;
   }

   var xmlhttp1 = new XMLHttpRequest();
   xmlhttp1.onreadystatechange = function() {
      if (xmlhttp1.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
         if (xmlhttp1.status == 200) {
           var resp1 = xmlhttp1.responseText;     
         
             alert(resp1);
             filter_data();
          
         }
         else if (xmlhttp1.status == 400) {
            alert('There was an error 400');
         }
         else {
             alert('something else other than 200 was returned');
         }
      }
  };
  var requestVariable = 'http://localhost/company-management/public/client/client_delete/'+id;
  xmlhttp1.open("POST", requestVariable, true);
  xmlhttp1.send(); 
}

//reset the filter form
function reset()
{
   document.getElementById("search").value="";
   document.getElementById("product_id").value="";
   document.getElementById("consultant_id").value="";
   document.getElementById("customization").value="";
}

//To deactivate the client

function deactivate_client(id)
{
   var confirm=confirm("Are you sure to deactivate?");
   if(confirm)
   {}
   else
   {
      cancel();
   }
   var xmlhttp2 = new XMLHttpRequest();
   xmlhttp2.onreadystatechange = function() {
      if (xmlhttp2.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
         if (xmlhttp2.status == 200) {
           var resp1 = xmlhttp2.responseText;     
         
             alert(resp1);
             filter_data();
          
         }
         else if (xmlhttp2.status == 400) {
            alert('There was an error 400');
         }
         else {
             alert('something else other than 200 was returned');
         }
      }
  };
  var requestVariable = 'http://localhost/company-management/public/client/client_deactivate/'+id;
  xmlhttp2.open("POST", requestVariable, true);
  xmlhttp2.send(); 
}

//edit view

function edit_client(id)
{
   var xmlhttp3 = new XMLHttpRequest();
   xmlhttp3.onreadystatechange = function() {
      if (xmlhttp3.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
         if (xmlhttp3.status == 200) {
           var resp1 = (JSON.parse(xmlhttp3.responseText));     
             //alert(resp1);
             //alert(resp1.consultant['name']);
             document.getElementById('client_id').value=resp1.id;
             document.getElementById('comp_name').value=resp1.company_name;
             document.getElementById('contact_person').value=resp1.contact_person;
             document.getElementById('email1').value=resp1.email;
             document.getElementById('addrs').value=resp1.address;
             
             for(var item of resp1.company_branches)
             {
                 document.getElementById('branch').value= item['branches'];
             }
             for(var item1 of resp1.company_phones)
             {
                document.getElementById('phone_no').value=item1['contact_number'];
             }
             /* document.getElementById('comp_logo').value=resp1.company_logo;
             document.getElementById('user_id1').value=resp1.consultant['name']; */
             
           var str=  "<table id='productTable1' class='table table-bordered table-condensed table-striped'>"
             str+="<thead>"
               str+=  "<tr>"
                str+=     "<th>Product Name</th>"
                str+=     "<th>Start Date</th>"
                 str+=    "<th>Expiry Date</th>"
                 str+=    "<th>No.of License</th>"
                  str+=   "<th>License Amount</th>"
                  str+=   "<th>Customization Description</th>"
                  str+=   "<th>Customization Amount</th>"
                  str+=   "<th>Installation Charge</th>"
                  str+=   "<th>Platform Charge</th>"
                 
              str+=  " </tr>"
           str+= "</thead>"
            str+= "<tbody>"
            
             for(var item1 of resp1.company_cart_products)
             {
               
             str+= "<tr><td>"+item1['products']['product']+"</td>"
              str+= "<td>"+item1['start_date']+"</td>"
              str+= "<td>"+item1['expiry_date']+"</td>"
              str+= "<td>"+item1['no_of_license']+"</td>"
               str+="<td>"+item1['license_amount']+"</td>"
              str+= "<td>"+item1['customization_description']+"</td>"
              str+= "<td>"+item1['customization_amount']+"</td>"
              str+= "<td>"+item1['installation_charge']+"</td>"
              str+= "<td>"+item1['platform_charge']+"</td></tr>"  
             }
             str+="</tbody>"
             "</table>"
             //console.log(str);

             document.getElementById('table_data').innerHTML=str;
         }
         else if (xmlhttp3.status == 400) {
            alert('There was an error 400');
         }
         else {
             alert('something else other than 200 was returned');
         }
      }
  };
  var requestVariable = 'http://localhost/company-management/public/client/client_edit_view/'+id;
  xmlhttp3.open("POST", requestVariable, true);
  xmlhttp3.send(); 
}

function activate_client(id)
{
   //confirm("Are you sure to deactivate?");
   var xmlhttp4 = new XMLHttpRequest();
   xmlhttp4.onreadystatechange = function() {
      if (xmlhttp4.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
         if (xmlhttp4.status == 200) {
           var resp1 = xmlhttp4.responseText;     
         
             alert(resp1);
             filter_data();
          
         }
         else if (xmlhttp4.status == 400) {
            alert('There was an error 400');
         }
         else {
             alert('something else other than 200 was returned');
         }
      }
  };
  var requestVariable = 'http://localhost/company-management/public/client/client_activate/'+id;
  xmlhttp2.open("POST", requestVariable, true);
  xmlhttp2.send();  
}

function update_client()
{
   console.log(1);
   var id=document.forms["myForm1"]["id"].value;
   var comp_name=document.forms["myForm1"]["comp_name"].value;
    
    //alert(1);
     var branch=document.forms["myForm1"]["branch"].value;
 
    var contact_person1=document.forms["myForm1"]["contact_person"].value;
    

    var email1=document.forms["myForm1"]["emails"].value;
   
    var phone1=document.getElementById("phone_no").value;
    //alert(phone);
    
    


    var address1=document.forms["myForm1"]["addrs"].value;
    

    //var company_logo1=document.forms["myForm1"]["comp_logo"].value;
   

    var consultant1=document.forms["myForm1"]["consult"].value;

    var clientdata= {
       "client_id":id,
        "compayname":comp_name,
        "branches":branch,
        "contact_person":contact_person1,
        "email":email1,
        "phone":phone1,
        "address":address1,
        "consultant":consultant1
       };
      
        /* getbranchesValues();
        alert(branches1);
 */

       
            
            var xmlhttp5 = new XMLHttpRequest();
    xmlhttp5.onreadystatechange = function() {
       if (xmlhttp5.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
          if (xmlhttp5.status == 200) {
            var resp = xmlhttp5.responseText; 
        
                alert(resp);
                filter_data();
          }
          else if (xmlhttp5.status == 400) {
             alert('There was an error 400');
          }
          else {
              alert('something else other than 200 was returned');
          }
       }
   };
   var requestVariable = 'http://localhost/company-management/public/client/edit_client';
   xmlhttp5.open("POST", requestVariable, true);
    var data = new FormData(); 
    data.append('logo1',  document.getElementById("comp_logo").files[0]);
    data.append('client',  JSON.stringify({clientdata}));
    xmlhttp5.send(data);
}

/* function client_export()
{
   console.log(to_filter);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
         if (xmlhttp.status == 200) {
           var resp = xmlhttp.responseText;     
         //filter_data();

         }
         else if (xmlhttp.status == 400) {
            alert('There was an error 400');
         }
         else {
             alert('something else other than 200 was returned');
         }
      }
  };
  var requestVariable = 'http://localhost/company-management/public/client/client_export_filter';
  xmlhttp.open("POST", requestVariable, true);
    var data = new FormData();
   data.append('data',  JSON.stringify({to_filter}));
  xmlhttp.send(data);
} */