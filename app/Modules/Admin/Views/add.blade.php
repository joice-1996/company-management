<form  method="post" action="c">
            @csrf
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">COMPANY NAME</label>
                        <select onchange="CountryFn()" name="client_id" required id="country" 
                        class="dynamic" data-dependent="state">
                <option value="">SELECT COMPANY</option>
                @foreach($data as $val)

                <option value="{{$val->id}}">{{$val->company_name}}</option>
                @endforeach
                            </select> 
                    </div>
                    
                    <button type="submit" class="custom-btn save primary-btn">Save</button>
                </div>
                </form>