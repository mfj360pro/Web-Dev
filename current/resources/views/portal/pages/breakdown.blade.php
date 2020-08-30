@extends('backend.shared._print_layout')

@section('css')
    <style>
        h1, h2, h3, h4, h5, h6 {
            font-weight: 400;
        }
    </style>
@endsection

@section('content')
      
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <p class="text-white display-2">Shoot Details</p>
        </div>
    </div>
      
    <div id="main-container" class="container-fluid mt--7 mb-7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="float-right">Date Created: {{ date_format(date_create($quotation['created_at']),"F d, Y") }}</h4>
                                    <br>
                                    <h2 style="font-weight: 800;">{{$customer['firstname'].' '.$customer['lastname']}}</h2>
                                    <h4><strong>Service Address: </strong></h4>
                                    <h4>
                                        {{$quotation['address']}}
                                        @foreach ($zipcodes as $item)
                                            @if ($item['id'] == $quotation['zipcode_id'])                                        
                                                {{$item['zipcode']}}
                                            @endif                                            
                                        @endforeach
                                    </h4>
                                    <br>
                                    <h4><strong>Email: </strong>{{$customer['email']}}</h4>
                                    <h4><strong>Phone: </strong>{{$customer['phone']}}</h4>
                                    <br>
                                    <h4 id="start_date"><strong>Start Date: </strong></h4>
                                    <h4 id="end_date"><strong>End Date: </strong></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="grid-table"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="container">     
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 id="totalamount" style="font-weight: 800;"></h2>
                                </div>
                            </div>    
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h3>Notes:</h3>
                                    <h3>{{$quotation['notes']}}</h3>
                                </div>
                            </div>
                            <div class="row my-7">
                                <div class="col-md-6">
                                    <a href="/" style="font-weight: 800;" class="text-muted">MFJ 360 PRO</a>
                                    <h5 class="text-muted">Our mission at MFJ 360 Pro, is to bring your space alive.</h5>
                                    <h5 class="text-muted">phone: (831)200-2484<br>email: info@mfj360pro.com</h5>
                                    <h5 class="text-muted copyright-text">© 2020 Copyright MFJ360PRO. All Rights Reserved.</h5>
                                </div>
                                <div class="col-md-6">
                                    <a href="/"><img src="{{ asset('img/logo-black.png') }}" class="float-right" height="150" style="opacity: 0.6;"></a>
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

    <script type="text/javascript">

        setSideBar('#menu-shoots');

        var quotation   = {!! json_encode($quotation) !!};
        var breakdown   = {!! json_encode($breakdown) !!}
        var services    = {!! json_encode($services) !!};
        var pricings    = {!! json_encode($pricings) !!};
        var units       = {!! json_encode($units) !!}
        var zipcodes    = {!! json_encode($zipcodes) !!}

        var grid_table = "#grid-table";

        $('#start_date').append(ConvertDate(quotation.start_date));
        $('#end_date').append(ConvertDate(quotation.end_date));

        function ConvertDate(value) {
            return new Date(value).toLocaleDateString('en-US', {
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric'
                    });
        }
        
        $(function() {

            $(grid_table).jsGrid({

                // table config
                width: "100%",
                height: "auto",
                autoload: true,
                updateOnResize: true,

                paging: true,
                pageIndex: 1,
                pageSize: 100,
                noDataContent: "No Data.",

                inserting: false,
                editing: false,
                deleting: false,
                sorting: true,

                confirmDeleting: false,

                // data controller
                controller: {
                    loadData: function() { return {!! json_encode($breakdown) !!}}
                },

                // data fields
                fields:
                    [
                        {   name: "id",         type: "disabled",   width: 40,  title: "ID",        visible: false  },
                        {   name: "service",    type: "text",       width: 100, title: "Service"                    },
                        {   name: "package",    type: "text",       width: 100, title: "Price Package"              },
                        {   name: "quantity",   type: "number",     width: 50,  title: "Quantity"                   },
                        {   name: "total",      type: "number",     width: 60,  title: "Amount"                     }
                    ]
            })
            var amount = 0;
            breakdown.forEach(element => {
                amount += element.total;
                console.log(amount);
            });
            $('#totalamount').text('Total Amount: $' + Math.round(amount));

        })
        
        function DisabledField(config) {
            jsGrid.Field.call(this, config);
        }

        DisabledField.prototype = new jsGrid.Field({
            min: 0,
            _createTextBox: function () {
                return $("<input>").attr({
                    type: "number",
                    min: this.min, disabled: true
                });
            }
        });

        jsGrid.fields.disabled = jsGrid.DisabledField = DisabledField;

    </script>
	
@endsection