@include('header')

<main>
  @include('menu')

    <div class="right-main">
    @include('topBar')
        <div class="main-wrapper client-detaiils">
            <div class="row page-head">
                <div class="col-md-8 page-name">
                    <h4>Client Details</h4>
                </div>

            </div>

            <div class="row wrapper">
                <div class="col-lg-3 basic-info">
                @foreach($data as $va)
                <img src="{{asset('uploads/'.$va->company_logo)}}" alt="img" class="logo img-fluid">
                  
                    <h6>{{$va->company_name}}</h6>
                    <div class="colum-row">
                        Phone
                        @foreach($va->company_contacts as $value)      
                        <span>{{$value->contact_number}}</span> @endforeach
                    </div>
                    <div class="colum-row">
                    Email
                        <span>{{$va->email}}</span>
                    </div>
                    <div class="colum-row">
                        Address
                        <span>{{$va->address}}</span>
                    </div>

                    <div class="colum-row">
                        Company branches
                        @foreach($va->company_branches as $value)      
                        <span>{{$value->branches}}</span> @endforeach
                    </div>
                    <div class="colum-row">
                   Product
                   @foreach($va->carts as $value)
                        <span>{{$value->products->product}}</span> 
                        @endforeach
                    </div>
                    
                    <div class="colum-row">
                    Customization Description
                        @foreach($va->carts as $value)  
                        <span>{{$value->customization_description}}</span>
                    </div>
                    <div class="colum-row">
                    Customization Amount
                        <span>{{$value->customization_amount}}</span>
                    </div>
                    <div class="colum-row">
                    Start_date
                        <span>{{$value->start_date}}</span>
                    </div>
                    <div class="colum-row">
                    Expiry_date
                        <span>{{$value->expiry_date}}</span>
                    </div>
                    <div class="colum-row">
                    Number of license
                        <span>{{$value->no_of_license}}</span>
                    </div>
                    <div class="colum-row">
                    License Amount
                        <span>{{$value->license_amount}}</span>
                    </div>
                    <div class="colum-row">
                    Platform Charge
                        <span>{{$value->platform_charge}}</span> @endforeach
                    </div>
                   

                    
                    
                    
                  
                    <div class="colum-row">
                        Consultant
                        <span>{{$va->users->name}}</span>
                    </div>
                   
                    <div class="colum-row">
                        Status
                        <span>{{$va->status}}</span>
                    </div>
                    <div class="colum-row">
                        Created on
                        <span>10 May 2021 3:42PM</span>
                    </div>

                    @endforeach
                </div>
                <div class="col-lg-9 tab-section">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Quatation</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Invoice</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> Log history</button>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                            <div class="col text-end mt-15 mb-15">
                                <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#generateQuotation">Generate Quotation</button>
                            
                            
                            <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#log">
                Licence Add</a></button>
                </div>
                            <table class="table table-striped table-hover mt-15">
                                <thead>
                                    <tr>
                                    <th scope="col">Company name</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quotation Amount</th>
                                        <th scope="col">Quotation Number</th>
                                        <th scope="col">Quotation Status</th>
                                        <th scope="col">Counsultant</th>
                                        
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($qlist as $value)                          
                    <tr>
                    
                        <td>{{$value->clients->company_name}}</td>

                        <td>{{$value->products->product}}</td>
                        
                        <td>{{$value->quotation_amount}}  </td>
                        <td>{{$value->quotation_no}}  </td>
                        <td>{{$value->status}}  </td>
                        <td>{{$value->users->name}}</td>
                        
                        <td>{{$value->created}}</td>
                        @if($value->status == "not_paid")
                        <td><button type="button" onclick="add({{$value->id}})" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#example">MARK AS PAID</button></td>
                      @else
                      <td><button type="button"  class="primary-btn custom-btn add" data-bs-toggle="modal" >PAID</button></td>
                      @endif
                      
                       <form action="pdf" method="post">
                       @csrf
                       <input type="hidden" value="{{$value->id}}" name="id" >
                        <td><button type="submit"  class="primary-btn custom-btn add" data-bs-toggle="modal" >PDF</button></td>
                        </form>
                        
                        <td><button type="button" onclick="licenseadd({{$value->id}},{{$value->products->id}})" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#log">License Add</button></td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><table class="table table-striped table-hover mt-15">
                                <thead>
                                    <tr>
                                    <th scope="col">Company name</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quotation Amount</th>
                                        <th scope="col">Quotation Number</th>
                                       
                                           
                                        <th scope="col">Payment</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    @foreach($invoice as $value)                          
                    <tr>
                    
                        <td>{{$value->clients->company_name}}</td>

                        <td>{{$value->products->product}}</td>
                        
                        <td>{{$value->quotation_amount}}  </td>
                        <td>{{$value->quotation_no}}  </td>
                        <td>{{$value->payment}}  </td>
                        <td>{{$value->created}}  </td>
                        <form action="invoice_pdf" method="post">
                       @csrf
                       <input type="hidden" value="{{$value->id}}" name="id" >
                        <td><button type="submit"  class="primary-btn custom-btn add" data-bs-toggle="modal" >PDF</button></td>
                                   </form>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table></div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><table class="table table-striped table-hover mt-15">
                                <thead>
                                    <tr>
                                       
                                        
                                    <th scope="col">previous licence</th>
                        <th scope="col">current licence</th>
                        <th scope="col">name</th>
                        <th scope="col">current date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($ldata as $value)
                    <tr>
                        <td>{{$value->previous_licence}}</td>
                        <td>{{$value->current_licence}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->current_date}}</td>
                    </tr>
                    @endforeach
                                
                                </tbody>
                            </table></div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="generateQuotation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Quatation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                   

                   
                    <form name="myForm" action="quotationadding" method="post">
            @csrf
            @foreach($data as $va)
            <div class="col-md-6">
            <input type="hidden" name="client_id" value="{{$va->id}}">
            Company name:<h6>{{$va->company_name}}</h6>
            
            Email:
            <h6>{{$va->email}}</h6>
            Address:
                  <h6>{{$va->address}}</h6>
                  Phone NO:
            @foreach($va->company_contacts as $value)      
            <h6>{{$value->contact_number}},</h6> @endforeach
                    
                       
                 
                  
                    </div>  </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label"> PRODUCT<span style="color:red" id="producterror">*</span></label></label>
                        <select  name="product_id"   class="dynamic">
                <option value="">SELECT PRODUCT</option>
                @foreach($va->carts as $value) 

                <option value="{{$value->products->id}}">{{$value->products->product}}</option>
                @endforeach
                            </select> 
                        
                  
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">QUATATION AMOUNT<span style="color:red" id="quotation_amount">*</span></label>
                        <input type="text" class="form-control"  name="quotation_amount" placeholder="" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">QUOTATION NUMBER<span style="color:red" id="quotation_no">*</span></label>
                        <input type="text" class="form-control" id="fill"  name="quotation_no" readonly placeholder="" aria-label="First name">
                    </div>
                    @endforeach
                    
                @foreach($use as $cvalu)
                <input type="hidden" value="{{$cvalu->id}}" name="user_id">
               
                @endforeach
                            
                            
                    

                </div>
                
            </div>
            <div class="modal-footer">

                <button type="submit" class="custom-btn save primary-btn"  onclick="return qadd();">Save</button>
                
                </form>
            </div>
        </div>
       
    </div>
