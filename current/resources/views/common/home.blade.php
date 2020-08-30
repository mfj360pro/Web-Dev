@extends('common.shared._layout')

@section('title')
MFJ 360 PRO
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('content')

    {{-- <div class="view full-page-intro animated fadeIn" style="background-image: url('storage/{!! $services[0]['thumbnail'] !!}'); "> --}}
    <div id="site.home.background" class="view full-page-intro animated fadeIn">
        <div class="mask rgba-black-light">
            <div class="vh-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-4 white-text text-left">
                            <h1 id="site.intro.blurb.01" class="display-4 landing-slogan mb-4"></h1>
                            <h6 id="site.intro.blurb.02"></h6>
                            <hr id="" class="hr-light my-2">
                            <p id="site.intro.blurb.03"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="img/vectors/blob-waves.svg" class="blob-waves">
    </div>

    <main id="services" class="pt-5 mt-n5">

        <div class="mt-5 container">

            <div class="row wow fadeIn">
                <div class="col-md-12 mb-4 text-center">
                    <h1 id="site.ourservices.blurb.01" class="h1 mb-3 font-titillium">Our Services</h1>
                    <h5 id="site.ourservices.blurb.02" class="h5 subtext text-muted">We offer you world class services to market your property.</h5>
                </div>
            </div>

        </div>

        <div class="spacer-1"></div>

        <div class="container">

            <div class="row wow fadeIn" style="position: relative;">

                <div class="col-md-7 mb-3">
                    <a href="/services?id={!! $services[0]['id'] !!}">
                        <div class="view overlay zoom z-depth-1-half">
                            @if (pathinfo($services[0]['thumbnail'], PATHINFO_EXTENSION) == 'mp4')
                                <video src="storage/{!! $services[0]['thumbnail'] !!}" autoplay muted loop></video>
                            @else
                                <img src="storage/{!! $services[0]['thumbnail'] !!}" class="img-fluid" alt="">
                            @endif
                            <div class="mask flex-center rgba-black-strong">
                                <img src="storage/{!! $services[0]['hover_icon'] !!}" height="100vh" alt="">
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-5 mb-3">

                    <h3 class="h3 font-titillium mb-3">{!! $services[0]['title'] !!}</h3>
                    <hr>
                    <p>{!! $services[0]['description_01'] !!}</p>
                    <a href="/services?id={!! $services[0]['id'] !!}" class="text-muted">Learn More
                        <i class="fas fa-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

        <div class="spacer-3">
            <img src="img/vectors/blob-03.svg" class="blob-bottom">
        </div>

        <div style="background-color: #d2d7e0;">

            <div class="container">

                <div class="row wow fadeIn">

                    <div class="col-md-6 order-lg-2 mb-3">

                        <a href="/services?id={!! $services[1]['id'] !!}">
                            <div class="view overlay zoom z-depth-1-half">
                                @if (pathinfo($services[1]['thumbnail'], PATHINFO_EXTENSION) == 'mp4')
                                    <video style="width:100%" src="storage/{!! $services[1]['thumbnail'] !!}" autoplay muted loop></video>
                                @else
                                    <img src="storage/{!! $services[1]['thumbnail'] !!}" class="img-fluid" alt="">
                                @endif
                                <div class="mask flex-center rgba-black-strong">
                                    <img src="storage/{!! $services[1]['hover_icon'] !!}" height="100vh" alt="">
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-5 order-lg-1 mb-3">

                        <h3 class="h3 font-titillium mb-3">{!! $services[1]['title'] !!}</h3>
                        <hr>
                        <p>{!! $services[1]['description_01'] !!}</p>
                        <a href="/services?id={!! $services[1]['id'] !!}" class="text-muted">Learn More
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <div class="spacer-3">
            <img src="img/vectors/blob-04.svg" class="blob">
        </div>

        <div class="container">

            <div class="row wow fadeIn" style="position: relative;">

                <div class="col-md-7 mb-3">
                    <a href="/services?id={!! $services[2]['id'] !!}">
                        <div class="view overlay zoom z-depth-1-half">
                            @if (pathinfo($services[2]['thumbnail'], PATHINFO_EXTENSION) == 'mp4')
                                <video src="storage/{!! $services[2]['thumbnail'] !!}" autoplay muted loop></video>
                            @else
                                <img src="storage/{!! $services[2]['thumbnail'] !!}" class="img-fluid" alt="">
                            @endif
                            <div class="mask flex-center rgba-black-strong">
                                <img src="storage/{!! $services[2]['hover_icon'] !!}" height="100vh" alt="">
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-5 mb-3">

                    <h3 class="h3 font-titillium mb-3">{!! $services[2]['title'] !!}</h3>
                    <hr>
                    <p>{!! $services[2]['description_01'] !!}</p>
                    <a href="/services?id={!! $services[2]['id'] !!}" class="text-muted">Learn More
                        <i class="fas fa-arrow-right"></i>
                    </a>

                </div>

            </div>

            <div class="spacer-3"></div>

        </div>

    </div>

        {{-- <section id="recent-tours" class="mt-5 py-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 mb-4 text-center">
                        <h2 class="h2 mb-3 text-white">Recent Tours</h2>
                        <h5 class="h5 subtext text-muted text-white">View our recent tours.</h5>
                    </div>
                </div>

                <div class="row justify-content-center">

                    <div class="col-md-4 mb-4">

                        <div class="card hoverable">
                            <div class="view">
                                <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" class="card-img-top" alt="photo">
                                <a href="#">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Sample Tour</h4>
                                <p class="card-text">Description.</p>
                                <a href="/services/matterport-tours" class="text-muted">View More
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4 mb-4">

                        <div class="card hoverable">
                            <div class="view">
                                <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" class="card-img-top" alt="photo">
                                <a href="#">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Sample Tour</h4>
                                <p class="card-text">Description.</p>
                                <a href="/services/matterport-tours" class="text-muted">View More
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4 mb-4">

                        <div class="card hoverable">
                            <div class="view">
                                <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" class="card-img-top" alt="photo">
                                <a href="#">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Sample Tour</h4>
                                <p class="card-text">Description.</p>
                                <a href="/services/matterport-tours" class="text-muted">View More
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section> --}}

    </main>


@endsection
@section('script')

    <script type="text/javascript">

        setNavBar("#menu-home");

    </script>

@endsection
