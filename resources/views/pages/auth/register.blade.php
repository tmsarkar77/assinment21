@extends('layouts.app')

@section('content')
<div class="register-box">
    <div class="register-logo">
      <a href="../../index2.html"><b>Sagor</b>Sarkar</a>
    </div>
  
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>
  
        <form>
          <div class="input-group mb-3">
            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text"  id="lastName" name="lastName" class="form-control" placeholder="Last Name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email"  id="email"  name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="number" id="mobile" name="mobile" class="form-control" placeholder="Mobile">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          
          <div class="row">
            
            <!-- /.col -->
            <div class="col-4">
              <button onclick="onRegistration()" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
     
  
        <a href="{{ route('login')}}" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>


<script>

    async function onRegistration(){

      let firstName = document.getElementById('firstName').value;
      let lastName = document.getElementById('lastName').value;
      let email = document.getElementById('email').value;
      let mobile = document.getElementById('mobile').value;
      let password = document.getElementById('password').value;

      console.log(firstName);
      console.log(lastName);
      console.log(email);
      console.log(mobile);
      console.log(password);

      if(firstName.length===0){
          toastr.error('First is Required')
      }else if(lastName.length===0){
          toastr.error('Last is Required')
      }else if(email.length===0){
          toastr.error('Email is Required')
      }else{

          let formData = {
                    firstName:firstName,
                    lastName:lastName,
                    email:email,
                    mobile:mobile,
                    password:password
                };

          let URL = "/UserRegistration";

          let result = await axios.post(URL,formData);

          if(result.status = 200 && result.data['status'] =='success' ){
                  toastr.success(result.data['message'])
                  setTimeout(function() {
                      window.location.href="/login"
                  }, 2000);
              }else{
                toastr.success(result.data['message'])
              }
           

      }


    }

    


</script>

@endsection