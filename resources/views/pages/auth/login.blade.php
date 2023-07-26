@extends('layouts.app')

@section('content')

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Sagor</b>Sarkar</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <div>
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button onclick="SubmitLogin()" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </div>

   
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ route('sendOtpToUserEmail')}}">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('registerPage')}}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

  <script>

      async function SubmitLogin(){

              let email = document.getElementById('email').value;
              let password = document.getElementById('password').value;
              
              if(email.length===0){
                  toastr.error('email is Required')
             }else if(password.length===0){
                  toastr.error('password is Required')
             }else{
                let res = await axios.post("/user-login",{ email:email, password:password });

                if(res.status = 200 && res.data['status'] =='success' ){
                      toastr.success(res.data['message']);
                      window.location.href="/dashboard";                
                }else{
                      toastr.success(res.data['message'])
                }

             }

        }

  </script>


@endsection