@extends('common.shared._layout')

@section('title')
{!! $data['title'] !!} | MFJ 360 PRO
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="masonry/css/component.css" />
    <script src="masonry/js/modernizr.custom.js"></script>
    <style>

    </style>
@endsection

@section('content')

    <main class="mt-5 pt-5">

        <div class="mt-5 container">

            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="h1 font-titillium mb-3">{!! $data['title'] !!}</h1>
                    <p class="">{!! $data['description_02'] !!}</p>
                </div>
            </div>

            <div class="row mb-5 animated fadeInUp slow">

                <div class="col-md-12">

                    <ul class="grid effect-2" id="grid">
                        @foreach (json_decode($data['photos']) as $photo)
                        <li>
                            <div class="view overlay zoom z-depth-1-half">
                                @if (pathinfo($photo, PATHINFO_EXTENSION) == 'mp4')
                                    <video style="width:100%" src="storage/{!! $photo !!}" autoplay muted loop></video>
                                @else
                                    <img src="storage/{!! $photo !!}" class="img-fluid" alt="">
                                @endif
                                <div class="mask flex-center rgba-black-light">
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>

        </div>

        {{-- <img src="img/vectors/blob-02.svg" class=""> --}}

    </main>

@endsection
@section('script')

    <script type="text/javascript">

        $('#navbar-main').addClass('navbar-services');
        $('#navbar-main').removeClass('scrolling-navbar');

        setNavBar("#menu-services");

    </script>

    <script src="masonry/js/masonry.pkgd.min.js"></script>
    <script src="masonry/js/imagesloaded.js"></script>
    <script src="masonry/js/classie.js"></script>
    <script src="masonry/js/AnimOnScroll.js"></script>

    <script>

        $(document).ready(function() {

            new AnimOnScroll( document.getElementById( 'grid' ), {
                minDuration : 1,
                maxDuration : 1,
                viewportFactor : 0.2
            } );

        });

    </script>
@endsection
