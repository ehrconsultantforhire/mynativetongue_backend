<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>My Native Tongue</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="icon" href="{{ asset('assets/dist/img/icon.png') }}"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/admin/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/admin/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/admin/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/admin/parsley.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>My Native Tongue </b><br>Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ url('login')}}" method="post" id="login-form">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Email" required="" data-parsley-type="email" data-parsley-trigger="change" data-parsley-checkemail data-parsley-required-message="This email field is required" data-parsley-errors-container="#email-error"   value="{{old('email')}}" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span><br>
            </div>
          </div>
        </div>
        <div id="email-error"></div>
        @if($errors->has('email'))
        <div class="error login-validation-error">{{ $errors->first('email') }}</div>
        @endif
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required=""  data-parsley-trigger="change" data-parsley-required-message="This password field is required" data-parsley-errors-container="#password-error" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div id="password-error"></div>
        @if($errors->has('password'))
        <div class="error login-validation-error">{{ $errors->first('password') }}</div>
        @endif
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            <!-- <p class="mb-1">
              <a href="forgot-password.html">I forgot my password</a>
            </p> -->
            </div>
          </div>
          <input type="hidden" name="user_type" value="admin">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="login-btn">Sign In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/admin/parsley.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/admin/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/admin/demo.js') }}"></script>
<script src="{{ asset('assets/dist/js/admin/jquery.cookie.js') }}"></script>

<script type="text/javascript">

$(document).ready(function () 
{
  bsCustomFileInput.init();

  $('#login-form').parsley();
  $('#login-btn').on('click',function()
  {
    if ($('#login-form').parsley().isValid()) 
    {
      var email = $('#email').val();
      var password = $('#password').val();
      $.cookie('email', email, { expires: 7 });
      $.cookie('password', password, { expires: 7 });
    }
  });

  var cookie_email = $.cookie('email');
  var cookie_password = $.cookie('password');
  if (cookie_email && cookie_password) 
  {
    // autofill the fields
    $('#email').val(cookie_email);
    $('#password').val(cookie_password);
  }
});

</script>
</body>
</html>
