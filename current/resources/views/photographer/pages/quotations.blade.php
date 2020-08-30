@extends('backend.shared._layout')

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
                        <h3>Available Shoots</h3>
                    </div>
                    <div class="card-body">
                        <div id="grid-available-shoots" class="table-responsive"></div>
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
                        <h3>My Shoots</h3>
                    </div>
                    <div class="card-body">
                        <div id="grid-my-shoots" class="table-responsive"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')

    <script type="text/javascript">

        setSideBar('#menu-shoots');

        var grid_available_shoots   = "#grid-available-shoots";
        var grid_my_shoots          = "#grid-my-shoots";
        var modal                   = "#modal-default";

        $(function() {

            $(grid_available_shoots).jsGrid({

                // table config
                width: "100%",
                height: "auto",
                autoload: true,
                updateOnResize: true,

                paging: true,
                pageIndex: 1,
                pageSize: 6,
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
                        Controller.Create('/WebService/ReadAvailableQuotations', { 'id' : "{{$data['id']}}" }).done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/AssignQuotation', item).done(function(data) {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteQuotation', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields:
                    [
                        {   name: "created_at",     type: "datetime",   width: 50,  title: "Date"               },
                        {   name: "address",        type: "text",       width: 100, title: "Title / Address"    },
                        {   name: "action",         type: "text",       width: 50,  title: "Action",
                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                var icon = $('<span>').text('Add to My Shoots');
                                var btn = $("<button>").addClass('btn btn-sm btn-success').append(icon)
                                                .click(function(e) {
                                                    bootbox.confirm({
                                                        message: "This shoot will be added to your shoots list. Continue?",
                                                        buttons: {
                                                            confirm: {
                                                                label: 'Add to My Shoots',
                                                                className: 'btn-sm btn-success'
                                                            },
                                                            cancel: {
                                                                label: 'Cancel',
                                                                className: 'btn-sm btn-danger'
                                                            }
                                                        },
                                                        callback: function(result) {
                                                            if(result) {
                                                                var _data = {
                                                                    quotation_id    : item.id,
                                                                    account_id      : "{{$data['id']}}"
                                                                }
                                                                Controller.Update('/WebService/MarkAsMyShoot', _data).done(function() {
                                                                    $(grid_available_shoots).jsGrid("loadData");
                                                                    $(grid_my_shoots).jsGrid("loadData");
                                                                });
                                                            }
                                                        }
                                                    });
                                                });
                                return result.add(btn);
                            },
                        }
                    ]
            })
            
            $(grid_my_shoots).jsGrid({

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
                        Controller.Create('/WebService/ReadPhotographerQuotations', { 'id' : "{{$data['id']}}" }).done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/AssignQuotation', item).done(function(data) {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteQuotation', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields:
                    [
                        {   name: "created_at",     type: "datetime",   width: 50,  title: "Date"               },
                        {   name: "address",        type: "text",       width: 100, title: "Title / Address"    },
                        {   name: "status",         type: "text",       width: 45,  title: "Status",
                            itemTemplate: function(value, item) {
                                if(item.completed) return item.status.work_status + ' (DONE)';
                                else return item.status.work_status;
                            }
                        },
                        {   name: "action",         type: "text",       width: 50,  title: "Action",
                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var iconView = $('<span>').text('View');
                                var btnView = $("<a>").addClass('btn btn-sm btn-primary')
                                                .append(iconView)
                                                .attr('href', '/{{$accesstype}}/shoots/details?id=' + item.id)
                                                .attr('target', '_blank');
                                                
                                if(item.current_status == 2 && item.completed == 0) {

                                    var iconMark = $('<span>').text('Mark As DONE');
                                    var btnMark  = $("<button>").addClass('btn btn-sm btn-success')
                                                    .append(iconMark)
                                                    .click(function(e) {
                                                        Controller.Create('/WebService/MarkShootAsCompleteByHandler', {'id':item.id}).done(function() {
                                                            $(grid_my_shoots).jsGrid("loadData");
                                                        });
                                                    });
                                                   
                                    return result.add(btnView).add(btnMark);

                                }
                                else {
                                    
                                    var iconMark = $('<span>').text('DONE');
                                    var btnMark  = $("<button>").addClass('btn btn-sm btn-default disabled').append(iconMark);
                                                   
                                    return result.add(btnView).add(btnMark);
                                    
                                }

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