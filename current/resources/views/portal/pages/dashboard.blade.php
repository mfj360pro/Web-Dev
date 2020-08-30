@extends('backend.shared._layout')

@section('content')
  
  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
      <p class="text-white display-2">Bonjour!</p>
    </div>
  </div>

  <div class="container-fluid mt--7">
      <div class="row">
          <div class="col">
              <div class="card shadow">                  
                  <div class="card-body border-0 pb-7">
                    <h3>Hi, {{ $data['firstname'] . ' ' . $data['lastname'] }}!</h3>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-inner--text">You have successfully logged in to the customer portal.</span>
                    </div>
                  </div>  
              </div>
          </div>
      </div>
      @include('backend.shared._footer')      
  </div>
        
@endsection

@section('script')
  <script type="text/javascript">
    setSideBar('#menu-dashboard');
  </script>    
@endsection