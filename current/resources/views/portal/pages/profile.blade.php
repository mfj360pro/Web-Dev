@extends('backend.shared._layout')

@section('css')
    
@endsection

@section('content')
      
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 300px; background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-red opacity-8"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <h1 class="display-2 text-white">Hello, {{$data['firstname']}}!</h1>
                    <p class="text-white mt-0 mb-5">
                        This is your profile page. Here you can change your password, address and even upload your profile photo and company logo.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7 mb-7">
        <div class="row">
            <div class="col-lg-8 mb-3">
                <form method="post" action="{{ url('/WebService/UpdateAccountInfo') }}" enctype="multipart/form-data">
                    <input value="{{$data['id']}}" name="id" type="text" class="form-control form-control-alternative" hidden>
                    <div class="card bg-secondary shadow">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img src="/storage/{{$data['avatar']}}" alt="avatar" class="img-thumbnail">
                                        <input id="avatar" name="avatar" type="file" class="form-control form-control-alternative">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">First Name</label>
                                        <input value="{{$data['firstname']}}" name="firstname" type="text" class="form-control form-control-alternative">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Last Name</label>
                                        <input value="{{$data['lastname']}}" name="lastname" type="text" class="form-control form-control-alternative">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Phone Number</label>
                                        <input value="{{$data['phone']}}" name="phone" type="text" class="form-control form-control-alternative" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input value="{{$data['email']}}" name="email" type="text" class="form-control form-control-alternative" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Address</label>
                                        <input value="{{$data['address']}}" name="address" class="form-control form-control-alternative" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Password <span style="font-weight: 100">(leave blank to remain unchanged)</span></label>
                                        <input name="password" name="password" type="password" class="form-control form-control-alternative" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-sm btn-success">Save</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-lg-4 mb-3">
                <form method="post" action="{{ url('/WebService/UpdateCompanyInfo') }}" enctype="multipart/form-data">
                    <input value="{{$data['id']}}" name="id" type="text" class="form-control form-control-alternative" hidden>
                    <div class="card bg-secondary shadow">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Company information</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <img src="/storage/{{$data['company_logo']}}" alt="CompanyPicture" class="img-thumbnail">
                                        <input name="company_logo" type="file" class="form-control form-control-alternative">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Company Name</label>
                                        <input value="{{$data['company_name']}}" name="company_name" type="text" class="form-control form-control-alternative">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Address</label>
                                        <input value="{{$data['company_address']}}" name="company_address" type="text" class="form-control form-control-alternative">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Slogan</label>
                                        <textarea name="company_slogan" class="form-control form-control-alternative" cols="30" rows="10">{{$data['company_slogan']}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-sm btn-success">Save</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('script')

    <script type="text/javascript"> 

        setSideBar('#menu-profile');

        function UpdateAccountInfo(element) {
            
            var data = {
                id          : "{{$data['id']}}",
                firstname   : $('#firstname').val(),
                lastname    : $('#lastname').val(),
                phone       : $('#phone').val(),
                email       : $('#email').val(),
                address     : $('#address').val(),
                password    : $('#password').val(),
                avatar      : $('#avatar').val()
            };

            element.textContent = 'Saving ...';
            Controller.Create('/WebService/UpdateAccountInfo', data).done(function() {
                element.textContent = 'Save';
            });

        };

        function UpdateCompanyInfo(element) {
            
            var data = {
                id              : "{{$data['id']}}",
                company_name    : $('#company_name').val(),
                company_address : $('#company_address').val(),
                company_slogan  : $('#company_slogan').val(),
                company_logo    : $('#company_logo').val()
            };

            console.log(data);

            element.textContent = 'Saving ...';
            Controller.Create('/WebService/UpdateCompanyInfo', data).done(function() {
                element.textContent = 'Save';
            });

        };

    </script>
	
@endsection