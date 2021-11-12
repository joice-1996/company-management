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
                    <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>
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
                        <th scope="col">COMPANY NAME</th>
                        <th scope="col">COMPANY PERSON</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">ADDRESS</th>
                        <th scope="col">ACTION</th>
                        
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                    <tr>
                       
                        <td>{{$value->company_name}}</td>
                        <td>{{$value->company_person}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->address}}</td>
                        <form action="clientdetails" method="get">
                        <input type="hidden" value="{{$value->id}}" name="id" >
                        <td><button type="submit"  class="primary-btn custom-btn add" data-bs-toggle="modal" >VIEW DETAILS</button></td>
                        
                       </form>
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
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">xxx</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">xxx</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">xxx</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">xxx</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="custom-btn save primary-btn">Save</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="example" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form  method="post" action="productadding">
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">PRODUCT NAME</label>
                        <input type="text" name="product"  value="b" class="form-control" placeholder="" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">PRODUCT DESCRIPTION</label>
                        <textarea name="description" value="a" class="form-control" placeholder="" aria-label="First name">
                        </textarea>
                    </div>

                   
                </div>
            </div>
            <div class="modal-footer">

                <button type="submit" class="custom-btn save primary-btn">Save</button>
                </form>
            </div>
        </div>


    </div>
</div>





@include('footer')


<script>

function add(id)
{
    alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
          if (xmlhttp.status == 200) {
            //var resp = (JSON.parse(xmlhttp.responseText));          
            document.getElementById("product").innerHTML = str;
            document.getElementById("description").innerHTML = str;
           // document.getElementById("desc").innerHTML = str;

          }
          else if (xmlhttp.status == 400) {
             alert('There was an error 400');
          }
          else {
              alert('something else other than 200 was returned');
          }
       }
   };
   var requestVariable = 'http://localhost/company-management/public/client/'+id;
   xmlhttp.open("GET", requestVariable, true);
   xmlhttp.send();
}


</script>