</div>

<!---------------------log history popup----------------------------------->




<!-- Modal -->
<div class="modal fade" id="log" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Quatation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                   

                   
                    <form action="user/licence" method="post" enctype="multipart\form-data"name="myForm" onsubmit="return validateForm()">
                   @csrf
                         
                          
                   
                                


                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Previous licence</label>

                        @foreach($data as $va)
                        @foreach($va->carts as $value)  
                        <input type="text" class="form-control" name="previous_licence"value="{{$value->no_of_license}}">
                        @endforeach
                        @endforeach
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">current licence</label>
                        
                        <input type="text" class="form-control" name="current_licence">
                        
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Edited person</label>
                        
                        <input type="text" class="form-control" name="name">
                        
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Current date</label>
                        
                        <input type="date" class="form-control" name="current_date">
                        
                    </div>
                   
                </div>
            </div>
            <div class="modal-footer">

                <button type="submit" class="custom-btn save primary-btn" >Add licence</button>
                </form>

            </div>
        </div>
       
    </div>
</div>

<!------------------------------Mark as paid popup-------------------------------------->

<div class="modal fade" id="example" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate INVOICE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                    <form  action="invoice_adding" name="myForm" method="post">
            @csrf
            @foreach($data as $va)
            <div class="col-md-6">
            <input type="hidden" name="client_id" value="{{$va->id}}">
            Company name:<h6>{{$va->company_name}}</h6>
            
            Email:
            <h6>{{$va->email}}</h6>
            Address:
                  <h6>{{$va->address}}</h6>
                  Phone NO:
            @foreach($va->company_contacts as $value)      
            <h6>{{$value->contact_number}},</h6> @endforeach
                    
                       
                    @endforeach
                  
                    </div>  </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">PRODUCT<span style="color:red" id="product_id"></span></label>
                        <input type="text" class="form-control" readonly  id="edit_product" required name="product_id" placeholder="" aria-label="First name">
                        <input type="hidden" id="edit_productid" name="product_id">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">QUATATION AMOUNT<span style="color:red" id="quotation_amount"></span></label>
                        <input type="text" class="form-control" readonly id="edit_quotation_amount" required name="quotation_amount" placeholder="" aria-label="First name">
                  
                    </div>


                   
                        <input type="hidden" class="form-control" readonly id="edit_id" required name="id" placeholder="" aria-label="First name">
                  
                  

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">QUOTATION NUMBER<span style="color:red" id="quotation_no"></span></label>
                        <input type="text" class="form-control" readonly id="edit_quotation_no"required name="quotation_no"placeholder="" aria-label="First name">
                    </div>
                    


                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">PAYMENT AMOUNT<span style="color:red" id="payment">*</span></label>
                        <input type="text" class="form-control" required name="payment" placeholder="" aria-label="First name">
                    </div>

                </div>
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="custom-btn save primary-btn"  onclick="return invoiceadd();">Save</button>
           
                </form>
            </div>
        </div>
       
    </div>
