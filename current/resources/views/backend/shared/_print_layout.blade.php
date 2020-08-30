<!--

=========================================================
* Argon Dashboard - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
    Customer Portal | MFJ 360 PRO
  </title>

  <!-- Favicon --><link rel="icon"       type="image/png" href="img/logo-black.png" >

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <!-- Icons -->
  <link href="{{ asset('backend/admin/argon/assets/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
  <link href="{{ asset('backend/admin/argon/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
  
  <!-- CSS Files -->
  <link href="{{ asset('backend/admin/argon/assets/css/argon-dashboard.css?v=1.1.0') }}" rel="stylesheet" />

  <!-- JSGRID Files -->
  <link rel="stylesheet" type="text/css" href="{!! asset('backend/jsgrid/demos.css') !!}" />
  <link rel="stylesheet" type="text/css" href="{!! asset('backend/jsgrid/css/jsgrid.css') !!}" />
  <link rel="stylesheet" type="text/css" href="{!! asset('backend/jsgrid/css/theme.css') !!}" />
  <link rel="stylesheet" type="text/css" href="{!! asset('backend/css/main.css') !!}" />
  <link rel="stylesheet" type="text/css" href="{!! asset('backend/image-picker/image-picker.css') !!}" />

  <!-- DROPZONE -->
  <!-- <link rel="stylesheet" type="text/css" href="{!! asset('backend/dropzone/css/dropzone.css') !!}" /> -->
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/dropzone/dist/dropzone.css" rel="stylesheet" />

  <!-- MULTISELECT -->
  <link rel="stylesheet" type="text/css" href="{!! asset('backend/select/bootstrap-select.min.css') !!}" />

  <!-- CROPPER -->
  <!-- <link rel="stylesheet" type="text/css" href="{!! asset('backend/cropperjs/docs/css/cropper.css') !!}" /> -->
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/cropperjs/dist/cropper.css"/>

  <!-- Custom CSS -->
  @yield('css')

</head>

<body class="p-0">
    
    <script>
        const base_url  = '<?php echo url(''); ?>'
        const phly_url  = '<?php echo url(''); ?>'
        const app_cusnm = '{{ Session::get('app_cusnm') }}'
        const app_email = '{{ Session::get('app_email') }}'
        const app_phone = '{{ Session::get('app_phone') }}'
        const app_cusid = '{{ Session::get('app_cusid') }}'
    </script>

    <div class="main-content">
        @yield('content')    
    </div>

    <!-- JS -->
    <script src="{{ asset('backend/admin/argon/assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/admin/argon/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/admin/argon/assets/js/argon-dashboard.min.js?v=1.1.0') }}"></script>
    <script src="{{ asset('backend/bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('backend/js/core.js') }}"></script>
    
    <script src="{{ asset('backend/image-picker/image-picker.js') }}"></script>
    <script src="{{ asset('backend/compressor/dist/compressor.min.js') }}"></script>

    <!-- MULTISELECT -->
    <script src="{{ asset('backend/select/bootstrap-select.min.js') }}"></script>
    
    <!-- JSGRID Files -->  
    <script src="{{ asset('backend/jsgrid/src/jsgrid.core.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/jsgrid.load-indicator.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/jsgrid.load-strategies.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/jsgrid.sort-strategies.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/jsgrid.field.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/fields/jsgrid.field.text.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/fields/jsgrid.field.textarea.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/fields/jsgrid.field.number.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/fields/jsgrid.field.checkbox.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/fields/jsgrid.field.control.js') }}"></script>
    <script src="{{ asset('backend/jsgrid/src/fields/jsgrid.field.select.js') }}"></script>

    <!-- DROPZONE Files -->  
    <!-- <script src="{{ asset('backend/dropzone/js/dropzone.js') }}"></script> -->

    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    
    <!-- SORTABLEJS Files -->  
    <script src="{{ asset('backend/sortablejs/Sortable.js') }}"></script>
    <script src="{{ asset('backend/sortablejs/jquery-sortable.js') }}"></script>

    <!-- CROPPER -->
    <!-- <script src="{{ asset('backend/cropperjs/docs/js/cropper.js') }}"></script> -->

    @yield('script')

</body>

</html>