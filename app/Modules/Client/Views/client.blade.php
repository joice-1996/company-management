<div id="myDiv">
@include('header')

<main>
   
    @include('menu')

    <div class="right-main">
        
        @include('topBar')

        <div class="main-wrapper">
            <div class="row page-head">
                <div class="col-md-8 page-name">
                    <h4>Client List</h4>
                </div>
                <div class="col-md-4 page-head-right text-end">
                    <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#exampleModal">New Client</button>
                </div>
            </div>
            <form action="" method="post">
                    @csrf
                <div class="filter-div">

                    <div class="row">
                        
                            <h6>Filter</h6>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="keyword" id="search" placeholder="name,phone number,branch name,email" aria-label="First name">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="product_id" id="product_id" aria-label="Default select example">
                                    <option value="" selected>Select Product</option>
                                    @foreach ($products as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select class="form-select" id="consultant_id" name="consultant_id" aria-label="Default select example">
                                    <option value="" selected>Select Consultant</option>
                                    @foreach ($consultants as $consultant)
                                     <option value="{{$consultant->id}}">{{$consultant->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select class="form-select" id="customization" name="customization" aria-label="Default select example">
                                    <option value="" selected>Customization</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            <div class="filter-action-btn text-end">
                                <button type="button" class="btn btn-secondary" onclick="reset();">Reset</button>
                                <button type="button" class="btn  primary-btn"  onclick="filter_data();">Filter</button>
                               
                            </div>
                    
                    </div> 

                </div>
            </form>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                       
                        <th scope="col">Company Name</th>
                        <th scope="col">Contact Person</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Branches</th>
                        <th scope="col">Email</th>
                        <th scope="col">Consultant</th>
                        <th scope="col">Product Name</th>    
                        <th scope="col">Action</th>    
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td><img src="{{asset('uploads/' .$client->company_logo)}} " id="proimage">{{"  ".$client->company_name}}</td>
                        <td>{{$client->contact_person}}</td>
                        <td>@foreach($client->company_phones as $phone)
                                {{$phone->contact_number}} </br>
                            @endforeach
                        </td>
                        <td>@foreach($client->company_branches as $braches)
                                {{$braches->branches}} </br>
                            @endforeach
                        </td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->consultant['name']}}</td>
                        <td>@foreach($client->company_cart_products as $cartproducts)
                                {{$cartproducts->products['product']}} </br>
                            @endforeach
                        </td>
                        <form action="admin/clientdetails" method="get">
                        <input type="hidden" value="{{$client->id}}" name="id" >
                        <td><button type="submit"  class="primary-btn custom-btn add" data-bs-toggle="modal" >VIEW DETAILS</button>
                        
                       </form> 
                     
                        <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick='edit_client({{$client->id}})'>Edit</button>
                        <button class="btn btn-default btn-primary" onclick='delete_client({{$client->id}})'>Delete</button>
                        <button class="btn btn-default btn-primary" onclick='deactivate_client({{$client->id}})'>Deactivate</button></td>  
                        </tr>
                    @endforeach
                </tbody>
            </table>
                                <form action="client/client_export" method="post">
                                @csrf
                                <input type="hidden"  value="" name="search_client" id="search_client">
                                <input type="hidden" value="" name="product_id" id="product_id1">
                                <input type="hidden" value="" name="consultant_id" id="consultant_id1">
                                <input type="hidden" value="" name="cust" id="cust">
                                <button type="submit"  class="btn primary-btn">Export</button>
                                </form>
            

        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" name="myForm" action="" method="post">
                    @csrf
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Company Name<span style="color:red" id="company_name">*</span></label>
                        <input type="text" class="form-control" name="company_name" id="company_names" placeholder="Enter Compay Name" aria-label="First name">
                    </div>

                    <div class="col-md-6 input_fields_wrap">
                        <label for="exampleFormControlInput1" class="form-label">Branches</label>
                       <!-- <div id="newlink">
                        <input type="text" class="form-control" placeholder="Enter branches here" id="branches" name="branches[]"  onclick="checkbranch();" aria-label="First name" id="brancehs">
                       </div>
                         <div id="addnew"><a href="javascript:new_link()">Add New </a></div>
                       <div id="newlinktpl" style="display:none">
                            <div><input type="text" name="branches[]" ></div>
                        </div>  -->
                        <input type="text" class="form-control" placeholder="Enter branches here" id="branches" name="branches[]"  onclick="checkbranch();" aria-label="First name" id="brancehs">
                       <!--  <button class="btn btn-default btn-primary btn-branch" id="btn-branch">Add New</button>
 -->
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Contact Person Name<span style="color:red" id="contact_person_name">*</span></label>
                        <input type="text" class="form-control" name="contact_person_name" id="contact_person_names" placeholder="Contact Person Name" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Email<span style="color:red" id="email">*</span></label>
                        <input type="text" class="form-control" name="email" id="emails" placeholder="Enter Email" aria-label="First name">
                    </div>

                    <div class="col-md-6 input_fields_wrap1">
                        <label for="exampleFormControlInput1" class="form-label">Phone Number<span style="color:red" id="phone_numbers">*</span></label>
                        <!-- <div id="newphone">
                        <input type="text" class="form-control" name="phone_numbers[]" id="phone" placeholder="Enter Phone Numbers" onclick="checkphone();" aria-label="First name">
                        </div>
                        <div id="addnew1"><a href="javascript:new_link1()">Add New </a></div>
                       <div id="newlinkphone" style="display:none">
                            <div><input type="text" name="phone_numbers[]" ></div>
                        </div> -->
                        <input type="text" class="form-control" name="phone_numbers[]" id="phone" placeholder="Enter Phone Numbers" onclick="checkphone();" aria-label="First name">
                        <!-- <button class="btn btn-default btn-primary btn-phone" id="btn-phone">Add New</button>
                    --> </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Address<span style="color:red" id="address">*</span></label>
                        <textarea  class="form-control" name="address" id="addresss" placeholder="Address here" aria-label="First name"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Company Logo<span style="color:red" id="company_logo">*</span></label>
                        <input type="file" class="form-control" name="company_logo" id="company_logoo" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Consultant<span style="color:red" id="conslutant">*</span></label>
                        <select name="consultant_id" class="form-control" id="consultant" name="consultant">
                            <option value="" selected>Open this select menu</option>
                           @foreach ($consultants as $consultant)
                           <option value="{{$consultant->id}}">{{$consultant->name}}</option>
                           @endforeach
                        </select>
                    </div>

                </div>
                <div class="row gx-4 gy-3 border rounded bg-secondary mt-3 p-3">
                <h5 class="text-center" id="exampleModalLabel">Product Details</h5>
                    <div class="col-md-6 ">
                        <label for="exampleFormControlInput1 " class="form-label text-white">Product<span style="color:red" id="productnameEr">*</span></label>
                        <select name="consultant_id" class="form-control" name="productname" id="productname">
                            <option value="" selected>Open this select menu</option>
                           
                            @foreach ($products as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                           
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Start Date<span style="color:red" id="start_dateEr">*</span></label>
                        <input type="date" class="form-control" placeholder="License Amount" name="start_date" id="start_date" onclick="start_date();" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Expiry Date<span style="color:red" id="expiry_dateEr">*</span></label>
                        <input type="date" class="form-control" placeholder="License Amount" name="expiry_date" id="expiry_date" onclick="expiry_date();" aria-label="First name">
                    </div>

                    <div class="col-md-6 " >
                        <label for="exampleFormControlInput1" class="form-label text-white">Customize<span style="color:red" id="cust">*</span></label>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" id="inlineCheckbox1" name="cust" value="yes" onclick="customize();">
                            <label class="form-check-label" for="inlineCheckbox1" >Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox2" value="no" name="cust" onclick="customize();">
                            <label class="form-check-label" for="inlineCheckbox2">No</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">No.of Licence<span style="color:red" id="licenseEr">*</span></label>
                        <input role="spinbutton" aria-valuemax="20" class="form-control" name="license" id="license" aria-valuemin="0" aria-valuenow="0" type="number" value="0">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">License Amount<span style="color:red" id="license_amountEr">*</span></label>
                        <input type="text" class="form-control" placeholder="License Amount" name="license_amount" id="license_amount" aria-label="First name">
                    </div>

                    <div class="customize" id="customize">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Customization Description</label>
                        <textarea  class="form-control" name="customization_description" id="customization_description" placeholder="Description here" aria-label="First name"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Customization Amount</label>
                        <input type="text" class="form-control" name="customization_amount" id="customization_amount" placeholder="Customization Amount" aria-label="First name">
                    </div>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Installation Charge<span style="color:red" id="installation_chargeEr">*</span></label>
                        <input type="text" class="form-control" name="installation_charge" id="installation_charge" placeholder="Installation Amount" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Platform Charge<span style="color:red" id="platform_chargeEr">*</span></label>
                        <input type="text" class="form-control" name="platform_charge" id="platform_charge" placeholder="Platform  Amount" aria-label="First name">
                    </div>
                    
                    <button type="button"  id="productAdd" class="custom-btn save primary-btn" onclick="productAddToCart({{$products}});">Add To Cart</button>
                </div>
                <div class="container table1" id="table1">
                <div class="row">
                 <div class="col-sm-6">
            <h2>List Products</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <table id="productTable" class="table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Start Date</th>
                        <th>Expiry Date</th>
                        <th>No.of License</th>
                        <th>License Amount</th>
                        <th>Customization Description</th>
                        <th>Customization Amount</th>
                        <th>Installation Charge</th>
                        <th>Platform Charge</th>
                        <th>Delete</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
            </div>
            <div class="modal-footer">

                <button type="button" class="custom-btn save primary-btn" onclick="validate_clientForm();" >Save</button>
            </div>
        </div>
    </div>
</form>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" name="myForm1" action="" method="post">
                    @csrf
                    <input type="hidden" name="id" id="client_id" >
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Company Name<span style="color:red" id="comp_nameEr"></span></label>
                        <input type="text" class="form-control" name="company_name" id="comp_name" placeholder="Enter Compay Name" aria-label="First name">
                    </div>

                    <div class="col-md-6 input_fields_wrap">
                        <label for="exampleFormControlInput1" class="form-label">Branches</label>
                       <!-- <div id="newlink">
                        <input type="text" class="form-control" placeholder="Enter branches here" id="branches" name="branches[]"  onclick="checkbranch();" aria-label="First name" id="brancehs">
                       </div>
                         <div id="addnew"><a href="javascript:new_link()">Add New </a></div>
                       <div id="newlinktpl" style="display:none">
                            <div><input type="text" name="branches[]" ></div>
                        </div>  -->
                        <input type="text" class="form-control" placeholder="Enter branches here" id="branch" name="branches[]"  aria-label="First name" id="brancehs">
                        

                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Contact Person Name<span style="color:red" id="contact_personEr"></span></label>
                        <input type="text" class="form-control" name="contact_person_name" id="contact_person" placeholder="Contact Person Name" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Email<span style="color:red" id="email"></span></label>
                        <input type="text" class="form-control" name="emails" id="email1" placeholder="Enter Email" aria-label="First name">
                    </div>

                    <div class="col-md-6 input_fields_wrap1">
                        <label for="exampleFormControlInput1" class="form-label">Phone Number<span style="color:red" id="phone_noEr"></span></label>
                        <!-- <div id="newphone">
                        <input type="text" class="form-control" name="phone_numbers[]" id="phone" placeholder="Enter Phone Numbers" onclick="checkphone();" aria-label="First name">
                        </div>
                        <div id="addnew1"><a href="javascript:new_link1()">Add New </a></div>
                       <div id="newlinkphone" style="display:none">
                            <div><input type="text" name="phone_numbers[]" ></div>
                        </div> -->
                        <input type="text" class="form-control" name="phone_numbers[]" id="phone_no" placeholder="Enter Phone Numbers" onclick="checkphone();" aria-label="First name">
                        
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Address<span style="color:red" id="addrsEr"></span></label>
                        <textarea  class="form-control" name="address" id="addrs" placeholder="Address here" aria-label="First name"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Company Logo</label>
                        
                        <input type="file" class="form-control" name="company_logo" id="comp_logo" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Consultant<span style="color:red" id="conslutantEr"></span></label>
                        <select  class="form-control" id="user_id1" name="consult">
                            <option value="" selected>Open this select menu</option>
                           @foreach ($consultants as $consultant)
                           <option value="{{$consultant->id}}">{{$consultant->name}}</option>
                           @endforeach
                        </select>
                    </div>

                </div>
               <!--  <div class="row gx-4 gy-3 border rounded bg-secondary mt-3 p-3 product_add">
                <h5 class="text-center" id="exampleModalLabel">Product Details</h5>
                    <div class="col-md-6 ">
                        <label for="exampleFormControlInput1 " class="form-label text-white">Product<span style="color:red" id="productnameEr">*</span></label>
                        <select name="consultant_id" class="form-control" name="productname" id="productname">
                            <option value="" selected>Open this select menu</option>
                           
                            @foreach ($products as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                           
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Start Date<span style="color:red" id="start_dateEr">*</span></label>
                        <input type="date" class="form-control" placeholder="License Amount" name="start_date" id="start_date" onclick="start_date();" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Expiry Date<span style="color:red" id="expiry_dateEr">*</span></label>
                        <input type="date" class="form-control" placeholder="License Amount" name="expiry_date" id="expiry_date" onclick="expiry_date();" aria-label="First name">
                    </div>

                    <div class="col-md-6 " >
                        <label for="exampleFormControlInput1" class="form-label text-white">Customize<span style="color:red" id="cust">*</span></label>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" id="inlineCheckbox1" name="cust" value="yes" onclick="customize();">
                            <label class="form-check-label" for="inlineCheckbox1" >Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox2" value="no" name="cust" onclick="customize();">
                            <label class="form-check-label" for="inlineCheckbox2">No</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">No.of Licence<span style="color:red" id="licenseEr">*</span></label>
                        <input role="spinbutton" aria-valuemax="20" class="form-control" name="license" id="license" aria-valuemin="0" aria-valuenow="0" type="number" value="0">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">License Amount<span style="color:red" id="license_amountEr">*</span></label>
                        <input type="text" class="form-control" placeholder="License Amount" name="license_amount" id="license_amount" aria-label="First name">
                    </div>

                    <div class="customize" id="customize">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Customization Description</label>
                        <textarea  class="form-control" name="customization_description" id="customization_description" placeholder="Description here" aria-label="First name"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Customization Amount</label>
                        <input type="text" class="form-control" name="customization_amount" id="customization_amount" placeholder="Customization Amount" aria-label="First name">
                    </div>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Installation Charge<span style="color:red" id="installation_chargeEr">*</span></label>
                        <input type="text" class="form-control" name="installation_charge" id="installation_charge" placeholder="Installation Amount" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-white">Platform Charge<span style="color:red" id="platform_chargeEr">*</span></label>
                        <input type="text" class="form-control" name="platform_charge" id="platform_charge" placeholder="Platform  Amount" aria-label="First name">
                    </div>
                    
                    <button type="button"  id="productAdd" class="custom-btn save primary-btn" onclick="productAddToCart({{$products}});">Add To Cart</button>
                </div> -->
                <div class="container table2" id="table2">
                <div class="row">
                 <div class="col-sm-6">
            <h2>List Products</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6  " id="table_data">
            
        </div>
    </div>
</div>
            </div>
            <div class="modal-footer">

                <button type="button" class="custom-btn save primary-btn" onclick="update_client();" >Update</button>
            </div>
        </div>
    </div>
</form>
</div>

</div>

@include('footer')
<link rel="stylesheet" href="{{asset('css/clientStyle.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/cart.js')}}"></script>
<script src="{{asset('js/client.js')}}"></script>
<script src="{{asset('js/filter.js')}}"></script>
<!-- <script src="{{asset('js/clientValidation.js')}}"></script> -->