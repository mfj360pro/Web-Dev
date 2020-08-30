@extends('backend.shared._layout')

@section('css')

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
            <p class="text-white display-2">Promos</p>
        </div>
    </div>
      
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <button class="btn btn-sm btn-success" id="btnEnterCode">Enter Promo Code</button>
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

        setSideBar('#menu-promos');

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
                        Controller.Create('/WebService/ReadCustomerPromos', { 'id' : "{{$data['id']}}" }).done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertCustomerPromo', item).done(function(data) {
                            
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertCustomerPromo', item).done(function(data) {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteCustomerPromo', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields: 
                    [
                        {   name: "name",       type: "text",       width: 100, title: "Name"               },
                        {   name: "code",       type: "text",       width: 50,  title: "Promo Code"         },
                        {   name: "discount",   type: "text",       width: 40,  title: "Discount"           },
                        {   name: "daysvalid",  type: "text",       width: 40,  title: "No. of Days left",
                            itemTemplate: function(value, item) {
                                // if(item.promo!=null) {
                                var daysleft = item.daysvalid - ((new Date().getTime() - new Date(item.created_at).getTime())  / (1000 * 3600 * 24)).toFixed(0);
                                if(daysleft > 0) return daysleft + ' Days';
                                else return 'Expired.';
                                // }
                                // else return '';
                            }
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
                    $(grid_table).jsGrid("loadData");
                    $("#code-error").text(result.message);
                    $("#code-error").removeClass('d-none');
                    $("#code-error").removeClass('text-danger');
                    $("#code-error").addClass('text-success');
                    setTimeout(function() {
                        $("#code-error").addClass('d-none');
                    }, 3000);
                }
            });

        });

    </script>
	
@endsection