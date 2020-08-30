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
                <div class="modal-body card-body">
                    <form>
                        <input id="id" name="id" type="text" class="form-control form-control-alternative" disabled hidden>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Promo Code</label>
                                    <input id="code" name="code" type="text" class="form-control form-control-alternative">
                                </div>
                            </div>
                        </div>
                        <span id="code-error" class="d-none" style="font-weight: 300;"></span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger"  data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-success" id="btnAdd">Add</button>
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
                        <a href="/portal/get-a-quote" class="btn btn-sm btn-success">Add New</a>
                        @if (count($promos) > 0)
                            @foreach ($promos as $promo)
                                @if (($promo['daysvalid'] - (new DateTime())->diff(new DateTime($promo['created_at']))->days) > 0)
                                    <button disabled class="btn btn-sm btn-default" id="btnEnterCode">{{$promo['code'].' ('.($promo['daysvalid'] - (new DateTime())->diff(new DateTime($promo['created_at']))->days).' days left)' }}</button>
                                @else
                                    <button class="btn btn-sm btn-success" id="btnEnterCode">Enter Promo Code</button>
                                @endif
                            @endforeach
                        @else
                            <button class="btn btn-sm btn-success" id="btnEnterCode">Enter Promo Code</button>
                        @endif
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
                        Controller.Create('/WebService/ReadCustomerQuotations', { 'id' : "{{$data['id']}}" }).done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertQuotation', item).done(function(data) {
                            
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertQuotation', item).done(function(data) {
                            
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
                        {   name: "created_at",     type: "datetime",   width: 50,  title: "Date"       },
                        {   name: "address",        type: "text",       width: 100, title: "Title"      },
                        {   name: "status",         type: "text",       width: 45,  title: "Status",
                            itemTemplate: function(value, item) {
                                return item.status.client_status;
                            }
                        },
                        // {   name: "handler",         type: "text",      width: 45,  title: "Assigned To",
                        //     itemTemplate: function(value, item) {
                        //         return (item.handler == null) ? '--' : item.handler.firstname + ' ' + item.handler.lastname;
                        //     }
                        // },
                        {   name: "action",         type: "text",       width: 30, title: "Action",
                                                                    
                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var iconVew = $('<span>').text('View');
                                var btnVew = $("<a>").addClass('btn btn-sm btn-primary')
                                            .append(iconVew)
                                            .attr('href', '/{{$accesstype}}/breakdown?id=' + item.id)
                                            .attr('target', '_blank');
                                            
                                return result.add(btnVew);
                                
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

        $(document).on("click", "#btnEnterCode", function(e) {   
            
            $("#id").val('-1');
            $("#code").val('');

            $(modal).modal({ 
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        });

        $(document).on("click", "#btnAdd", function(e) {
            
            var data = {
                id:         -1,
                code:       $('#code').val(),
                account_id: "{{$data['id']}}"
            };

            Controller.Create('/WebService/UpsertCustomerPromo', data).done(function(result) {
                if(result.code == 0) {
                    console.log(result.message);
                    $("#code-error").text(result.message);
                    $("#code-error").removeClass('d-none');
                    $("#code-error").removeClass('text-success');
                    $("#code-error").addClass('text-danger');
                    setTimeout(function() {                        
                        $("#code-error").addClass('d-none');
                    }, 3000);
                }
                else {
                    $("#code-error").text(result.message);
                    $("#code-error").removeClass('d-none');
                    $("#code-error").removeClass('text-danger');
                    $("#code-error").addClass('text-success');
                    setTimeout(function() {
                        // $(modal).modal('toggle');
                        $("#code-error").addClass('d-none');
                        window.location.reload();
                    }, 3000);
                }
            });

        });

    </script>

@endsection