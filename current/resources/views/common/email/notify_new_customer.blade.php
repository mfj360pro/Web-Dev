<html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,800&family=Titillium+Web:wght@200;300;400;600;700&display=swap">

    <style>
        html, body {
            height: 100%;
        }
            
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
    
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
    
        .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
        .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm,
        .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
        .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg,
        .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
    
        .col {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            min-width: 0;
            max-width: 100%;
        }
    
        .text-justify {
            text-align: justify !important;
        }
    
        .text-left {
            text-align: left !important;
        }
    
        .text-right {
            text-align: right !important;
        }
    
        .text-center {
            text-align: center !important;
        }
    
        .text-body {
            color: #212529 !important;
        }
    
        .text-muted {
            color: #6c757d !important;
        }
    
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }
    
        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1.25rem;
        }
    
        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
    
        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.125);
        }
    
        .shadow {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
    
        hr {
            box-sizing: content-box;
            height: 0;
            overflow: visible;
        }
    
        h1, h2, h3, h4, h5, h6 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }
    
        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }
    
    </style>
    <style>
            
        .m-0 {
        margin: 0 !important;
        }
    
        .mt-0,
        .my-0 {
        margin-top: 0 !important;
        }
    
        .mr-0,
        .mx-0 {
        margin-right: 0 !important;
        }
    
        .mb-0,
        .my-0 {
        margin-bottom: 0 !important;
        }
    
        .ml-0,
        .mx-0 {
        margin-left: 0 !important;
        }
    
        .m-1 {
        margin: 0.25rem !important;
        }
    
        .mt-1,
        .my-1 {
        margin-top: 0.25rem !important;
        }
    
        .mr-1,
        .mx-1 {
        margin-right: 0.25rem !important;
        }
    
        .mb-1,
        .my-1 {
        margin-bottom: 0.25rem !important;
        }
    
        .ml-1,
        .mx-1 {
        margin-left: 0.25rem !important;
        }
    
        .m-2 {
        margin: 0.5rem !important;
        }
    
        .mt-2,
        .my-2 {
        margin-top: 0.5rem !important;
        }
    
        .mr-2,
        .mx-2 {
        margin-right: 0.5rem !important;
        }
    
        .mb-2,
        .my-2 {
        margin-bottom: 0.5rem !important;
        }
    
        .ml-2,
        .mx-2 {
        margin-left: 0.5rem !important;
        }
    
        .m-3 {
        margin: 1rem !important;
        }
    
        .mt-3,
        .my-3 {
        margin-top: 1rem !important;
        }
    
        .mr-3,
        .mx-3 {
        margin-right: 1rem !important;
        }
    
        .mb-3,
        .my-3 {
        margin-bottom: 1rem !important;
        }
    
        .ml-3,
        .mx-3 {
        margin-left: 1rem !important;
        }
    
        .m-4 {
        margin: 1.5rem !important;
        }
    
        .mt-4,
        .my-4 {
        margin-top: 1.5rem !important;
        }
    
        .mr-4,
        .mx-4 {
        margin-right: 1.5rem !important;
        }
    
        .mb-4,
        .my-4 {
        margin-bottom: 1.5rem !important;
        }
    
        .ml-4,
        .mx-4 {
        margin-left: 1.5rem !important;
        }
    
        .m-5 {
        margin: 3rem !important;
        }
    
        .mt-5,
        .my-5 {
        margin-top: 3rem !important;
        }
    
        .mr-5,
        .mx-5 {
        margin-right: 3rem !important;
        }
    
        .mb-5,
        .my-5 {
        margin-bottom: 3rem !important;
        }
    
        .ml-5,
        .mx-5 {
        margin-left: 3rem !important;
        }
    
        .p-0 {
        padding: 0 !important;
        }
    
        .pt-0,
        .py-0 {
        padding-top: 0 !important;
        }
    
        .pr-0,
        .px-0 {
        padding-right: 0 !important;
        }
    
        .pb-0,
        .py-0 {
        padding-bottom: 0 !important;
        }
    
        .pl-0,
        .px-0 {
        padding-left: 0 !important;
        }
    
        .p-1 {
        padding: 0.25rem !important;
        }
    
        .pt-1,
        .py-1 {
        padding-top: 0.25rem !important;
        }
    
        .pr-1,
        .px-1 {
        padding-right: 0.25rem !important;
        }
    
        .pb-1,
        .py-1 {
        padding-bottom: 0.25rem !important;
        }
    
        .pl-1,
        .px-1 {
        padding-left: 0.25rem !important;
        }
    
        .p-2 {
        padding: 0.5rem !important;
        }
    
        .pt-2,
        .py-2 {
        padding-top: 0.5rem !important;
        }
    
        .pr-2,
        .px-2 {
        padding-right: 0.5rem !important;
        }
    
        .pb-2,
        .py-2 {
        padding-bottom: 0.5rem !important;
        }
    
        .pl-2,
        .px-2 {
        padding-left: 0.5rem !important;
        }
    
        .p-3 {
        padding: 1rem !important;
        }
    
        .pt-3,
        .py-3 {
        padding-top: 1rem !important;
        }
    
        .pr-3,
        .px-3 {
        padding-right: 1rem !important;
        }
    
        .pb-3,
        .py-3 {
        padding-bottom: 1rem !important;
        }
    
        .pl-3,
        .px-3 {
        padding-left: 1rem !important;
        }
    
        .p-4 {
        padding: 1.5rem !important;
        }
    
        .pt-4,
        .py-4 {
        padding-top: 1.5rem !important;
        }
    
        .pr-4,
        .px-4 {
        padding-right: 1.5rem !important;
        }
    
        .pb-4,
        .py-4 {
        padding-bottom: 1.5rem !important;
        }
    
        .pl-4,
        .px-4 {
        padding-left: 1.5rem !important;
        }
    
        .p-5 {
        padding: 3rem !important;
        }
    
        .pt-5,
        .py-5 {
        padding-top: 3rem !important;
        }
    
        .pr-5,
        .px-5 {
        padding-right: 3rem !important;
        }
    
        .pb-5,
        .py-5 {
        padding-bottom: 3rem !important;
        }
    
        .pl-5,
        .px-5 {
        padding-left: 3rem !important;
        }
    
        .m-n1 {
        margin: -0.25rem !important;
        }
    
        .mt-n1,
        .my-n1 {
        margin-top: -0.25rem !important;
        }
    
        .mr-n1,
        .mx-n1 {
        margin-right: -0.25rem !important;
        }
    
        .mb-n1,
        .my-n1 {
        margin-bottom: -0.25rem !important;
        }
    
        .ml-n1,
        .mx-n1 {
        margin-left: -0.25rem !important;
        }
    
        .m-n2 {
        margin: -0.5rem !important;
        }
    
        .mt-n2,
        .my-n2 {
        margin-top: -0.5rem !important;
        }
    
        .mr-n2,
        .mx-n2 {
        margin-right: -0.5rem !important;
        }
    
        .mb-n2,
        .my-n2 {
        margin-bottom: -0.5rem !important;
        }
    
        .ml-n2,
        .mx-n2 {
        margin-left: -0.5rem !important;
        }
    
        .m-n3 {
        margin: -1rem !important;
        }
    
        .mt-n3,
        .my-n3 {
        margin-top: -1rem !important;
        }
    
        .mr-n3,
        .mx-n3 {
        margin-right: -1rem !important;
        }
    
        .mb-n3,
        .my-n3 {
        margin-bottom: -1rem !important;
        }
    
        .ml-n3,
        .mx-n3 {
        margin-left: -1rem !important;
        }
    
        .m-n4 {
        margin: -1.5rem !important;
        }
    
        .mt-n4,
        .my-n4 {
        margin-top: -1.5rem !important;
        }
    
        .mr-n4,
        .mx-n4 {
        margin-right: -1.5rem !important;
        }
    
        .mb-n4,
        .my-n4 {
        margin-bottom: -1.5rem !important;
        }
    
        .ml-n4,
        .mx-n4 {
        margin-left: -1.5rem !important;
        }
    
        .m-n5 {
        margin: -3rem !important;
        }
    
        .mt-n5,
        .my-n5 {
        margin-top: -3rem !important;
        }
    
        .mr-n5,
        .mx-n5 {
        margin-right: -3rem !important;
        }
    
        .mb-n5,
        .my-n5 {
        margin-bottom: -3rem !important;
        }
    
        .ml-n5,
        .mx-n5 {
        margin-left: -3rem !important;
        }
    
        .m-auto {
        margin: auto !important;
        }
    
        .mt-auto,
        .my-auto {
        margin-top: auto !important;
        }
    
        .mr-auto,
        .mx-auto {
        margin-right: auto !important;
        }
    
        .mb-auto,
        .my-auto {
        margin-bottom: auto !important;
        }
    
        .ml-auto,
        .mx-auto {
        margin-left: auto !important;
        }
    
    </style>
    <style>
        * {
            font-family: 'Titillium Web', sans-serif;
            font-weight: 600 !important;
        }

    </style>
    
