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
          
          
          <div class="row" style="margin-top:50px;">
            <div class="col-md-6">
              <div class="wrapper-form">
                <form method='post' action="{{ url('passwordNew') }}">
                  @csrf
                 <input type="hidden" name="email" value="{{$email}}">
                  <div class="form-group">
                    <label>Enter your new password:<b id="req">*</b></label>
                    <input type="password" class="input-control" name="password" required="">
                  </div>
              
                  <input type="submit" class="button" value="Submit">
                 
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