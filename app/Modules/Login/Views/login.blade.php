
@include('header')

<section class="login-wrapper">
    <div class="login-middle">
        <div class="text-center">
        <img src="public/images/login-logo.svg" width="260" />
</div>
<form  method="post" action="login/logsearch">
@csrf
        <div class="form-wrapper">
        
            <h4 class="text-uppercase">Login</h4>
            <div class="">
                <input type="email" name="email" class="form-control"  placeholder="Username">
                
            </div>
            <div class="">
                <input type="password" name="password" class="form-control" placeholder="Password">
      
            </div>
            
            <div class="text-center">
                <button type="submit" class="primary-btn">Login</button>
            </div>
            
            <p class="text-center forgot-pass">
                <u><a href="">Forgot Password?</a></u>
            </p>

        </div>
        </form>
    </div>

</section>

@include('footer')