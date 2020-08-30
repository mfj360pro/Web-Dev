<!doctype html>
<html id="top" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        @include('common.shared._metadata')

        <link rel="icon"       type="image/png" href="img/logo-black.png" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,800&family=Titillium+Web:wght@200;300;400;600;700&display=swap">

        <link rel="stylesheet" href="mdb/css/bootstrap.min.css">
        <link rel="stylesheet" href="mdb/css/mdb.min.css">

        <!-- Plugin file -->
        <link rel="stylesheet" href="css/main.css">

        @yield('css')

    </head>

    <script>
        const base_url = ""
        const admn_url = "<?php echo str_replace((parse_url(url(''))['host']), 'admin.'.(parse_url(url(''))['host']), url('')); ?>"
    </script>

    <body>

        @include('common.shared._header')
        @yield('content')
        @include('common.shared._footer')

        <script type="text/javascript" src="mdb/js/jquery.min.js"></script>
        {{-- <script type="text/javascript" src="mdb/js/popper.min.js"></script> --}}
        <script type="text/javascript" src="mdb/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="mdb/js/mdb.js"></script>
        <script type="text/javascript" src="mdb/js/modules/wow.min.js"></script>
        <script type="text/javascript" src="jarallax/jarallax-min-0.2.js"></script>

        <script type="text/javascript" src="js/core.js"></script>

        <script type="text/javascript">

            $(document).ready(function() {

                new WOW().init();

                if($(document).scrollTop() > 50) {
                    $('#navbar-main').addClass('top-nav-collapse');
                }

            });

            var screen = {
                width : $(this).width(),
                height : $(this).height(),
                scrollTop : $(document).scrollTop()
            }

            function setNavBar(element) {
                $('[id^="menu-"]').removeClass('active');
                $(element).addClass('active');
            }

            Controller.Read('WebService/ReadContents').done(function(data) {
                data.forEach(el => {
                    element = document.getElementById(el.element);
                    if (element!=null) {
                        if(el.element == 'site.home.background' || el.element == 'site.contact.background'|| el.element == 'site.career.background') {
                            element.setAttribute('style', "background-image: url('storage/" + el.value + "'); ");
                        }
                        else element.innerHTML = el.value;
                    }

                });
            });

        </script>

        @yield('script')

    </body>
</html>
