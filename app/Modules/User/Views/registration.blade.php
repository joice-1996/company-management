<div id="myDiv">
@include('header')
<main>
@include('menu')
    

    <div class="right-main">
        @include('topBar')

        <div class="main-wrapper">
            <div class="row page-head">
                <div class="col-md-8 page-name">
                    <h4>User List</h4>
                </div>
                <div class="col-md-4 page-head-right text-end">
                <!-- <button type="button" class="primary-btn custom-btn add">
                <a href="licence_log"class="primary-btn custom-btn add">Licence Add</a></button>
                <button type="button" class="primary-btn custom-btn add">
                <a href="licence_view"class="primary-btn custom-btn add">Licence View</a></button>
                 -->
                    <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>
                </div>
            </div>

            <div class="filter-div">
                <form action="" method="post"></form>
                <div class="row">
                    <h6>Filter</h6>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="search" placeholder="name,email,phone number,address" aria-label="First name">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="department_id" id="department_id" aria-label="Default select example">
                            <option value="" selected>Select Department</option>
                            @foreach($depart as $depart)
                            <option value="{{$depart->id}}">{{$depart->user_type}}</option>
                            @endforeach
                        </select>
                    </div>

                  

                   

                    <div class="filter-action-btn text-end">
                        <button type="button" class="btn btn-secondary">Reset</button>
                        <button type="button" onclick='filter();' class="btn btn-primary">Filter</button>

                    </div>

                </div>
                </form>

            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">employe_id</th>
                        <th scope="col">name</th>
                        <th scope="col">image</th>
                        <th scope="col">address</th>
                        <th scope="col">phone</th>
                        <th scope="col">gender</th>
                        <th scope="col">email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->employe_id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->image}}</td>
                        <td>{{$value->address}}</td>
                        <td>{{$value->phone}}</td>
                        <td>{{$value->gender}}</td>
                        <td>{{$value->email}}</td>
                        <td><button type="submit"  onclick="confirmation({{$value->id}})"  class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#example">DELETE</button>
                        <button type="submit" onclick="add({{$value->id}})" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#editModal">EDIT</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                                <form action="user_export" method="post">
                                @csrf
                                <input type="hidden"  value="" name="search_user" id="search_user">
                                <input type="hidden" value="" name="department_id" id="department_id1">
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
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-4 gy-3">
                <div class="row gx-3 gy-3">
                    <div class="col-md-6">
                   <form action="add" method="post" enctype="multipart\form-data" name="myForm" onsubmit="return validateForm()">
                   @csrf
                         
                           <label for="exampleFormControlInput1" class="form-label">Department</label>
                        

                            <select class="form-control" name="department" id="department">
                            <option value="" selected>Select Department</option>
                            @foreach($department as $department)
                            <option value="{{$department->id}}">{{$department->user_type}}</option>
                            @endforeach
                            
                            </select>
                       
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Employee_id</label>
                        <span class="text-danger " id="emp_id">*</span>
                        <input type="text" class="form-control"name="employe_id"  >
                    </div>
                    <div class="col-md-6">
                    <label for="image"  class="form-label"> Profile Photo </label>
                    <span class="text-danger " id="photo">*</span>
                    <input type="file" id="image" name="image">
                    
                    </div>
                                


                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <span class="text-danger " id="name">*</span>
                        <input type="text" class="form-control" name="name">
                        
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Address</label>
                        <span class="text-danger "id="address">*</span>
                        <input type="text" class="form-control" name="address">
                        
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Phone no</label>
                        <span class="text-danger " id="phone">*</span>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Gender</label>
                        <span class="text-danger " id="gender">*</span>
                        <input type="radio" name="gender" value="male"> Male
                        <input type="radio" name="gender" value="female"> Female
                        <input type="radio" name="gender" value="other"> Other
                        
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <span class="text-danger " id="email">*</span></br>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <span class="text-danger " id="password">*</span>
                        <input type="text" class="form-control" name="password">
                    </div>

                   
                </div>
            </div>
            <div class="modal-footer">

                <button type="submit" class="custom-btn save primary-btn" >Register</button>
                </form>

                   
<!-- update form -->

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-4 gy-3">
                <div class="row gx-3 gy-3">
                    <div class="col-md-6">
                   <form action="add" method="post" enctype="multipart\form-data"name="myForm" onsubmit="return validateForm()">
                   @csrf
                     >

                    </div>
                    

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <span class="text-light">*</span>
                        <input type="text" class="form-control"id="edit_name" name="name">
                        
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Address</label>
                        <span class="text-danger ">*</span>
                        <input type="text" class="form-control"id="edit_address" name="address">
                        
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Phone no</label>
                        <input type="text" class="form-control"id="edit_phone" name="phone">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Gender</label>
                        <span class="text-light">*</span><br>
                        <input type="radio" name="gender" value="male"> Male
                        <input type="radio" name="gender" value="female"> Female
                        <input type="radio" name="gender" value="other"> Other
                        
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="text" class="form-control"id="edit_email" name="email">
                    </div>
                    

                   
                </div>
            </div>
            <div class="modal-footer">

                <!-- <button type="submit" class="custom-btn save primary-btn" >Register</button> -->
                <button  type="button" class="custom-btn save primary-btn" onclick="validateForm();">Register</button>
            </div>
                </form>               
            </div>
        </div>
    </div>
