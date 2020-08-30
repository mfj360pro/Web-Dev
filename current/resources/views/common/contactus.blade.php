@extends('common.shared._layout')

@section('title')
Contact Us | MFJ 360 PRO
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('content')

<div id="site.contact.background"  class="view full-page-intro animated fadeIn">
    <div class="mask rgba-black-light">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-4 white-text text-left">
                        <h1 id="site.contact.blurb.01" class="display-4 landing-slogan mb-4">Contact Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="img/vectors/blob-waves.svg" class="blob-waves">
</div>

<main>

    <div id="contact" class="mt-5 container">
        <div class="row wow fadeIn">
            <div class="col-md-12 mb-4 text-center">
                <h1 id="site.contact.blurb.02" class="h1 font-titillium mb-3">Contact Us</h1>
                <h5 id="site.contact.blurb.03" class="h5 subtext text-muted">Send us a message and we will get back to you!</h5>
            </div>
        </div>
        <div class="row wow fadeIn">
            <div class="col-md-6 mb-4 text-right">

                <div class="md-form">
                    <input id="fullname" type="text" class="form-control validate" minlength="1">
                    <label for="fullname">Full Name</label>
                </div>
                <div class="md-form">
                    <input id="email" type="email" class="form-control validate">
                    <label for="email">Email Address</label>
                </div>
                <div class="md-form">
                    <textarea id="message" class="form-control validate md-textarea" rows="6" minlength="1"></textarea>
                    <label for="message">Message</label>
                </div>

                <div class="md-form">
                    <button id="btn-submit" onclick="Submit()" class="btn btn-default text-white">Submit</button>
                    <p id="contact-alert" class="d-none alert float-left text-left p-0 m-0"></p>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection

@section('script')

    <script type="text/javascript">

        function Submit() {

            var _data = {
                fullname    : $('#fullname').val(),
                email       : $('#email').val(),
                message     : $('#message').val()
            }

            $('#btn-submit').text('Sending');
            Controller.Create('/email/validate', _data).done(function(result) {
                console.log(result);
                $('#contact-alert').fadeIn(1000);
                $('#contact-alert').removeClass('d-none');
                $('#contact-alert').removeClass('text-danger');
                $('#contact-alert').removeClass('text-success');
                $('#contact-alert').addClass(result.status);
                if(result.status_code == 0) {
                    var _error = "";
                    if(result.message.email) {
                        _error += result.message.email + "<br>";
                    }
                    if(result.message.fullname) {
                        _error += result.message.fullname + "<br>";
                    }
                    if(result.message.message) {
                        _error += result.message.message + "<br>";
                    }
                    document.getElementById('contact-alert').innerHTML = _error;
                }
                else $('#contact-alert').text(result.message);
                setTimeout(function() {
                    $('#contact-alert').fadeOut(1000);
                    $('#btn-submit').text('Submit');
                }, 3000);
                if(result.status_code == 1) {
                    Controller.Create('/email/send', _data).done(function(result) {
                        console.log(result);
                    });
                }
            });

        }

        setNavBar("#menu-contact");

    </script>

@endsection
