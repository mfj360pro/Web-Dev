@extends('backend.shared._print_layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('bs-stepper/css/bs-stepper.min.css') }}">
    <style>
        .custom-checkbox > * {
            cursor: pointer;
        }
        .pac-container {
            z-index: 1072 !important;
            width: auto !important;
            /* top: 390px !important; */
            display: block !important;
        }
        .pac-container:empty{
            display: none !important;
        }
    </style>
@endsection

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <p class="text-white display-2">Add Shoot</p>
        </div>
    </div>
    
    <div class="container-fluid mt--7 mb-7">
        <div class="row">
            <div class="col">
                <div class="card shadow bg-secondary">
                    <div class="card-body container-fluid">
                        <div class="row justify-content-center">
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
                                                <span class="bs-stepper-label">Schedule</span>
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
                                            <div class="card shadow">
                                                <div class="card-body container-fluid">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12 mb-3">
                                                            <div class="form-group">                                                                
                                                                <label class="form-control-label">Address</label>
                                                                <input type="text" class="form-control form-control-alternative" id="location" placeholder="This is where we render our services.">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <button onclick="Submit(1)" class="btn btn-md btn-success">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2" class="content" role="tabpanel" aria-labelledby="step-2-trigger">
                                            <div class="card">
                                                <div class="card-body container text-center">                                    
                                                    <div class="row justify-content-center mb-4">
                                                        <div class="col-md-12">
                                                            <h3 id="fee" class="text-dark"></h3>
                                                            <p id="service-prompt" class="d-none alert text-danger float-left text-left">Sorry, our services are not available in your area yet.</p>
                                                        </div>
                                                    </div>
                                                    <div id="services_item" class="col-md-4 m-0 mb-4 d-none" style="height: 100%;">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input check" id="service_select" type="checkbox">
                                                                    <label class="custom-control-label check" for="service_select">Select</label>
                                                                </div>
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <h3 class="text-dark">Service 01</h3>
                                                                <h4 style="font-weight: 600;">Service Price</h4>
                                                                <a class="text-muted">Learn More <i class="fas fa-arrow-right"></i> </a>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                <div class="form-group">                                                                
                                                                    <label class="form-control-label qty">Quantity</label>
                                                                    <input type="number" class="form-control form-control-alternative qty" id="service_quantity" min=1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="services_items_container" class="row">

                                                    </div>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <button onclick="Back(1)" class="btn btn-md btn-success">Back</button>
                                                    <button onclick="Submit(2)" class="btn btn-md btn-success">Next</button>
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
                
                                                            {{-- <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input check" id="subscribe" checked>
                                                                <label class="custom-control-label" for="subscribe" style="font-weight: 600;">Subscribe to Promotion</label>
                                                            </div> --}}
                
                                                            <!-- Begin Mailchimp Signup Form -->
                                                            <!-- <div id="mc_embed_signup" class="d-none">
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
                                                            </div> -->
                                                            <!--End mc_embed_signup-->
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <button onclick="Back(2)" class="btn btn-md btn-success">Back</button>
                                                    <button onclick="Submit(3)" class="btn btn-md btn-success">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-4" class="content" role="tabpanel" aria-labelledby="step-4-trigger">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <div class="form-group">                                                                
                                                                <label class="form-control-label">Start Date <span style="font-weight: 300;" class="text-muted">(Your preferred sched to start service.)</span></label>
                                                                <input type="date" class="form-control form-control-alternative" id="start_date">
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-6">
                                                            <div class="form-group">                                                                
                                                                <label class="form-control-label">End Date</span></label>
                                                                <input type="date" class="form-control form-control-alternative" id="end_date">
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <label for="notes">Notes <span style="font-weight: 300;" class="text-muted">(Write us your important notes.)</span></label>
                                                            <div class="form-group">
                                                                <textarea name="notes" id="notes" class="form-control form-control-alternative" cols="30" rows="10"></textarea>
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
                                                    <button onclick="Back(3)" class="btn btn-md btn-success">Back</button>
                                                    <button id="btnSubmit" onclick="Submit(4)" class="btn btn-md btn-success">Submit</button>
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
                </div>
            </div>
        </div>      
    </div>
        
@endsection

@section('script')

    <script src="{{ asset('bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script type="text/javascript">

        var geocoder;
        // comment out before pushing
        // google.maps.event.addDomListener(window, 'load', initAPI);
        function initAPI() {
            geocoder = new google.maps.Geocoder();
            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete(document.getElementById('location'), {
                    // types: ['(postal codes)'],
                    // componentRestrictions: {'country': ['ca','us']}
                });
            autocomplete.setFields(['formatted_address']);
        }

    </script>
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

        function _Submit(step) {

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

        function Submit(step) {

            var _data = {
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
                                            $('#services_item_' + pricing.id + ' h3').text(pricing.service.title);
                                            $('#services_item_' + pricing.id + ' h4').text('$' + pricing.price + ' per ' + pricing.unit.name);
                                            $('#services_item_' + pricing.id + ' a').attr('href', '/services?id='+pricing.service.id);
                                            $('#services_item_' + pricing.id + ' a').attr('target', '_blank');
                                            $('#services_item_' + pricing.id + ' input.check').attr('onclick', 'SelectService('+pricing.id+')');
                                            $('#services_item_' + pricing.id + ' input.check').attr('id', 'service_select_'+pricing.id);
                                            $('#services_item_' + pricing.id + ' label.check').attr('for', 'service_select_'+pricing.id);
                                            $('#services_item_' + pricing.id + ' input.qty').attr('id', 'service_quantity_'+pricing.id);
                                            $('#services_item_' + pricing.id + ' input.qty').attr('data-price', pricing.price);
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
                                    'service' : $('#services_item_' + service + ' h3').text(),
                                    'pricing' : $('#services_item_' + service + ' h4').text()
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

                                if(i == 0) {
                                    td.innerHTML = 'On Site Fee';                             
                                    tr.append(td);
                                    td = document.createElement('td'); 
                                    td.innerHTML = '$'+document.querySelector('#fee').dataset.fee;
                                    tr.append(td);
                                }
                                else {
                                    @if (count($promos) > 0)
                                        @foreach ($promos as $promo)
                                            @if (($promo['daysvalid'] - (new DateTime())->diff(new DateTime($promo['created_at']))->days) > 0)
                                                td.innerHTML = "Total Amount ({{$promo['discount']}}% Off)";
                                                tr.append(td);
                                                td = document.createElement('td'); 
                                                td.innerHTML = '<span style="font-weight: 800;">$'+(total * {{$promo['discount'] / 100}})+'<span>';
                                                tr.append(td);
                                            @else
                                                td.innerHTML = 'Total Amount';
                                                tr.append(td);
                                                td = document.createElement('td'); 
                                                td.innerHTML = '<span style="font-weight: 800;">$'+total+'<span>';
                                                tr.append(td);
                                            @endif
                                        @endforeach
                                    @else
                                        td.innerHTML = 'Total Amount';
                                        tr.append(td);
                                        td = document.createElement('td'); 
                                        td.innerHTML = '<span style="font-weight: 800;">$'+total+'<span>';
                                        tr.append(td);
                                    @endif
                                }

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

                    console.log(_data);
                    $('#btnSubmit').text('Sending. Please wait.');          
                    Controller.Create('/portal/create-quotation', _data).done(function(result) {

                        if(result.code==1) {                     

                            // var isSubscribed = document.getElementById('subscribe').checked;
                            // if(isSubscribed) {
                            //     console.log(result.data.email);
                            //     document.getElementById('mce-EMAIL').value = result.data.email;
                            //     document.getElementById('mce-FNAME').value = result.data.firstname;
                            //     document.getElementById('mce-LNAME').value = result.data.lastname;
                            //     document.getElementById('mc-embedded-subscribe').click();
                            // }

                            $('#btnSubmit').text('Sent!');
                            stepper.next();
                            window.location.replace("/portal/shoots");
                            
                        }   

                    });

                    break;

                case 5:

                    // we're done here.

                    break;
            }
        }

    </script>

    {{-- uncomment before pushing --}}
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGd05FcNQn4ozL7OArBFP12PTwHsEI1Rk&libraries=places&callback=initAPI"></script>  
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGd05FcNQn4ozL7OArBFP12PTwHsEI1Rk&libraries=places&callback=initAutocomplete"async defer></script>   --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGd05FcNQn4ozL7OArBFP12PTwHsEI1Rk&libraries=places"async defer></script>   --}}

@endsection