</div>
</div>



<script>
                //validation function
                function validateForm() {

                    var x=document.forms["myForm"]["name"].value;
                    if (x==null || x=="")
                    {
                        document.getElementById("name").innerHTML="name is required";  
                    // alert("Name must be filled out");
                    return false;
                    }
                    var a=document.forms["myForm"]["address"].value;
                    if (a==null || a=="")
                    {
                        document.getElementById("address").innerHTML="address is required"; 
                    // alert("Address must be filled out");
                    return false;
                    }
                    var b=document.forms["myForm"]["phone"].value;
                    if (b==null || b=="")
                    {
                        document.getElementById("phone").innerHTML="phone is required"; 
                    return false;
                    }
                    var c=document.forms["myForm"]["email"].value;
                    if (c==null || c=="")
                    {
                        document.getElementById("email").innerHTML="email is required"; 
                    return false;
                    }
                    var d=document.forms["myForm"]["gender"].value;
                    if (d==null || d=="")
                    {
                        document.getElementById("gender").innerHTML="gender is required"; 
                    return false;
                    }
                    var y=document.forms["myForm"]["password"].value;
                    if (y==null || y=="") {
                        document.getElementById("password").innerHTML="password is required"; 
                    return false;
                    }
                    var e=document.forms["myForm"]["image"].value;
                    if (e==null || e=="") {
                        document.getElementById("photo").innerHTML="photo is required"; 
                    return false;
                    }
                    var f=document.forms["myForm"]["employe_id"].value;
                    if (f==null || f=="") {
                        document.getElementById("emp_id").innerHTML="employee id is required"; 
                    return false;
                    }
                }

                    
                    //addupdate function

//update funtion

function add(id) {
    

    var edit_xhttp;
    edit_xhttp = new XMLHttpRequest();
    edit_xhttp.onreadystatechange = function() {
    
    if (edit_xhttp.readyState == XMLHttpRequest.DONE && this.status == 200) {
        alert(id);
        var response = (JSON.parse(edit_xhttp.responseText)); 
      
        //document.getElementById("image").value = response.image;

        // var image=response.image;
        // if(image){
        //     document.getElementById("image").style.display='none';  
         
        // }
        // else{
        //     document.getElementById("image").style.display='';
        // }


        // var image = document.getElementById('image');
	    // image.src = URL.createObjectURL(resonse.image);
        //document.getElementById("image").innerHTML = response.image;
        document.getElementById("edit_name").innerHTML = response.name;
            document.getElementById("edit_address").value = responce.address;
            document.getElementById("edit_phone").innerHTML = responce.phone;

        // if(response.gender == 'male'){
        //     document.getElementById('male1').checked=true;
        // }else{
        //     document.getElementById('female1').checked=true;

        // }
       
        document.getElementById("email").value = response.email;
        document.getElementById("department_id").value = response.department_id;
        console.log(response);
    }
    //   else {
    //     alert('something else other than 200 was ret');
    //       }
    };

  edit_xhttp.open("GET", 'http://localhost/company-management/public/user/edit'+id, true);
  edit_xhttp.send();


}

//delete function
function confirmation(id) {
       var proceed= confirm("Are you sure to delete?");
       if(proceed){
           confirm("Are you sure to delete?");
       }
       else{
           cancel()
       }
       
    
        var requestVariable = 'http://localhost/company-management/public/user/delete/'+id;
        var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", requestVariable, true);
   xmlhttp.send();
   xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
          if (xmlhttp.status == 200) {
          //var resp = (JSON.parse(xmlhttp.responseText));
          var resp=xmlhttp.responseText;
          if (resp=='success'){

            alert('success');
            location.reload();
         
          }
      }
          
          else {
              alert('something else other than 200 was returned');
          }
       }
   };
}

 function filter()
    {
       
        var search=document.getElementById('search').value;
        var department=document.getElementById('department_id').value;
        var to_filter= {
        "search":search,
        "department_id":department,
        }
        var xmlhttp1 = new XMLHttpRequest();
       xmlhttp1.onreadystatechange = function() {
          if (xmlhttp1.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
             if (xmlhttp1.status == 200) {
               var resp = xmlhttp1.responseText;     
               document.getElementById("myDiv").innerHTML=resp;          
            //    document.write(resp);
               document.getElementById("department_id").value = department;
               document.getElementById("search").value = search;
               document.getElementByID("search_user").value=search;
               document.getElementByID("department_id1").value=department;

             }
             else if (xmlhttp1.status == 400) {
                alert('There was an error 400');
             }
             else {
                 alert('something else other than 200 was returned');
             }
          }
      };
      var requestVariable = 'http://localhost/company-management/public/user/user_search';
      xmlhttp1.open("POST", requestVariable, true);
       var data = new FormData();
       data.append('data',  JSON.stringify({to_filter}));
      xmlhttp1.send(data);
    }




                </script>
@include('footer')