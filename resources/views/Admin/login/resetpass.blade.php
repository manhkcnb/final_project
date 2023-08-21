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
          <p>Enter the code sent to your mailbox</p>
          <div class="row" style="margin-top:50px;">
            <div class="col-md-6">
              <div class="wrapper-form">
                <form method='post' action="{{ url('backend/resetPost') }}">
                  @csrf
                  <div class="form-group">
                    <input type="hidden" name="email" value="{{$email}}">
                    <label>Code:<b id="req">*</b></label>
                    <input type="text" class="input-control" name="code" required="">
                  </div>
              
                  <input type="submit" class="button" value="Submit">
                 
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