@extends('backend.shared._layout')

@section('css')
    
@endsection

@section('modal')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Pricing Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <form>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Pricing ID</label> --}}
                                    <input hidden id="id" name="id" type="text" class="form-control form-control-alternative" disabled>
                                {{-- </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Service</label>
                                    <select id="service_id" name="service_id" class="form-control form-control-alternative"  placeholder="Service">
                                        <option class="text-muted" value="" disabled selected>Select</option>
                                        @foreach ($services as $item)
                                            <option class="text-muted" value="{{$item['id']}}">{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Price</label>
                                    <input id="price" name="price" type="number" step="0.01" min="0" class="form-control form-control-alternative" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label">Quantity</label>
                                    <input id="quantity" name="quantity" type="number" step="0.01" min="1" class="form-control form-control-alternative" >
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-control-label">Unit</label>
                                    <input id="unit" name="unit" type="text" list="units_data" class="form-control form-control-alternative" >
                                    <datalist id="units_data">
                                        @foreach ($units as $item)
                                            <option class="text-muted" value="{{$item['name']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </datalist>

                                    {{-- <select id="unit" name="unit" class="form-control form-control-alternative">
                                        <option class="text-muted" value="" disabled selected>Select</option>
                                        @foreach ($units as $item)
                                            <option class="text-muted" value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Location (Zipcode)</label>
                                    <input id="zipcode" name="zipcode" type="text" class="form-control form-control-alternative">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-success" id="btnSaveAdd">Save & Add New</button>
                    <button class="btn btn-sm btn-danger"  data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
      
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <p class="text-white display-2">Price List</p>
        </div>
    </div>
      
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <button class="btn btn-sm btn-success" id="btnCreateNew">Create New</button>
                    </div>
                    <div class="card-body">
                        <div id="grid-table" class="table-responsive"></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
        
@endsection

@section('script')

    <script type="text/javascript"> 

        setSideBar('#menu-pricing');

        var grid_table = "#grid-table";
        var modal = "#modal-default";
        var inEditMode;
        var services = {!! json_encode($services) !!};
        var units = {!! json_encode($units) !!};
        var zipcodes = {!! json_encode($zipcodes) !!};

        $(function() {

            $(grid_table).jsGrid({

                // table config
                width: "100%",
                height: "auto",
                autoload: true,
                updateOnResize: true,

                paging: true,
                pageIndex: 1,
                pageSize: 50,
                noDataContent: "No Data.",

                inserting: false,
                editing: false,
                deleting: false,
                sorting: true,

                confirmDeleting: false,

                // data controller
                controller: {
                    loadData: function() {
                        var d = $.Deferred();
                        Controller.Read('/WebService/ReadPricings').done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertPricing', item).done(function(data) {
                            
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertPricing', item).done(function(data) {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeletePricing', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields: 
                    [
                        {   name: "id",         type: "disabled",   width: 40,  title: "ID",        visible: false  },
                        {   name: "service_id", type: "select",     width: 110,  title: "Service",
                            items: services,
                            valueField: "id",
                            textField: "title"
                        },
                        {   name: "zipcode_id", type: "select",     width: 80,  title: "Location (Zipcode)",
                            items: zipcodes,
                            valueField: "id",
                            textField: "zipcode"
                        },
                        {   name: "quantity",   type: "number",     width: 50,  title: "Qty"                        },
                        {   name: "unit_id",    type: "select",     width: 80,  title: "Unit",
                            items: units,
                            valueField: "id",
                            textField: "name"
                        },
                        {   name: "price",      type: "number",     width: 50,  title: "Price"                      },
                        {   name: "action",     type: "text",       width: 100, title: "Action",
                                                                    
                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var iconEdt = $('<span>').text('Edit');
                                var iconDel = $('<span>').text('Remove');

                                var btnEdt = $("<button>").addClass('btn btn-sm btn-info').append(iconEdt)
                                                .click(function(e) {                       
                                                    
                                                    $("#id").val(item.id);
                                                    $("#service_id").val(item.service_id);
                                                    $("#price").val(item.price);
                                                    $("#unit").val(units.filter(unit=> unit.id == item.unit_id)[0].name);
                                                    $("#quantity").val(item.quantity);

                                                    zipcodes.forEach(zipcode => {
                                                        if(zipcode.id == item.zipcode_id)
                                                            $("#zipcode").val(zipcode.zipcode);
                                                    });

                                                    $(modal).modal({ 
                                                        "backdrop"  : "static",
                                                        "keyboard"  : true,
                                                        "show"      : true
                                                    });

                                                });

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
                                                            }
                                                        }
                                                    });
                                                });
                                
                                return result.add(btnEdt).add(btnDel);

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

        $(document).on("click", "#btnCreateNew", function(e) {   
            
            $("#id").val('-1');
            $("#service_id").val('');
            $("#price").val('');
            $("#unit").val('');
            $("#quantity").val('');
            $("#zipcode").val('');

            $(modal).modal({ 
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        });

        $(document).on("click", "#btnSaveAdd", function(e) {
            
            var data = {
                id:         $('#id').val(),
                service_id: $('#service_id').val(),
                price:      $('#price').val(),
                unit:       $('#unit').val(),
                quantity:   $('#quantity').val(),
                zipcode:    $('#zipcode').val()
            };

            $(grid_table).jsGrid("updateItem", data).done(function() {
                Controller.Read('/WebService/ReadZipcodes').done(function(result){
                    zipcodes = result;
                    $(grid_table).jsGrid("loadData");
                });
            });

            $("#id").val('-1');
            $("#zipcode").val('');

        });

    </script>
	
@endsection