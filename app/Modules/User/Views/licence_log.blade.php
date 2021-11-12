       <html>
       <head></head>
       <title></title>
       <body>
       @include('header')
       <main>

       @include('menu')
    

    <div class="right-main">
        @include('topBar')

        <div class="main-wrapper">
            <div class="row page-head">
                <div class="col-md-8 page-name">
                <h2>Licence Add</h2>
                </div>
     
            <form action="licence" method="post" enctype="multipart\form-data"name="myForm" onsubmit="return validateForm()">
                   @csrf
                         
                          
                   
                                


                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Previous licence</label>
                        @foreach($data as $value)
                        <input type="text" class="form-control" name="previous_licence"value="{{$value->no_of_license}}">
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
</main>
        </body>
        </html>
                        
