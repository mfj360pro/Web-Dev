@extends('backend.shared._layout')

@section('css')

    <style>
        p.description {
            font-size: 13px;
        }
        .selection-highlight > td {
            background-color:#e9ecef !important;
            font-weight: 600;
        }
    </style>
    
@endsection

@section('modal')
    <div class="modal fade" id="modal-photographer">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Photographer Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <form>
                        <input id="id" name="id" type="text" class="form-control form-control-alternative" disabled hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">First Name</label>
                                    <input id="firstname" type="text" class="form-control form-control-alternative" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Last Name</label>
                                    <input id="lastname" type="text" class="form-control form-control-alternative" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Phone Number</label>
                                    <input id="phone" name="phone" type="text" class="form-control form-control-alternative" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input id="email" name="email" type="text" class="form-control form-control-alternative" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Password <span style="font-weight: 100">(leave blank to remain unchanged)</span></label>
                                    <input id="password" name="password" type="password" class="form-control form-control-alternative" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger"  data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-success" data-dismiss="modal" onclick="Save(0)">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-zipcode">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 id="zipcode-title" class="card-title">Add Zipcode</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <form>
                        <input id="zipcode_id" name="zipcode_id" type="text" class="form-control form-control-alternative" hidden disabled>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Zipcode <span id="zipcode-note" style="font-weight: 200;" class="text-muted"></span></label>
                                    <input id="zipcode" name="zipcode" type="text" list="zipcodes_data" class="form-control form-control-alternative" >
                                    <datalist id="zipcodes_data">
                                        
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">On Site Fee <span style="font-weight: 200;" class="text-muted">Leave blank for zero fees.</span></label>
                                    <input id="fee" name="fee" type="number" class="form-control form-control-alternative" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger"  data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-success" data-dismiss="modal" onclick="Save(1)">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-service">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Service Info</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <form>
                        <input id="pricing_id" name="pricing_id" type="text" class="form-control form-control-alternative" disabled hidden>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Service</label>
                                    <input id="service" name="service" type="text" list="services_data" class="form-control form-control-alternative" >
                                    <datalist id="services_data">
                                        
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-control-label">Price</label>
                                    <input id="price" name="price" type="number" step="0.01" min="0" class="form-control form-control-alternative" >
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="form-control-label">Unit</label>
                                    <input id="unit" name="unit" type="text" list="units_data" class="form-control form-control-alternative" onchange="SetValue(this)">
                                    <datalist id="units_data">
                                        
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger"  data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-success" data-dismiss="modal" onclick="Save(2)">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
      
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container">
            <p class="text-white display-2">Photographers</p>
        </div>
    </div>
      
    <div class="container mt--7">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <button class="btn btn-sm btn-success float-right" onclick="Add(0)">Create New</button>
                        <h3>Photographers List</h3>
                        <p class="description">Click an item to view their designated ZIP Codes.</p>
                    </div>
                    <div class="card-body">
                        <div id="grid_photographers" class="table-responsive"></div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div class="container mt-3 mb-7">
        <div class="row">
            <div class="col-md-5 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <button class="btn btn-sm btn-success float-right" onclick="Add(1)">Add ZIP Code</button>
                        <h3>ZIP Codes</h3>
                        <p class="description">Click to view available Services.</p>
                    </div>
                    <div class="card-body">
                        <div id="grid_zipcodes" class="table-responsive"></div>
                    </div>
                    <div class="card-footer">
                        <p id="zipcode-description" class="description"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <button class="btn btn-sm btn-success float-right" onclick="Add(2)">Add Services</button>
                        <h3>Services</h3>
                        <p class="description">List of Services per ZIP Codes.<br> </p>
                    </div>
                    <div class="card-body">
                        <div id="grid_services" class="table-responsive"></div>
                    </div>
                    <div class="card-footer">
                        <p id="services-description" class="description"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection

