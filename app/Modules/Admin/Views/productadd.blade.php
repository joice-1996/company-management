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
                    <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#exampleModal">Add PRODUCT</button>
                </div>
               
            </div>

            <div class="filter-div">

                <div class="row">
                    <h6>Filter</h6>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Keyword Search" aria-label="First name">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="filter-action-btn text-end">
                        <button type="button" class="btn btn-secondary">Reset</button>
                        <button type="button" class="btn btn-primary">Filter</button>

                    </div>

                </div>

            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">PRODUCT NAME</th>
                        <th scope="col">PRODUCT DESCRIPTION</th>
                        <th scope="col">ACTION</th>
                        
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                    <tr>
                       
                        <td>{{$value->product}}</td>
                        <td>{{$value->description}}</td>
                        <td><button type="button" onclick=" return add({{$value->id}})" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#example">DELETE</button></td>
                        
                    </tr>
                   
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form name="myForm" method="post" action="productadding">
            
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">PRODUCT NAME<span style="color:red" id="product"></span></label>
                        <input type="text" name="product" class="form-control" placeholder="" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" required class="form-label">PRODUCT DESCRIPTION</label>
                        <textarea name="description" required class="form-control" placeholder="" aria-label="First name">
                        </textarea>
                    </div>

                   
                </div>
            </div>
            <div class="modal-footer">

            <button type="submit" class="custom-btn save primary-btn"  onclick="return productadd();">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>













@include('footer')


<script>

function add(id) {
    //alert(id);
    var proceed= confirm("Are you sure to delete?");
       if(proceed){
           confirm("Are you sure to delete?");
       }
       else{
           cancel()
       }
       
    
        var requestVariable = 'http://localhost/company-management/public/admin/product/'+id;
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
   };}



function adddd(id)
{
     alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
          if (xmlhttp.status == 200) {
            var resp = (JSON.parse(xmlhttp.responseText)); 
            console.log(resp.product);         
            document.getElementById("edit_product").value = resp.product;
            document.getElementById("edit_description").innerHTML = resp.description;
           

          }
          else if (xmlhttp.status == 400) {
             alert('There was an error 400');
          }
          else {
              alert('something else other than 200 was returned');
          }
       }
   };
   var requestVariable = 'http://localhost/company-management/public/admin/product/'+id;
   xmlhttp.open("GET", requestVariable, true);
   xmlhttp.send();
}






//-------------------validation--------------------------------------

function productadd() {


var product = document.forms["myForm"]["product"].value;

if (product == "")
{
    document.getElementById("product").innerHTML=" product field is required";
    return false;
}


  var description=document.forms["myForm"]["description"].value;
if(description=="")
    {
        document.getElementById("description").innerHTML="quotation_amount field is required";
        return false;
    }

}

</script>