<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
  <title></title>
</head>
<body>
<div class="template-customer" style="padding-top:0px">
          <h2>Sign up for an account</h2>
          <p> If you do not have an account, register now to receive special offers and promotions from the store.</p>
          <div class="row" style="margin-top:50px;">
            <div class="col-md-6">
              <div class="wrapper-form">
                <form method='post' action="{{ url('register-post') }}">
                  @csrf
                  <p class="title"><span>Sign up for an account</span></p>
                  <div class="form-group">
                    <label>First and last name:</label>
                    <input type="text" name="name" class="input-control">
                  </div>
                  <div class="form-group">
                    <label>Email:<b id="req">*</b></label>
                    <input type="text" name="email" class="input-control" required>
                  </div>
                  <div class="form-group">
                    <label>Address:</label>
                    <input type="text" name="address" class="input-control">
                  </div>
                  <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="phone" class="input-control">
                  </div>
                  <div class="form-group">
                    <label>Password:<b id="req">*</b></label>
                    <input type="password" name="password" class="input-control" required="">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="button" value="Đăng ký">
                  </div>
                </form>
              </div>
            </div>
             <div class="col-md-6">
              <div class="wrapper-form">
              <a href="{{ url('login') }}" class="button">Login</a> </div>
                <p class="title"><span>Create a new account</span></p>
                <p>Sign up for an account to shop faster. Order tracking, shipping. Stay up to date with our events and discounts.</p>
                <a href="{{ url('register') }}" class="button">Register</a> </div>
            </div>
          </div>
</div>
</body>
</html>