@section('script')

    <script type="text/javascript"> 

        setSideBar('#menu-photographers');

        var grid_photographers  = "#grid_photographers";
        var grid_zipcodes       = "#grid_zipcodes";
        var grid_services       = "#grid_services";
        
        var modal_photographer  = "#modal-photographer";
        var modal_zipcode       = "#modal-zipcode"
        var modal_service       = "#modal-service"

        var current = {
            photographer  : '',
            zipcode       : '',
            service       : ''
        }

        $(function() {

            $(grid_photographers).jsGrid({

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
                        Controller.Read('/WebService/ReadPhotographers').done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertAccount', item).done(function(data) {
                            
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertAccount', item).done(function(data) {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteAccount', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields: 
                    [
                        {   name: "name",       type: "text",       width: 80,  title: "Name",
                            itemTemplate: function(value, item) {
                                return item.firstname + ' ' + item.lastname;
                            }
                        },
                        {   name: "phone",      type: "text",       width: 80,  title: "Phone"                        },
                        {   name: "email",      type: "text",       width: 80,  title: "Email"                        },
                        {   name: "action",     type: "text",       width: 40,  title: "Action",
                                                                    
                            itemTemplate: function(value, item) {

                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var btnEdt = $("<button>").addClass('jsgrid-button jsgrid-edit-button')//.append(iconEdt)
                                                .click(function(e) {                       
                                                    
                                                    $("#id").val(item.id);
                                                    $("#firstname").val(item.firstname);
                                                    $("#lastname").val(item.lastname);
                                                    $("#email").val(item.email);
                                                    $("#phone").val(item.phone);
                                                    $("#password").val('');

                                                    $(modal_photographer).modal({ 
                                                        "backdrop"  : "static",
                                                        "keyboard"  : true,
                                                        "show"      : true
                                                    });

                                                });

                                var btnDel = $("<button>").addClass('jsgrid-button jsgrid-delete-button')//.append(iconDel)
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
                                                                $(grid_photographers).jsGrid("deleteItem", item).done(function() {});
                                                            }
                                                        }
                                                    });
                                                });
                                
                                return result.add(btnEdt).add(btnDel);

                            },
                        }
                    ],
                rowClick: function(args) {
                    this.rowByItem(args.item).toggleClass("selection-highlight");
                    this.rowByItem(current.photographer).toggleClass("selection-highlight");
                    console.log(args.item);
                    current.photographer    = args.item;
                    current.zipcode         = '';
                    current.services        = '';
                    $(grid_zipcodes).jsGrid("loadData");
                    $(grid_services).jsGrid("loadData");
                },
            })
               
            $(grid_zipcodes).jsGrid({

                // table config
                width: "100%",
                height: "auto",
                autoload: false,
                updateOnResize: true,

                paging: true,
                pageIndex: 1,
                pageSize: 10,
                noDataContent: "Please select a photographer.",

                inserting: false,
                editing: false,
                deleting: false,
                sorting: true,

                confirmDeleting: false,

                // data controller
                controller: {
                    loadData:  function() {
                        var d = $.Deferred();
                        Controller.Create('/WebService/ReadPhotographerZipcodes', current.photographer).done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertPhotographerZipcode', item).done(function(data) {
                            // zipcodes = data;
                            console.log(data);
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Create('/WebService/DeletePhotographerZipcode', item).done(function(data) {
                            console.log(data);
                        });
                    }
                },

                // data fields
                fields: 
                    [
                        {   name: "zipcode",    type: "number",     width: 60,  title: "Zipcode",   sort: "ascending"   },
                        {   name: "fee",        type: "text",       width: 60,  title: "On Site Fee"                    },
                        {   name: "action",     type: "text",       width: 60,  title: "Action",
                                                                    
                            itemTemplate: function(value, item) {

                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var btnEdt = $("<button>").addClass('jsgrid-button jsgrid-edit-button')//.append(iconEdt)
                                                .click(function(e) {         

                                                    $("#zipcode-title").text('Edit ZIP Code');
                                                    $("#zipcode_id").val(item.id);
                                                    $("#zipcode-note").text('Note: You cannot change the zip code in edit mode.');
                                                    $("#zipcode").val(item.zipcode).attr('disabled','');
                                                    $("#fee").val(item.fee);
                                                    LoadZipcodesDropdown();
                                                    $(modal_zipcode).modal({ 
                                                        "backdrop"  : "static",
                                                        "keyboard"  : true,
                                                        "show"      : true
                                                    });

                                                });

                                var btnDel = $("<button>").addClass('jsgrid-button jsgrid-delete-button')//.append(iconDel)
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
                                                                $(grid_zipcodes).jsGrid("deleteItem", item).done(function() {});
                                                            }
                                                        }
                                                    });
                                                });
                                
                                return result.add(btnEdt).add(btnDel);

                            },
                        }
                    ],
                rowClick: function(args) {
                    this.rowByItem(args.item).toggleClass("selection-highlight");
                    this.rowByItem(current.zipcode).toggleClass("selection-highlight");
                    current.zipcode = args.item;
                    $(grid_services).jsGrid("loadData");
                },
            })
                
            $(grid_services).jsGrid({

                // table config
                width: "100%",
                height: "auto",
                autoload: false,
                updateOnResize: true,

                paging: true,
                pageIndex: 1,
                pageSize: 10,
                noDataContent: "Please select a zipcode.",

                inserting: false,
                editing: false,
                deleting: false,
                sorting: true,

                confirmDeleting: false,

                // data controller
                controller: {
                    loadData: function() { 
                        var d = $.Deferred();
                        Controller.Create('/WebService/ReadPricingByZipcode', current.zipcode).done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertPricing', item).done(function(data) {
                            services = data;
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Create('/WebService/DeletePricing', item).done(function(data) {
                            console.log(data);
                        });
                    }
                },

                // data fields
                fields: 
                [
                        {   name: "id",         type: "disabled",   width: 40,  title: "ID",        visible: false  },
                        {   name: "title",      type: "text",       width: 100, title: "Service",
                            itemTemplate: function(value, item) {
                                return item.service.title;
                            }
                        },
                        {   name: "price",      type: "text",       width: 100, title: "Price",
                            itemTemplate: function(value, item) {
                                return '$' + item.price + ' per ' + item.unit.name;
                            }
                        },
                        {   name: "action",     type: "text",       width: 40,  title: "Action",                                                                    
                            itemTemplate: function(value, item) {

                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var iconEdt = $('<span>').text('Edit');
                                var iconDel = $('<span>').text('Remove');

                                var btnEdt = $("<button>").addClass('jsgrid-button jsgrid-edit-button')//.append(iconEdt)
                                                .click(function(e) {
                                                    
                                                    LoadServicesDropdown();

                                                    $('#pricing_id').val(item.id);
                                                    $('#service').val(item.service.title);
                                                    $('#unit').val(item.unit.name);
                                                    $('#price').val(item.price);

                                                    $(modal_service).modal({ 
                                                        "backdrop"  : "static",
                                                        "keyboard"  : true,
                                                        "show"      : true
                                                    });

                                                });

                                var btnDel = $("<button>").addClass('jsgrid-button jsgrid-delete-button')//.append(iconDel)
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
                                                                $(grid_services).jsGrid("deleteItem", item).done(function() {});
                                                            }
                                                        }
                                                    });
                                                });
                                
                                return result.add(btnEdt).add(btnDel);

                            },
                        }
                    ],
                rowClick: function(args) {
                    this.rowByItem(args.item).toggleClass("selection-highlight");
                    this.rowByItem(current.service).toggleClass("selection-highlight");
                    current.service = args.item;
                },
            })
                
        })
        
        function Add(i) {
            switch (i) {
                case 0:
                          
                    $("#id").val('-1');
                    $("#firstname").val('');
                    $("#lastname").val('');
                    $("#email").val('');
                    $("#phone").val('');
                    $("#password").val('');
  
                    $(modal_photographer).modal({ 
                        "backdrop"  : "static",
                        "keyboard"  : true,
                        "show"      : true
                    });

                    break;

                case 1:
                    
                    if(current.photographer == '') break;

                    LoadZipcodesDropdown();   
                    $("#zipcode-title").text('Add ZIP Code');
                    $("#zipcode_id").val('-1');
                    $("#zipcode-note").text('');
                    $("#zipcode").val('').removeAttr('disabled');
                    $("#fee").val('');

                    $(modal_zipcode).modal({ 
                        "backdrop"  : "static",
                        "keyboard"  : true,
                        "show"      : true
                    });

                    break;

                case 2:
                    
                    if(current.zipcode == '') break;

                    $('#pricing_id').val('-1');
                    $('#service').val('');
                    $('#unit').val('');
                    $('#price').val('');

                    LoadServicesDropdown();

                    $(modal_service).modal({ 
                        "backdrop"  : "static",
                        "keyboard"  : true,
                        "show"      : true
                    });

                    break;
            
            
                default:
                    break;
            }
        }

        function Save(i) {

            switch (i) {

                case 0:
                    
                    var data = {
                        id:         $('#id').val(),
                        firstname:  $('#firstname').val(),
                        lastname:   $('#lastname').val(),
                        phone:      $('#phone').val(),
                        email:      $('#email').val(),
                        password:   $('#password').val(),
                        roles:      [5]
                    };

                    $(grid_photographers).jsGrid("updateItem", data).done(function() {
                        current.photographer    = '';
                        current.zipcode         = '';
                        current.services        = '';
                        $(grid_photographers).jsGrid("loadData");
                        $(grid_zipcodes).jsGrid("loadData");
                        $(grid_services).jsGrid("loadData");
                    });

                    break;

                case 1:
                    
                    var data = {
                        zipcode_id: $('#zipcode_id').val(),
                        zipcode:    $('#zipcode').val(),
                        fee:        $('#fee').val(),
                        id:         current.photographer.id
                    };

                    Controller.Create('/WebService/UpsertPhotographerZipcode', data).done(function(result) {
                        console.log(result);
                        if(result.result_code == 0) {
                            $('#zipcode-description').addClass('text-danger');
                            $('#zipcode-description').text(result.message);
                            setTimeout(function() {
                                $('#zipcode-description').removeClass('text-danger');
                                $('#zipcode-description').text('');
                            }, 3000);
                        }
                    });

                    current.zipcode     = '';
                    current.services    = '';
                    $(grid_zipcodes).jsGrid("loadData");
                    $(grid_services).jsGrid("loadData");

                    break;
                    
                case 2:
                    
                    var data = {
                        // service_id:     document.getElementById('service_id').list.querySelector('option[value="'+ document.getElementById('service_id').value +'"]').dataset.id,
                        // units_id:       document.getElementById('units_id').list.querySelector('option[value="'+ document.getElementById('units_id').value +'"]').dataset.id,
                        id:         $('#pricing_id').val(),
                        service:    $('#service').val(),
                        unit:       $('#unit').val(),
                        zipcode:    current.zipcode.zipcode,
                        price:      $('#price').val()
                    };

                    console.log(data);

                    $(grid_services).jsGrid("insertItem", data).done(function(result) {
                        current.services = '';
                        $(grid_services).jsGrid("loadData");
                    });

                    break;
            
                default:
                    break;
            }
        }

        function LoadZipcodesDropdown() {
            Controller.Read('/WebService/ReadZipcodes').done(function(data){
                document.getElementById('zipcodes_data').innerHTML = '';
                data.forEach(function(item){
                    var option = document.createElement('option');
                    option.value = item.zipcode;
                    option.setAttribute('data-id', item.id);
                    document.getElementById('zipcodes_data').appendChild(option);
                });
            });
        }

        function LoadServicesDropdown() {

            Controller.Read('/WebService/ReadServices').done(function(data){
                document.getElementById('services_data').innerHTML = '';
                data.forEach(function(item){
                    var option = document.createElement('option');
                    option.value = item.title;
                    option.setAttribute('data-id', item.id);
                    document.getElementById('services_data').appendChild(option);
                });
            });
            
            Controller.Read('/WebService/ReadUnits').done(function(data){
                document.getElementById('units_data').innerHTML = '';
                data.forEach(function(item){
                    var option = document.createElement('option');
                    option.value = item.name;
                    option.setAttribute('data-id', item.id);
                    document.getElementById('units_data').appendChild(option);
                });
            });

        }

        function SetValue(el) {
            console.log(el.list.querySelector('option[value="'+ el.value +'"]').dataset.id);
        }

    </script>
	
@endsection