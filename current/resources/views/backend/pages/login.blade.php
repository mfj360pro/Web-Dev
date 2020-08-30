<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    {{$message['title']}} | MFJ 360 PRO
  </title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="{{ asset('backend/admin/argon/assets/js/plugins/nucleo/css/nucleo.css') }}"/>
  <link rel="stylesheet" href="{{ asset('backend/admin/argon/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('backend/admin/argon/assets/css/argon-dashboard.css?v=1.1.0') }}"/>
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-3">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">{{$message['welcome']}}</h1>
              <p class="text-lead text-light">{{$message['description']}}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <form class="form" method="post" action="/{{$message['access']}}/signin">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                      </div>
                      <input class="form-control" placeholder="Email" type="text" name="email">
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Password" type="password" name="password">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4">Login</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <footer class="py-5">
      <div class="container">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              © 2019 <a href="https://instagram.com/raymarkdelpuerto" class="font-weight-bold ml-1" target="_blank">Raymark del Puerto</a>
            </div>
          </div>
        </div>
      </div>
    </footer> -->

  </div>

  <!--   Core   -->
  <script src="{{ asset('backend/admin/argon/assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/admin/argon/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!--   Argon JS   -->
  <script src="{{ asset('backend/admin/argon/assets/js/argon-dashboard.min.js?v=1.1.0') }}"></script>
  
</body>

</html>