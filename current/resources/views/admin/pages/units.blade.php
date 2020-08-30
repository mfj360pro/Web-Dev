@extends('backend.shared._layout')

@section('css')
    
@endsection

@section('modal')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Unit Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Unit ID</label>
                                    <input id="id" name="id" type="text" class="form-control form-control-alternative" disabled>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <input id="name" name="name" type="text" class="form-control form-control-alternative" >
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
            <p class="text-white display-2">Units</p>
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

        setSideBar('#menu-units');

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
                        Controller.Read('/WebService/ReadUnits').done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertUnit', item).done(function(data) {
                            
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertUnit', item).done(function(data) {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteUnit', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields: 
                    [
                        {   name: "id",     type: "disabled",   width: 40,  title: "ID",        visible: false  },
                        {   name: "name",   type: "text",       width: 100, title: "Name"                       },
                        {   name: "action", type: "text",       width: 100, title: "Action",
                                                                    
                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var iconEdt = $('<span>').text('Edit');
                                var iconDel = $('<span>').text('Remove');

                                var btnEdt = $("<button>").addClass('btn btn-sm btn-info').append(iconEdt)
                                                .click(function(e) {                       
                                                    
                                                    $("#id").val(item.id);
                                                    $("#name").val(item.name);

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
            $("#name").val('');

            $(modal).modal({ 
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        });

        $(document).on("click", "#btnSave", function(e) {
            
            var data = {
                id:     $('#id').val(),
                name:   $('#name').val()
            };

            if(data.id > 0) {
                $(grid_table).jsGrid("updateItem", data).done(function() {
                    $(grid_table).jsGrid("loadData");
                });
            }
            else {
                $(grid_table).jsGrid("insertItem", data).done(function() {
                    $(grid_table).jsGrid("loadData");
                });
            }

        });

    </script>
	
@endsection