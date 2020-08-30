@extends('backend.shared._layout')

@section('css')
    
@endsection

@section('modal')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Service Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <input id="id" name="id" type="text" class="form-control form-control-alternative" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Service</label>
                                <select onchange="SetPricing()" id="service_id" name="service_id" class="form-control form-control-alternative"  placeholder="Role Code">
                                    <option class="text-dark" value="" disabled selected>Select</option>
                                    @foreach ($services as $item)
                                        <option class="text-dark" value="{{$item['id']}}">{{$item['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Pricing <span style="font-weight: 100;">varies per zipcode</span></label>
                                <select onchange="GetTotal()" id="pricing_id" name="pricing_id" class="form-control form-control-alternative">
                                    <option class="text-dark" value="" disabled selected>Select</option>                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Quantity</label>
                                <input oninput="GetTotal()" id="quantity" name="quantity" type="number" step="0.01" min="1" class="form-control form-control-alternative" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Amount</label>
                                <input id="total" name="total" type="number" class="form-control form-control-alternative" disabled style="font-weight: 800;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger"  data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-success" data-dismiss="modal" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
      
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <p class="text-white display-2">Shoot Details</p>
        </div>
    </div>
      
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <h3>Customer Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="containter">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input value="{{$customer['firstname'].' '.$customer['lastname']}}" type="text" class="form-control form-control-alternative" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input value="{{$customer['email']}}" type="text" class="form-control form-control-alternative" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Phone</label>
                                        <input value="{{$customer['phone']}}" type="text" class="form-control form-control-alternative" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Service Address <span style="font-weight: 100;">(The address to render the services on the list)</span></label>
                                        @foreach ($zipcodes as $item)
                                            @if ($item['id'] == $quotation['zipcode_id'])                                        
                                                <input value="{{$quotation['address']}} {{$item['zipcode']}}" type="text" class="form-control form-control-alternative" disabled>
                                            @endif                                            
                                        @endforeach
                                    </div>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Start Date</label>
                                        <input id="start_date" type="text" class="form-control form-control-alternative" disabled>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">End Date</label>
                                        <input id="end_date" type="text" class="form-control form-control-alternative" disabled>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">     
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-success float-bottom" id="btnAddNew">Add Service Item</button>
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label" style="font-weight: 800;">Total Amount</label>
                                <input id="totalamount" name="totalamount" type="number" min="0" value="0" class="form-control form-control-alternative" disabled style="font-weight: 800;">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="grid-table" class="table-responsive"></div>
                    </div>
                </div>
            </div>
        </div>       
        {{-- <div class="row mt-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">   
                        <button class="btn btn-sm btn-info float-bottom" id="btnPrint">PRINT QUOTATION</button>
                    </div>
                </div>
            </div>
        </div>       --}}
    </div>
        
@endsection

@section('script')

    <script type="text/javascript">

        setSideBar('#menu-shoots');

        var quotation   = {!! json_encode($quotation) !!};
        var services    = {!! json_encode($services)  !!};
        var pricings    = {!! json_encode($pricings)  !!};
        var units       = {!! json_encode($units)     !!};
        var zipcodes    = {!! json_encode($zipcodes)  !!};

        $('#start_date').val(ConvertDate(quotation.start_date));
        // $('#end_date').val(ConvertDate(quotation.end_date));

        function ConvertDate(value) {
            return new Date(value).toLocaleDateString('en-US', {
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric'
                    });
        }
        
        function SetPricing() {
            var service_id = $('#service_id').val();
            var pricing_id = $('#pricing_id').val('');
            var quantity   = $('#quantity').val('');
            var total      = $('#total').val('');
            document.getElementById('pricing_id').innerHTML = '<option class="text-dark" value="" disabled selected>Select</option>';
            pricings.forEach(pricing => {
                if(pricing.service_id == service_id)
                    units.forEach(unit => {
                        if(pricing.unit_id == unit.id) {
                            zipcodes.forEach(zipcode => {
                                if(pricing.zipcode_id == zipcode.id) {
                                    var option = document.createElement('option');
                                    option.setAttribute('class', 'text-dark');
                                    option.setAttribute('value', pricing.id);
                                    option.text = '$'+ pricing.price + ' per ' + unit.name;
                                    document.getElementById('pricing_id').appendChild(option);
                                }
                            });
                        }
                    });
            });           
        }
        function GetTotal() {
            var pricing_id = $('#pricing_id').val();
            var quantity   = $('#quantity').val();
            if(quantity == null || pricing_id == null) return;
            pricings.forEach(pricing => {
                if(pricing.id == pricing_id)
                    $('#total').val(pricing.price * quantity);
            });
        }
        function SetTotalAmount() {
            $('#totalamount').val('0');
            Controller.ReadWithParameter('/WebService/ReadBreakdown', { 'id' : quotation.id }).done(function(data) {
                var amount = 0;
                data.forEach(element => {
                    amount += element.total;
                });
                $('#totalamount').val(Math.round(amount));
            });
        }
        SetTotalAmount();

        var grid_table = "#grid-table";
        var modal = "#modal-default";
        var inEditMode;

        $(function() {

            $(grid_table).jsGrid({

                // table config
                width: "100%",
                height: "auto",
                autoload: true,
                updateOnResize: true,

                paging: true,
                pageIndex: 1,
                pageSize: 10,
                noDataContent: "No Services.",

                inserting: false,
                editing: false,
                deleting: false,
                sorting: true,

                confirmDeleting: false,

                // data controller
                controller: {
                    loadData: function() {
                        var d = $.Deferred();
                        Controller.ReadWithParameter('/WebService/ReadBreakdown', { 'id' : quotation.id }).done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertBreakdown', item).done(function(data) {
                            
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertBreakdown', item).done(function(data) {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteBreakdown', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields:
                    [
                        {   name: "id",         type: "disabled",   width: 40,  title: "ID",        visible: false  },
                        {   name: "service",    type: "text",       width: 100, title: "Service"                    },
                        {   name: "package",    type: "text",       width: 100, title: "Price Package"              },
                        {   name: "quantity",   type: "number",     width: 50,  title: "Qty"                        },
                        {   name: "total",      type: "number",     width: 60,  title: "Amount"                     },
                        {   name: "action",     type: "text",       width: 60,  title: "Action",
                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var iconDel = $('<span>').text('Remove');

                                var btnDel = $("<button>").addClass('btn btn-sm btn-danger').append(iconDel)
                                                .click(function(e) {
                                                    bootbox.confirm({
                                                        message: "Delete item?",
                                                        buttons: {
                                                            confirm: {
                                                                label: 'Delete',
                                                                className: 'btn-sm btn-danger'
                                                            },
                                                            cancel: {
                                                                label: 'Cancel',
                                                                className: 'btn-sm btn-info'
                                                            }
                                                        },
                                                        callback: function(result) {
                                                            if(result) {
                                                                $(grid_table).jsGrid("deleteItem", item).done(function() {});
                                                                SetTotalAmount();
                                                            }
                                                        }
                                                    });
                                                });
                                
                                return result.add(btnDel);

                            },
                        }
                    ]
            })
                
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

        $(document).on("click", "#btnAddNew", function(e) {   
            
            $("#id").val('-1');
            $("#service_id").val('');
            $("#pricing_id").val('');
            $("#quantity").val('');

            $(modal).modal({ 
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        });

        $(document).on("click", "#btnSave", function(e) {
            
            var data = {
                id:             $('#id').val(),
                quotation_id:   quotation.id,
                service_id:     $('#service_id').val(),
                pricing_id:     $('#pricing_id').val(),
                quantity:       $('#quantity').val()
            };

            $(grid_table).jsGrid("updateItem", data).done(function() {
                $(grid_table).jsGrid("loadData");
                SetTotalAmount();
            });

        });

    </script>
	
@endsection