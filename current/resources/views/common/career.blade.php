@extends('common.shared._layout')

@section('title')
Career | MFJ 360 PRO
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('content')
<div id="site.career.background"  class="view full-page-intro animated fadeIn">
    <div class="mask rgba-black-light">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-4 white-text text-left">
                        <h1 id="landing-slogan" class="display-4 mb-4">Career</h1>
                        <hr class="hr-light my-2">
                        <p id="site.career.blurb.01"></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="img/vectors/blob-waves.svg" class="blob-waves">
</div>

<main>

    <div id="contact" class="container">
        <div class="row wow fadeIn" style="position: relative;">
                <div class="col-md-7 mb-3">
                    <a href="/application?type=photographer">
                        <div class="view overlay zoom z-depth-1-half">
                            <img src="img/photographer.jpg" class="img-fluid" alt="">
                        </div>
                    </a>
                </div>
            <div class="col-md-5 mb-3">
                <h3 id="site.career.job.01" class="h3 font-titillium mb-3"></h3>
                <hr>
                <p id="site.career.job.01.dis"></p>
                <a href="/application?type=photographer" class="text-muted">Join The Team
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="spacer-1"></div>

    <div id="contact" class="container">
        <div class="row wow fadeIn" style="position: relative;">
                <div class="col-md-7 mb-3">
                    <a href="/application?type=partnership">
                        <div class="view overlay zoom z-depth-1-half">
                            <img src="img/hands.jpg" class="img-fluid" alt="">
                        </div>
                    </a>
                </div>
            </a>
            <div class="col-md-5 mb-3">
                <h3 id="site.career.job.02" class="h3 font-titillium mb-3"></h3>
                <hr>
                <p id="site.career.job.02.dis"></p>
                <a href="/application?type=partnership" class="text-muted">Join The Team
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="spacer-1"></div>

    <div id="contact" class="container">
        <div class="row wow fadeIn" style="position: relative;">
                <div class="col-md-7 mb-3">
                    <a href="/application?type=Graphic-Designer">
                        <div class="view overlay zoom z-depth-1-half">
                            <img src="img/graphic.jpg" class="img-fluid" alt="">
                        </div>
                    </a>
                </div>
            </a>
            <div class="col-md-5 mb-3">
                <h3 id="site.career.job.03" class="h3 font-titillium mb-3"></h3>
                <hr>
                <p id="site.career.job.03.dis"></p>
                <a href="/application?type=Graphic-Designer" class="text-muted">Join The Team
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

</main>

@endsection


