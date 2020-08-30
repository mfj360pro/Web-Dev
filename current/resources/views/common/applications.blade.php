@extends('common.shared._layout')

@section('title')
    {!! $data['title'] !!} | MFJ 360 PRO
@endsection

@section('css')
    <link rel="stylesheet" href="bs-stepper/css/bs-stepper.min.css">
    <style>
        .custom-checkbox > * {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
<main class="mt-5 pt-5">

    <div id="contact" class="mt-5 container">
        <div class="row wow fadeIn">
            <div class="col-md-12 text-center">
                <h1 class="h1 font-titillium mb-3">{!! $data['title'] !!}</h1>
            </div>
        </div>
        <div class="row justify-content-center container">
            <div class="col-md-12 mb-4">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#step-1">
                            <button type="button" class="step-trigger" role="tab" aria-controls="step-1" id="step-1-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Basic Info</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-2">
                            <button type="button" class="step-trigger" role="tab" aria-controls="step-2" id="step-2-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Photography Jobs</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-3">
                            <button type="button" class="step-trigger" role="tab" aria-controls="step-3" id="step-3-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Resume</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-4">
                            <button type="button" class="step-trigger" role="tab" aria-controls="step-4" id="step-4-trigger">
                                <span class="bs-stepper-circle">4</span>
                                <span class="bs-stepper-label">Finish</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="step-1" class="content" role="tabpanel" aria-labelledby="step-1-trigger">

                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 text-left">

                                            <label for="email">Email Address</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="email" required>
                                                <div class="invalid-feedback">
                                                    Please provide an email address.
                                                </div>
                                            </div>

                                            <label for="name">Full Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="name" required>
                                                <div class="invalid-feedback">
                                                    Please provide your fullname.
                                                </div>
                                            </div>

                                            <label for="phone">Phone</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="phone-prepend">+</span>
                                                </div>
                                                <input type="text" class="form-control" id="phone" aria-describedby="phone-prepend" required>
                                                <div class="invalid-feedback">
                                                    Please provide a phone number.
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button onclick="Submit(1)" class="btn btn-md btn-default">Next</button>
                                </div>
                            </div>

                        </div>
                        <div id="step-2" class="content" role="tabpanel" aria-labelledby="step-2-trigger">

                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 text-left">

                                            This is where we need them to add jobs so address name phone number and how many years..
                                            they need to be able to add more then one..

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button onclick="Back(1)" class="btn btn-md btn-default">Back</button>
                                    <button onclick="Submit(2)" class="btn btn-md btn-default">Next</button>
                                </div>
                            </div>

                        </div>
                        <div id="step-3" class="content" role="tabpanel" aria-labelledby="step-3-trigger">

                            <div class="card">
                                <div class="card-body text-center">
                                    <div id="services_items_container" class="row">
                                        <p id="service-prompt" class="d-none alert text-danger float-left text-left">Sorry, our services are not available in your area yet.</p>

                                        <div id="services_item" class="col-md-4 mb-4 d-none" style="height: 100%;">
                                            I need them to be able to upload there resume here
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button onclick="Back(2)" class="btn btn-md btn-default">Back</button>
                                    <button id="btnSubmit" onclick="Submit(3)" class="btn btn-md btn-default">Submit</button>
                                </div>
                            </div>

                        </div>
                        <div id="step-4" class="content" role="tabpanel" aria-labelledby="step-4-trigger">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-12 text-muted" style="font-weight: 700;">
                                            <h5>You will receive an email shortly.</h5>
                                            <h5>Thank you for choosing MFJ 360 Pro!</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p id="alert" class="d-none alert float-left text-left" style="font-weight: 800;"></p>
                </div>
            </div>
        </div>
    </div>


</main>

@endsection

@section('script')

    <script src="bs-stepper/js/bs-stepper.min.js"></script>
    <script type="text/javascript">


    </script>
    <script type="text/javascript">

        var stepper             = new Stepper($('.bs-stepper')[0]);
        var data                = [];
        var services            = [];
        var quantities          = [];
        var zipcode             = '';
        var service_quantity    = [];

        function SelectService(pricing_id) {
            if(services.indexOf(pricing_id) > -1)
                services.splice(services.indexOf(pricing_id), 1);
            else services.push(pricing_id);
        }

        function Back(step) {
            stepper.previous();
        }

        function Submit(step) {

            var _data = {
                name                : $('#name').val(),
                email               : $('#email').val(),
                phone               : $('#phone').val(),
                address             : $('#location').val(),
                zipcode             : zipcode,
                services            : services,
                quantity            : quantities,
                notes               : '',//$('#notes').val(),
                step                : step,
                service_quantity    : service_quantity
            }

            switch (step) {
                case 1:

                    Controller.Create('/quotation/validate', _data).done(function(result) {
                        $('#alert').fadeIn(1000);
                        $('#alert').removeClass('d-none');
                        $('#alert').removeClass('text-danger');
                        $('#alert').removeClass('text-success');
                        $('#alert').addClass(result.status);
                        if(result.status_code == 0) {
                            var _alert = document.getElementById('alert');
                            if(result.message.email)    $('#email').addClass('is-invalid');
                            if(result.message.name)     $('#name').addClass('is-invalid');
                            if(result.message.phone)    $('#phone').addClass('is-invalid');
                        }
                        // else $('#alert').text(result.message);
                        setTimeout(function() {
                            $('#alert').fadeOut(1000);
                            $('#btn-submit').text('Submit');
                        }, 3000);
                        if(result.status_code == 1) {
                            stepper.next();
                        }
                    });
                    break;

                case 2:


                    break;
                case 3:

                    if(_data.services.length < 1) {
                        $('#alert').fadeIn(1000);
                        $('#alert').removeClass('d-none');
                        $('#alert').removeClass('text-danger');
                        $('#alert').removeClass('text-success');
                        $('#alert').addClass('text-danger');
                        $('#alert').text('Please select a service.');
                        setTimeout(function() {
                            $('#alert').fadeOut(1000);
                        }, 3000);
                    } else {
                        canSubmit = true;
                        _data.service_quantity = [];
                        _data.services.forEach(service => {
                            value = parseFloat($('#service_quantity_'+service).val()) + 0;
                            if (value == null || value == 0 || isNaN(value)) {
                                canSubmit = false;
                                $('#service_quantity_'+service).addClass('is-invalid');
                            }
                            else {
                                _data.service_quantity.push({'service_id' : service, 'quantity' : value});
                                $('#service_quantity_'+service).removeClass('is-invalid');
                            }
                        });
                        if(canSubmit) {
                            $('#btnSubmit').text('Sending. Please wait.');
                            Controller.Create('/quotation/create-quotation', _data).done(function(result) {
                                $('#btnSubmit').text('Sent!');
                                console.log(result);
                                setTimeout(function() {
                                    stepper.next();
                                }, 2000);
                            });
                        }
                    }

                break;
                case 4:

                    // we're done here.

                    break;
            }
        }
    </script>
    <script type="text/javascript">

        $('#navbar-main').addClass('navbar-services');
        $('#navbar-main').removeClass('scrolling-navbar');

        setNavBar("#menu-get-a-quote");

    </script>

@endsection
