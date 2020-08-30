@extends('backend.shared._layout')

@section('css')
    
@endsection

@section('modal')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Account Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <form>
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Account ID</label>
                                    <input id="id" name="id" type="text" class="form-control form-control-alternative" disabled>
                                </div>
                            </div> --}}
                            <input id="id" name="id" type="text" class="form-control form-control-alternative" disabled hidden>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Role</label>
                                    <select id="role_id" class="form-control form-control-alternative"  placeholder="Role" name="role_id" @if(Session::get('app_role') == 'author') disabled @endif>
                                        <option class="text-dark" value="" disabled selected>Select</option>
                                        @foreach ($roles as $item)
                                            @if ($item['id'] >= $data['role_id'])
                                                <option class="text-dark" value="{{$item['id']}}">{{$item['display_name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Roles</label>
                                    <select id="roles" multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="form-control form-control-alternative selectpicker" data-live-search="true">
                                        @foreach ($roles as $item)
                                            <option value="{{$item['id']}}">{{$item['display_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input id="email" type="text" class="form-control form-control-alternative" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Phone</label>
                                    <input id="phone" type="text" class="form-control form-control-alternative" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Password <span style="font-weight: 100">(leave blank to remain unchanged)</span></label>
                                    <input id="password" name="password" type="password" class="form-control form-control-alternative">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger"  data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-success" data-dismiss="modal" onclick="Save()">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
      
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <p class="text-white display-2">Accounts</p>
        </div>
    </div>
      
    <div class="container-fluid mt--7 mb-7">
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

        setSideBar('#menu-accounts');

        var grid_table = "#grid-table";
        var modal = "#modal-default";
        var inEditMode;
        var roles = {!! json_encode($roles) !!};

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
                        Controller.Read('/WebService/ReadAccounts').done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        
                    },
                    updateItem: function(item) {
                        
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteAccount', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields: 
                    [
                        {   name: "id",         type: "disabled",   width: 40,  title: "ID",        visible: false  },
                        {   name: "name",       type: "text",       width: 80,  title: "Name",
                            itemTemplate: function(value, item) {
                                return item.firstname + ' ' + item.lastname;
                            }
                        },
                        {   name: "email",      type: "text",       width: 80,  title: "Email"                      },
                        // {   name: "role",       type: "text",       width: 80,  title: "Role",
                        //     itemTemplate: function(value, item) {
                        //         return item.role.display_name;
                        //     }
                        // },
                        {   name: "action",     type: "text",       width: 100, title: "Action",
                                                                    
                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var iconEdt = $('<span>').text('Edit');
                                var iconDel = $('<span>').text('Remove');

                                var btnEdt = $("<button>").addClass('btn btn-sm btn-info').append(iconEdt)
                                                .click(function(e) {                       
                                                    
                                                    $("#id").val(item.id);
                                                    // $("#role_id").val(item.role_id);
                                                    $("#firstname").val(item.firstname);
                                                    $("#lastname").val(item.lastname);
                                                    $("#email").val(item.email);
                                                    $("#phone").val(item.phone);
                                                    $("#password").val('');

                                                    var roles = [];
                                                    item.roles.forEach(element => {
                                                        roles.push(element.id);
                                                    });
                                                    $("#roles").selectpicker('val', roles);

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

            $(".selectpicker").selectpicker('deselectAll');
            $(".selectpicker").selectpicker('val', []);

            $("#firstname").val('');
            $("#lastname").val('');
            $("#email").val('');
            $("#phone").val('');
            $("#password").val('');

            $(modal).modal({ 
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        });

       function Save() {
            
            var data = {
                id:         $('#id').val(),
                firstname:  $('#firstname').val(),
                lastname:   $('#lastname').val(),
                email:      $('#email').val(),
                phone:      $('#phone').val(),
                password:   $('#password').val(),
                roles:      $('#roles').val().map(i=>parseInt(i))
            };

            Controller.Create('/WebService/UpsertAccount', data).done(function(result) {
                console.log(result);
                $(grid_table).jsGrid("loadData");                            
            });

        };

    </script>
	
@endsection