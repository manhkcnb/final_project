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
          <h1>Get password</h1>
          <p>Enter gmail to retrieve your password</p>
          <div class="row" style="margin-top:50px;">
            <div class="col-md-6">
              <div class="wrapper-form">
                <form method='post' action="{{ url('backend/forgotPasswordPost') }}">
                  @csrf
                  <div class="form-group">
                    <label>Email:<b id="req">*</b></label>
                    <input type="email" class="input-control" name="email" required="">
                  </div>
              
                  <input type="submit" class="button" value="Password retrieval">
                 
                </form>
              </div>
            </div>
            <div class="col-md-6">
              <div class="wrapper-form">
              <a href="{{ url('backend/login') }}" class="button">Login</a> </div>
                
            </div>
          </div>
        </div>
</body>
</html>