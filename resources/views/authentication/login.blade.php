@include('layouts.header')
<link rel="stylesheet" href="{{ asset('css/login_style.css') }}">

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
     <img src="{{ asset('img/logo.png') }}" class="img-circle elevation-2" alt="User Image" style="width: 130px;"><br>
    <a href="../../index2.html"><b>{{ config('variables.appName') }}</b></a>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>


        <div class="input-group mb-3">
          <input type="text" class="form-control form-project username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fa-solid fa-user"></i>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control form-project password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            {{-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> --}}
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" onclick="do_login()">Sign In</button>
          </div>
        </div>
    </div>
  </div>
</div>


@include('layouts.footer')
<script>
 function do_login() {
        var username_val = $('.username').val();
        var password_val = $('.password').val();

        if (username_val == '') {
            error_alert("Username tidak boleh kosong");
            return false;
        } else if (password_val == '') {
            error_alert("Password tidak boleh kosong");
            return false;
        }

        $.ajax({
            type: 'GET',
            url: '{{url("do_login")}}',
            data: {
                username: username_val,
                password: password_val
            },
            success: function(response) {
                if (response.message == 'success') {
                    window.location = response.url;
                } else {
                  error_alert(response.message);
                    return false;
                }
            },
            error: function(error) {
                 error_alert(JSON.stringify(error));
            }
        });
 }

 $(document).on('keypress',function(e) {
    if(e.which == 13) {
        do_login();
    }
});
</script>