</div>
















@include('footer')


<script>

function Random(){
    return Math.floor(Math.random() *25+1 );
   
}
document.getElementById('fill').value=Random();



function add(id)
{
    // alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
          if (xmlhttp.status == 200) {
            var resp = (JSON.parse(xmlhttp.responseText)); 
            console.log(resp.quotations);         
            document.getElementById("edit_product").value = resp.products.product;
            document.getElementById("edit_productid").value = resp.products.id;
            document.getElementById("edit_quotation_amount").value = resp.quotation_amount;
            document.getElementById("edit_id").value = resp.id;
            document.getElementById("edit_quotation_no").value = resp.quotation_no;
           

          }
          else if (xmlhttp.status == 400) {
             alert('There was an error 400');
          }
          else {
              alert('something else other than 200 was returned');
          }
       }
   };
   var requestVariable = 'http://localhost/company-management/public/admin/quotation/'+id;
   xmlhttp.open("GET", requestVariable, true);
   xmlhttp.send();
}











//----------------quotation validation---------------------------

function qadd() {


var product = document.forms["myForm"]["product_id"].value;

if (product == "" || product == 'Open this select menu')
{
    document.getElementById("producterror").innerHTML="Please Select product";
    return false;
}


  var quotation_amount=document.forms["myForm"]["quotation_amount"].value;
if(quotation_amount=="")
    {
        document.getElementById("quotation_amount").innerHTML="quotation_amount field is required";
        return false;
    }


    var quotation_no=document.forms["myForm"]["quotation_no"].value;
if(quotation_no=="")
    {
        document.getElementById("quotation_no").innerHTML="quotation_no field is required";
        return false;
    }

 
    var user_id=document.forms["myForm"]["user_id"].value;
if(user_id=="")
    {
        document.getElementById("user_id").innerHTML="user_id field is required";
        return false;
    }

 

}


//----------------------invoice validation--------------------------------------

function invoiceadd() {


 
 var payment=document.forms["myForm"]["payment"].value;
if(payment=="")
    {
        document.getElementById("payment").innerHTML="payment field is required";
        return false;
    }

 

}



</script>





@include('footer')
