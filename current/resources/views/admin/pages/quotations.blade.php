@extends('backend.shared._layout')

@section('css')
    <style>
        .pac-container {
            z-index: 1072 !important;
            width: auto !important;
            display: block !important;
        }
        .pac-container:empty{
            display: none !important;
        }
    </style>
@endsection

@section('modal')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Shoot Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <input id="id" name="id" type="text" class="form-control form-control-alternative" disabled hidden>
                    <div class="row d-none">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Title</label>
                                <input id="title" name="title" type="text" class="form-control form-control-alternative" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Customer</label>
                                <select id="customer_id" name="customer_id" class="form-control form-control-alternative"  placeholder="Role Code">
                                    <option class="text-dark" value="" disabled selected>Select</option>
                                    @foreach ($customers as $item)
                                        <option class="text-dark" value="{{$item['id']}}">{{$item['firstname'].' '.$item['lastname']}} ({{$item['email']}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Address</label>
                                <input id="address" name="address" type="text" class="form-control form-control-alternative" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Start Date</label>
                                <input id="start_date" type="date" name="start_date" class="form-control form-control-alternative"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Status</label>
                                <select id="status_id" name="status_id" class="form-control form-control-alternative"  placeholder="Role Code">
                                    <option class="text-dark" value="" disabled selected>Select</option>
                                    @foreach ($status as $item)
                                        <option class="text-dark" value="{{$item['flow']}}">{{$item['work_status']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Notes</label>
                                <textarea rows="6" id="notes" name="notes" type="text" class="form-control form-control-alternative"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger"  data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-success" id="btnSave">Save</button>
                    {{-- <button class="btn btn-sm btn-success" data-dismiss="modal" id="btnSave">Save</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
      
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <p class="text-white display-2">Shoots</p>
        </div>
    </div>
      
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <button class="btn btn-sm btn-success" id="btnAddNew">Add New</button>
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

        setSideBar('#menu-shoots');

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
                        Controller.Read('/WebService/ReadQuotations').done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertQuotation', item).done(function() {
                            
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertQuotation', item).done(function() {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteQuotation', item).done(function() {

                        });
                    }
                },

                // data fields
                fields: 
                    [
                        {   name: "created_at",     type: "datetime",   width: 50,  title: "Date"                       },
                        {   name: "address",        type: "text",       width: 110, title: "Title",
                            itemTemplate: function(value, item) {
                                return item.address + ' ' + item.zipcode.zipcode;
                            }
                        },
                        {   name: "customer",       type: "text",       width: 90, title: "Customer",
                            itemTemplate: function(value, item) {
                                return item.customer.firstname + ' ' + item.customer.lastname;
                            }
                        },
                        {   name: "status",         type: "text",       width: 45,  title: "Status",
                            itemTemplate: function(value, item) {
                                if(item.completed) return item.status.work_status + ' (DONE)'
                                else return item.status.work_status;
                            }
                        },
                        {   name: "action",         type: "text",       width: 45, title: "Action",
                                                                    
                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var iconVew = $('<span>').text('View');
                                var iconEdt = $('<span>').text('Edit');
                                var iconDel = $('<span>').text('Remove');

                                var btnVew = $("<a>").addClass('btn btn-sm btn-primary')
                                            .append(iconVew)
                                            .attr('href', '/admin/breakdown?id=' + item.id)
                                            .attr('target', '_blank');
                                            
                                var btnEdt = $("<button>").addClass('jsgrid-button jsgrid-edit-button') //btn btn-sm btn-info').append(iconEdt)
                                            .click(function(e) {
                                                
                                                $("#id").val(item.id);
                                                $("#title").val(item.title);
                                                $("#notes").val(item.notes);
                                                $("#address").val(item.address);
                                                $("#customer_id").val(item.customer.id);
                                                $("#status_id").val(item.status.flow);
                                                $('#start_date').val(ConvertDate(item.start_date));
                                                // $('#end_date').val(ConvertDate(item.end_date));

                                                $(modal).modal({ 
                                                    "backdrop"  : "static",
                                                    "keyboard"  : true,
                                                    "show"      : true
                                                });

                                            });

                                var btnDel = $("<button>").addClass('jsgrid-button jsgrid-delete-button') //btn btn-sm btn-danger').append(iconDel)
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
                                
                                return result.add(btnVew).add(btnEdt).add(btnDel);

                            },
                        }
                    ]
            })
                
        })

        function ConvertDate(value) {
            var date = new Date(value);
            return date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0)
        }
        
        function DatetimeField(config) {
            jsGrid.Field.call(this, config);
        }

        DatetimeField.prototype = new jsGrid.Field({
            sorter: function (date1, date2) {
                return new Date(date1) - new Date(date2);
            },
            itemTemplate: function (value) {
                if (value === null) {
                    return '';
                } else {
                    return new Date(value).toLocaleDateString('en-US', {
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric'
                    });
                }
            },
        });

        jsGrid.fields.datetime = jsGrid.DatetimeField = DatetimeField;

        $(document).on("click", "#btnAddNew", function(e) {   
            
            $("#id").val('-1');
            $("#title").val('');
            $("#notes").val('');
            $("#address").val('');
            $("#customer_id").val('');
            $("#zipcode").val('');
            $("#status_id").val('');
            $("#start_date").val('');
            // $("#end_date").val('');

            $(modal).modal({ 
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        });

        $(document).on("click", "#btnSave", function(e) {

            var place = $('#address').val();
            geocoder.geocode({ 'address': place }, function(results, status) {
                if(status == 'OK') {
                    zipcode = '';
                    results.forEach(element => {
                        element.address_components.forEach(component => {
                            component.types.forEach(type => {
                                if(type == 'postal_code') {
                                    zipcode = component.long_name;
                                    console.log(zipcode);
                                }
                            });
                        });
                    });
                    if(zipcode != '') {

                        var data = {
                            id:             $('#id').val(),
                            title:          $('#title').val(),
                            notes:          $('#notes').val(),
                            address:        $('#address').val(),
                            customer_id:    $('#customer_id').val(),
                            zipcode:        zipcode,
                            start_date:     $('#start_date').val(),
                            // end_date:       $('#end_date').val(),
                            status_id:      $('#status_id').val()
                        };
                        
                        // console.log(data);
                        Controller.Create('/WebService/UpsertQuotation', data).done(function(result) {
                            console.log(result);
                            $(grid_table).jsGrid("loadData");
                            $(modal).modal('toggle');
                        });

                        // $(grid_table).jsGrid("updateItem", data).done(function() {
                        //     $(modal).modal('toggle');
                        // });

                    }
                       
                }
                else {
                    
                }
            });
            
        });

        // setInterval(function(){
        //     Controller.Create('/WebService/LogUser', {'datatable' : 'quotation'}).done(function(result) {});
        // }, 1000);
        
    </script>

    <script type="text/javascript">
        
        var geocoder;
        // comment out before pushing
        // google.maps.event.addDomListener(window, 'load', initAutocomplete);
        function initAPI() {
            geocoder = new google.maps.Geocoder();
            var autocomplete = 
                    new google.maps.places.Autocomplete(
                        document.getElementById('address'), {
                            // types: ['(postal codes)'],
                            // componentRestrictions: {'country': ['ca','us']}
                        }
                    );
            autocomplete.setFields(['formatted_address']);
        }

    </script>
    
    {{-- uncomment before pushing --}}
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGd05FcNQn4ozL7OArBFP12PTwHsEI1Rk&libraries=places&callback=initAPI"></script>  
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGd05FcNQn4ozL7OArBFP12PTwHsEI1Rk&libraries=places&callback=initAutocomplete"async defer></script>   --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGd05FcNQn4ozL7OArBFP12PTwHsEI1Rk&libraries=places"async defer></script>   --}}

@endsection