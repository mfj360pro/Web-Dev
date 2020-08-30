@extends('common.shared._layout')

@section('title')
    Get a Quote | MFJ 360 PRO
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('bs-stepper/css/bs-stepper.min.css') }}">
    <style>
        .custom-checkbox > * {
            cursor: pointer;
        }
        .pac-container {
            z-index: 1072 !important;
            /* width: auto !important; */
            top: 390px !important;
            display: block !important;
        }
        .pac-container:empty{
            display: none !important;
        }
    </style>
@endsection

@section('content')

<main class="mt-5 pt-5">

    <div id="contact" class="mt-5 container">
        <div class="row wow fadeIn">
            <div class="col-md-12 text-center">
                <h1 id="site.quote.blurb.01" class="h1 font-titillium mb-3">Get a Quote!</h1>
                <h5 id="site.quote.blurb.02" class="h5 subtext text-muted">Check out the services available for you.</h5>
            </div>
        </div>
        <div class="row justify-content-center container">
            <div class="col-md-12 mb-4">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#step-1">
                            <button type="button" class="step-trigger" role="tab" aria-controls="step-1" id="step-1-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Location</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-2">
                            <button type="button" class="step-trigger" role="tab" aria-controls="step-2" id="step-2-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Choose Services</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-3">
                            <button type="button" class="step-trigger" role="tab" aria-controls="step-3" id="step-3-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Total</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-4">
                            <button type="button" class="step-trigger" role="tab" aria-controls="step-4" id="step-4-trigger">
                                <span class="bs-stepper-circle">4</span>
                                <span class="bs-stepper-label">Basic Info & Schedule</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-5">
                            <button type="button" class="step-trigger" role="tab" aria-controls="step-5" id="step-5-trigger">
                                <span class="bs-stepper-circle">5</span>
                                <span class="bs-stepper-label">Finish</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="step-1" class="content" role="tabpanel" aria-labelledby="step-1-trigger">

                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10 mb-3 text-left">

                                            <label for="location">Address <span style="font-weight: 300;" class="text-muted">(This is where the service will be rendered)</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="location" required>
                                                <div class="invalid-feedback">
                                                    No valid zipcode found. Please put a valid address.
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    {{-- <div class="row justify-content-center">
                                        <div class="col-md-5 text-left">

                                            <label for="start_date">Start Date <span style="font-weight: 300;" class="text-muted">(Your preferred sched to start service.)</span></label>
                                            <div class="input-group">
                                                <input type="time" class="form-control" id="start_date" required>
                                                <div class="invalid-feedback">
                                                    Please put a valid time.
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-5 text-left">

                                            <label for="start_time">Time <span style="font-weight: 300;" class="text-muted"></span></label>
                                            <div class="input-group">
                                                <input type="time" class="form-control" id="start_time" required>
                                                <div class="invalid-feedback">
                                                    Please put a valid time.
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}

                                </div>
                                <div class="card-footer text-center">
                                    {{-- <button onclick="Back(1)" class="btn btn-md btn-default">Back</button> --}}
                                    <button onclick="Submit(1)" class="btn btn-md btn-default">Next</button>
                                </div>
                            </div>

                        </div>
                        <div id="step-2" class="content" role="tabpanel" aria-labelledby="step-2-trigger">

                            <div class="card">
                                <div class="card-body text-center">                                    
                                    <div class="row justify-content-center mb-4">
                                        <div class="col-md-12">
                                            <h5 id="fee" class="text-dark"></h5>
                                            <p id="service-prompt" class="d-none alert text-danger float-left text-left">Sorry, our services are not available in your area yet.</p>
                                        </div>
                                    </div>
                                    
                                    <div id="services_item" class="col-md-4 mb-4 d-none" style="height: 100%;">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input check" id="service_select">
                                                    <label class="custom-control-label" for="service_select">Select</label>
                                                </div>
                                            </div>
                                            <div class="card-body text-center">
                                                <div class="row">
                                                    <div class="col-md-12 text-muted">
                                                        <h5 class="text-dark">Service 01</h5>
                                                        <p style="font-weight: 600;">$1000 per service package</p>
                                                        <a class="text-muted">Learn More
                                                            <i class="fas fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center">
                                                <label for="quantity">Quantity</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control qty" id="service_quantity" min=1 required>
                                                    <div class="invalid-feedback">
                                                        Please put a quantity.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="services_items_container" class="row">

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
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Service</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-total"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input check" id="subscribe" checked>
                                                <label class="custom-control-label" for="subscribe" style="font-weight: 600;">Subscribe to Promotion</label>
                                            </div>

                                            <!-- Begin Mailchimp Signup Form -->
                                            <div id="mc_embed_signup" class="d-none">
                                                <form action="https://mfj360pro.us17.list-manage.com/subscribe/post?u=e35f9b442a0c32426cbaae5e4&amp;id=394a4c6bae" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate target="_blank">
                                                    <div id="mc_embed_signup_scroll">
                                                        <input type="email" name="EMAIL" class="email"  id="mce-EMAIL" placeholder="email address" required>
                                                        <input type="text"  name="FNAME" class=""       id="mce-FNAME">
                                                        <input type="text"  name="LNAME" class=""       id="mce-LNAME">
                                                        <input type="text"  name="b_e35f9b442a0c32426cbaae5e4_394a4c6bae" tabindex="-1" value="">
                                                        <div class="clear">
                                                            <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!--End mc_embed_signup-->
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button onclick="Back(2)" class="btn btn-md btn-default">Back</button>
                                    <button onclick="Submit(3)" class="btn btn-md btn-default">Next</button>
                                </div>
                            </div>

                        </div>
                        <div id="step-4" class="content" role="tabpanel" aria-labelledby="step-4-trigger">

                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3 text-left">
                                            <label for="name">First Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="firstname" required>
                                                <div class="invalid-feedback">
                                                    Please provide your first name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-left">
                                            <label for="name">Last Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="lastname" required>
                                                <div class="invalid-feedback">
                                                    Please provide your last name.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 text-left">

                                            <label for="email">Email Address</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="email" required>
                                                <div class="invalid-feedback">
                                                    Please provide an email address.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 text-left">
                                            <label for="phone">Phone</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="phone" aria-describedby="phone-prepend" required>
                                                <div class="invalid-feedback">
                                                    Please provide a phone number.
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 text-left">

                                            <label for="start_date">Start Date <span style="font-weight: 300;" class="text-muted">(Your preferred sched to start service.)</span></label>
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" id="start_date" required>
                                                <div class="invalid-feedback">
                                                    Please put a valid date.
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- <div class="row justify-content-center">
                                        <div class="col-md-6 text-left">

                                            <label for="end_date">End Date <span style="font-weight: 300;" class="text-muted"></span></label>
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" id="end_date" required>
                                                <div class="invalid-feedback">
                                                    Please put a valid date.
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 text-left">

                                            <label for="notes">Notes <span style="font-weight: 300;" class="text-muted">(Write us your important notes.)</span></label>
                                            <div class="input-group">
                                                <textarea name="notes" id="notes" class="form-control" cols="30" rows="10"></textarea>
                                                {{-- <input type="date" class="form-control" id="notes" required> --}}
                                                <div class="invalid-feedback"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-md-12 text-center">
                                            <p>Click Submit to proceed.</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-center">
                                    <button onclick="Back(3)" class="btn btn-md btn-default">Back</button>
                                    <button id="btnSubmit" onclick="Submit(4)" class="btn btn-md btn-default">Submit</button>
                                </div>
                            </div>

                        </div>
                        <div id="step-5" class="content" role="tabpanel" aria-labelledby="step-5-trigger">

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

        var stepper             = new Stepper($('.bs-stepper')[0]);
        var data                = [];
        var services            = [];
        var quantities          = [];
        var zipcode             = '';
        var service_quantity    = [];
        var fetched_data        = [];

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
                firstname           : $('#firstname').val(),
                lastname            : $('#lastname').val(),
                email               : $('#email').val(),
                phone               : $('#phone').val(),
                address             : $('#location').val(),
                start_date          : $('#start_date').val(),
                // end_date            : $('#end_date').val(),
                zipcode             : zipcode,
                services            : services,
                quantity            : quantities,
                notes               : $('#notes').val(),
                step                : step,
                service_quantity    : service_quantity
            }

            switch (step) {
                case 1:

                    services = [];
                    var place = $('#location').val();
                    geocoder.geocode({ 'address': place }, function(results, status) {
                        if(status == 'OK') {
                            zipcode = '';
                            results.forEach(element => {
                                element.address_components.forEach(component => {
                                    component.types.forEach(type => {
                                        if(type == 'postal_code') {
                                            zipcode = component.long_name;
                                            console.log(zipcode);
                                        }
                                    });
                                });
                            });
                            if(zipcode != '')
                                Controller.Create('/quotation/search-services', {'zipcode':zipcode}).done(function(result) {
                                    data = result;
                                    if(data!=null) {
                                        $('#services_items_container').html("");
                                        data.forEach(pricing => {
                                            $('#services_item').clone().attr('id', 'services_item_' + pricing.id).appendTo('#services_items_container').removeClass('d-none');
                                            $('#services_item_' + pricing.id + ' h5').text(pricing.service.title);
                                            $('#services_item_' + pricing.id + ' p').text('$' + pricing.price + ' per ' + pricing.unit.name);
                                            $('#services_item_' + pricing.id + ' a').attr('href', '/services?id='+pricing.service.id);
                                            $('#services_item_' + pricing.id + ' a').attr('target', '_blank');
                                            $('#services_item_' + pricing.id + ' input.check').attr('onclick', 'SelectService('+pricing.id+')');
                                            $('#services_item_' + pricing.id + ' input.check').attr('id', 'service_select_'+pricing.id);
                                            $('#services_item_' + pricing.id + ' input.qty').attr('id', 'service_quantity_'+pricing.id);
                                            $('#services_item_' + pricing.id + ' input.qty').attr('data-price', pricing.price);
                                            $('#services_item_' + pricing.id + ' label').attr('for', 'service_select_'+pricing.id);
                                            $('#fee').attr('data-fee', pricing.zipcode.fee);
                                            $('#fee').text('On Site Fee $' + pricing.zipcode.fee);
                                        });
                                    }
                                    else {
                                        $('#service-prompt').fadeIn(1000);
                                        $('#service-prompt').removeClass('d-none');
                                        $('#service-prompt').addClass(result.status);
                                        setTimeout(function() {
                                            $('#service-prompt').fadeOut(1000);
                                        }, 3000);
                                    }
                                    stepper.next();
                                });
                        }
                        else {
                            $('#location').addClass('is-invalid');
                        }
                    });

                    break;

                case 2:

                    if(services.length < 1) {
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
                        service_quantity = [];
                        services.forEach(service => {
                            value = parseFloat($('#service_quantity_'+service).val());
                            price = parseFloat(document.querySelector('#service_quantity_'+service).dataset.price);
                            if (value == null || value == 0 || isNaN(value)) {
                                canSubmit = false;
                                $('#service_quantity_'+service).addClass('is-invalid');
                            }
                            else {
                                service_quantity.push({'service_id' : service, 'quantity' : value, 'price' : price, 'details' : {
                                    'service' : $('#services_item_' + service + ' h5').text(),
                                    'pricing' : $('#services_item_' + service + ' p').text()
                                }});
                                $('#service_quantity_'+service).removeClass('is-invalid');
                            }
                        });
                        if(canSubmit) {

                            var total = 0;
                            $('#table-total').html("");
                            service_quantity.forEach(item => {
                                amount = Math.round(item.quantity * item.price);
                                total += amount;

                                var tr = document.createElement('tr');
                                var td = null;
                                var th = document.createElement('th');
                                td = document.createElement('td');
                                td.innerHTML = item.details.service;
                                tr.append(td);
                                td = document.createElement('td');
                                td.innerHTML = item.details.pricing;
                                tr.append(td);
                                td = document.createElement('td');
                                td.innerHTML = item.quantity;
                                tr.append(td);
                                td = document.createElement('td'); 
                                td.innerHTML = '$'+amount;
                                tr.append(td);
                                $('#table-total').append(tr);

                            });
                            total += parseFloat(document.querySelector('#fee').dataset.fee);
                            total = Math.round(total);
                            
                            for (let i = 0; i < 2; i++) {
                                var tr = document.createElement('tr');
                                var td = null;
                                var th = document.createElement('th');
                                td = document.createElement('td');
                                td.setAttribute('colspan', 3);
                                td.setAttribute('class', 'text-right px-5');
                                (i == 0) ? td.innerHTML = 'On Site Fee' : td.innerHTML = 'Total Amount';
                                tr.append(td);
                                // td = document.createElement('td');
                                // td.innerHTML = '';
                                // tr.append(td);
                                td = document.createElement('td'); 
                                (i == 0) ? td.innerHTML = '$'+document.querySelector('#fee').dataset.fee : td.innerHTML = '<span style="font-weight: 800;">$'+total+'<span>';
                                tr.append(td);
                                $('#table-total').append(tr);                                
                            }
                            stepper.next();
                        }
                    }

                    break;

                case 3:

                    stepper.next();

                    break;

                case 4:
                
                    Controller.Create('/quotation/validate', _data).done(function(result) {

                        $('#alert').fadeIn(1000);
                        $('#alert').removeClass('d-none');
                        $('#alert').removeClass('text-danger');
                        $('#alert').removeClass('text-success');
                        $('#alert').addClass(result.status);

                        if(result.status_code == 0) {
                            var _alert = document.getElementById('alert');
                            if(result.message.email)        $('#email').addClass('is-invalid');
                            if(result.message.firstname)    $('#firstname').addClass('is-invalid');
                            if(result.message.lastname)     $('#lastname').addClass('is-invalid');
                            if(result.message.phone)        $('#phone').addClass('is-invalid');
                        }

                        // else $('#alert').text(result.message);
                        setTimeout(function() {
                            $('#alert').fadeOut(1000);
                            $('#btn-submit').text('Submit');
                        }, 3000);

                        if(result.status_code == 1) {

                            $('#btnSubmit').text('Sending. Please wait.');
                            Controller.Create('/quotation/create-quotation', _data).done(function(result) {
                                $('#btnSubmit').text('Sent!');
                                setTimeout(function() {
                                }, 2000);
                            });
                            stepper.next();

                            var isSubscribed = document.getElementById('subscribe').checked;
                            if(isSubscribed) {
                                console.log(_data.email);
                                document.getElementById('mce-EMAIL').value = _data.email;
                                document.getElementById('mce-FNAME').value = _data.firstname;
                                document.getElementById('mce-LNAME').value = _data.lastname;
                                document.getElementById('mc-embedded-subscribe').click();
                            }

                        }

                    });
                    
                    break;

                case 5:

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

    <script type="text/javascript">

        var geocoder;
        // comment out before pushing
        // google.maps.event.addDomListener(window, 'load', initAutocomplete);
        function initAutocomplete() {
            geocoder = new google.maps.Geocoder();
            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete(document.getElementById('location'), {
                    // types: ['(postal codes)'],
                    // componentRestrictions: {'country': ['ca','us']}
                });
            autocomplete.setFields(['formatted_address']);
        }

    </script>

    {{-- uncomment before pushing --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGd05FcNQn4ozL7OArBFP12PTwHsEI1Rk&libraries=places&callback=initAutocomplete"async defer></script>  
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGd05FcNQn4ozL7OArBFP12PTwHsEI1Rk&libraries=places"async defer></script>   --}}

@endsection
