<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
</head>
<body>
  


<div class="template-customer">
          <h1>Log in to your account</h1>
          <p>If you have an account please login</p>
          <div class="row" style="margin-top:50px;">
            <div class="col-md-6">
              <div class="wrapper-form">
                <form method='post' action="{{ url('login-post') }}">
                  @csrf
                  <p class="title"><span>Log in to your account</span></p>
                  <div class="form-group">
                    <label>Email:<b id="req">*</b></label>
                    <input type="email" class="input-control" name="email" required="">
                  </div>
                  <div class="form-group">
                    <label>Password:<b id="req">*</b></label>
                    <input type="password" class="input-control" name="password" required="">
                  </div>
                  <input type="submit" class="button" value="Login">
                  <a href="{{ url('forgotpassword') }}"  style="text-decoration: none;">Forgot password</a> </div>
                </form>
              </div>
            </div>
             <div class="col-md-6">
              <div class="wrapper-form">
             
                <p class="title"><span>Create a new account</span></p>
                <p>Sign up for an account to shop faster. Order tracking, shipping. Stay up to date with our events and discounts.</p>
                <a href="{{ url('register') }}" class="button">Register</a> </div>
            </div>
          </div>
        </div>
</body>
</html>