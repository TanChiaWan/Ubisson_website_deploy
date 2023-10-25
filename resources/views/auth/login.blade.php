@extends('layouts.login')

@section('content')
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.mintry.css" />
   
</head>
<title>
    Login
</title>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-6 d-flex align-items-center justify-content-center mt-3 mb-3">
            <img src="../assets/images/logos/LoginBioTectiveLogo.png" width="500" alt="" id="login_logo">
          </div>
          <div class="col-md-6">
            <div class="card mb-0">
              <div class="card-body">
              <form method="POST" action="{{ url('/login') }}">
              @csrf
                  <div class="mb-3">
                    <label for="login-input-oid" class="form-label">Organization ID</label>
                    <input type="text" class="form-control inputnumber" id="login-input-oid organizationid" name="organizationid" required>
                  </div>
                  <div class="mb-3">
                    <label for="login-input-username" class="form-label">Username</label>
                    <input type="text" class="form-control usernamefld" id="login-input-username username" name="username" required>
                  </div>
                  <div class="mb-4">
                    <label for="login-input-password" class="form-label">Password</label>
                    <input type="password" class="form-control passwordfld"  id="login-input-password password" name="password" required>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary remember" type="checkbox" name="remember" value="" id="flexCheckChecked remember" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remember Me
                      </label>
                    </div>
                    <a class="text-primary fw-bold" >Forgot Password ?</a>
                  </div>
                  <button  class="btn btn-primary w-100 py-8 fs-4 mb-2 rounded-2" type="submit" class=" loginbutton">
                  Sign In
                </button>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>



@endsection