</head>

<body class="pr-5">

    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col text-muted">
                        <p>Hi {{ $data['name'] }},</p>
                        <br>
                        <p>Your request for quotation has been received and we are excited to work with you! To get things started, we have created an account for you so that you can access our <a href="https://mfj360pro.com/portal">Customer Portal.</a> This portal will keep us in touch and updated with our transactions.</p>
                        <p>Please login to <a href="https://mfj360pro.com/portal">https://mfj360pro.com/portal</a> using the following credentials below:</p>
                        <p class="pl-5">
                            Email: {{ $data['email'] }} <br>
                            Password: {{ $data['password'] }}
                        </p>
                        <p>Please keep this information for yourself and avoid others to access your account.</p>
                        <br>
                        <p>Thank you for choosing MFJ 360 PRO!</p>
                        <br>
                        <p>Warm Regards,</p>
                        <p>The MFJ 360 PRO Team</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center" style="font-size: 12px;">                
                        <a href="https://mfj360pro.com"><img src="https://mfj360pro.com/img/logo-black.png" height="100"></a>
                        <br>
                        <a href="https://mfj360pro.com" style="font-weight: 800;" class="text-muted">MFJ 360 PRO</a>
                        <p class="text-muted">Our mission at MFJ 360 Pro, is to bring your space alive.</p>
                        <p class="text-muted">phone: (831)200-2484<br>email: info@mfj360pro.com</p>
                        <p class="text-muted copyright-text">© 2020 Copyright MFJ360. All Rights Reserved.</p>
                    </div>                    
                </div>
            </div>
        </div>
    </div>


</body>

</html>