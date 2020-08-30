@extends('backend.shared._layout')

@section('css')
    
@endsection

@section('modal')
    <div class="modal fade" id="modal-service">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Service Type</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <form>
                        <input id="id" name="id" type="text" class="form-control form-control-alternative" disabled hidden>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Type</label>
                                    <input id="type" name="type" type="text" list="types_data" class="form-control form-control-alternative" >
                                    <datalist id="types_data">
                                        
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </form>
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
            <p class="text-white display-2">Uploader Settings</p>
        </div>
    </div>
      
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <h3>Service List</h3>
                        <span style="font-weight: 400;" class="h5 text-muted">This configures the expected type of data to be uploaded and/or downloaded by the users.</span>
                    </div>
                    <div class="card-body">
                        <div id="grid-service-list" class="table-responsive"></div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
        
@endsection

@section('script')

    <script type="text/javascript"> 

        setSideBar('#menu-uploader');

        var grid_service_list = "#grid-service-list";
        var modal_service = "#modal-service";
        var inEditMode;

        $(function() {

            $(grid_service_list).jsGrid({

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
                        Controller.Read('/WebService/ReadServiceTypes').done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertServiceType', item).done(function(data) {
                            
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertServiceType', item).done(function(data) {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteServiceType', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields: 
                    [
                        {   name: "title",  type: "text",   width: 100, title: "Service"        },
                        {   name: "type",   type: "text",   width: 100, title: "Data Type",
                            itemTemplate: function(value, item) {
                                return item.type.display_name;
                            }
                        },
                        {   name: "action",     type: "text",   width: 50, title: "Action",
                                                                    
                            itemTemplate: function(value, item) {

                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                var iconEdt = $('<span>').text('Edit');
                                var btnEdt = $("<button>").addClass('btn btn-sm btn-info').append(iconEdt)
                                                .click(function(e) {                       
                                                    
                                                    $("#id").val(item.id);
                                                    $("#type").val(item.type.display_name);

                                                    $(modal_service).modal({ 
                                                        "backdrop"  : "static",
                                                        "keyboard"  : true,
                                                        "show"      : true
                                                    });

                                                });

                                return result.add(btnEdt);

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

        $(document).on("click", "#btnSave", function(e) {
            
            var data = {
                id:     $('#id').val(),
                type:   $('#type').val()
            };

            $(grid_service_list).jsGrid("updateItem", data).done(function() {
                $(grid_service_list).jsGrid("loadData");
            });

        });
        
        function LoadDropdowns() {

            Controller.Read('/WebService/ReadTypes').done(function(data){
                document.getElementById('types_data').innerHTML = '';
                data.forEach(function(item){
                    var option = document.createElement('option');
                    option.value = item.display_name;
                    option.setAttribute('data-id', item.id);
                    document.getElementById('types_data').appendChild(option);
                });
            });

        }
        LoadDropdowns();


    </script>
	
@endsection