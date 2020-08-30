@extends('backend.shared._layout')

@section('css')
    <style>
        .fit-image-container {
            border-radius: 20px;
            /* width: 150px;
            height: 150px; */
            position: relative;
            display: block;
            z-index: 10;
            margin: auto;
            overflow: hidden;
        }
        .fit-image {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
            background-color: #ced4da6b;
        }
    </style>
@endsection

@section('modal')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Service Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{ url('/WebService/SaveService') }}" enctype="multipart/form-data">
                    <div class="modal-body card-body">
                        {{ csrf_field() }}
                        <input id="id" name="id" type="text" class="form-control form-control-alternative" hidden>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Title</label>
                                    <input id="title" name="title" type="text" class="form-control form-control-alternative">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Description 01</label>
                                    <textarea rows="10" id="description_01" name="description_01" type="text" class="form-control form-control-alternative"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Description 02</label>
                                    <textarea rows="10" id="description_02" name="description_02" type="text" class="form-control form-control-alternative"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Thumbnail</label>
                                    <input name="thumbnail" type="file" class="form-control form-control-alternative">
                                    <img id="thumbnail" src="{{url('img/logo-black.png')}}" alt="..." class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Hover Icon</label>
                                    <input name="hover_icon" type="file" class="form-control form-control-alternative">
                                    <img id="hover_icon" src="{{url('img/logo-black.png')}}" alt="..." class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Images / Gallery</label>
                                    <input name="photos[]" type="file" multiple class="form-control form-control-alternative">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-danger"  data-dismiss="modal">Cancel</button>
                        <button class="btn btn-sm btn-success" type="submit">Save Content</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <script>

    </script>

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <p class="text-white display-2">Services</p>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row mb-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <button class="btn btn-sm btn-success my-2" onclick="Create()">Create</button>
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

        setSideBar('#menu-services');

        var grid_table = "#grid-table";
        var modal = "#modal-default";

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
                        Controller.Read('/WebService/ReadServices').done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/CreateService', item).done(function(data) {
                            // CreateAlert(data);
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpdateService', item).done(function(data) {
                            // CreateAlert(data);
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteService', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields:
                    [

                        {   name: "id",             type: "disabled",   width: 40,  title: "ID",                visible: false  },
                        {   name: "title",          type: "text",       width: 80,  title: "Title"                              },
                        {   name: "description_01", type: "text",       width: 80,  title: "Description 01",    visible: false  },
                        {   name: "description_02", type: "text",       width: 100, title: "Description 02",    visible: false  },
                        {   name: "thumbnail",      type: "image",      width: 50,  title: "Thumbnail",                         },
                        {   name: "hover_icon",     type: "image",      width: 50,  title: "Hover Icon",        visible: false  },
                        {   name: "action",         type: "text",       width: 80,  title: "Action",

                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);

                                var iconEdt = $('<span>').text('Edit');
                                var iconDel = $('<span>').text('Remove');

                                var btnEdt = $("<button>").addClass('btn btn-sm btn-info').append(iconEdt)
                                                .click(function(e) {

                                                    $("#id").val(item.id);
                                                    $("#title").val(item.title);
                                                    $("#description_01").val(item.description_01);
                                                    $("#description_02").val(item.description_02);
                                                    document.getElementById('thumbnail').src = phly_url + '/storage/' + item.thumbnail;
                                                    document.getElementById('hover_icon').src = phly_url + '/storage/' + item.hover_icon;

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

        function ImageField(config) {
            jsGrid.Field.call(this, config);
        }

        ImageField.prototype = new jsGrid.Field({
            itemTemplate: function(value) {
                if(value == '' || value == null) return 'No Image';
                var div = document.createElement('div');
                div.setAttribute('class', 'fit-image-container');

                if(value.split('.').pop() == 'mp4') {
                    var img = document.createElement('video');
                    img.setAttribute('controls','');
                    img.setAttribute('src', phly_url + '/storage/' + value);
                    img.setAttribute('class', 'img-fluid fit-image');
                    div.appendChild(img);
                }
                else {
                    var img = document.createElement('img');
                    img.setAttribute('src', phly_url + '/storage/' + value);
                    img.setAttribute('class', 'img-fluid fit-image');
                    div.appendChild(img);
                }

                // var img = document.createElement('img');
                return div;
            }
        });

        jsGrid.fields.image = jsGrid.ImageField = ImageField;

        function Create() {

            $("#id").val('-1');
            $("#title").val('');
            $("#description_01").val('');
            $("#description_02").val('');
            $("#thumbnail").val('');
            $("#hover_icon").val('');

            $(modal).modal({
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        };

        function SaveContent() {

            var data = {
                id:             $('#id').val(),
                title:          $('#title').val(),
                description_01: $('#description_01').val(),
                description_02: $('#description_02').val(),
                thumbnail:      $('#thumbnail').val(),
                hover_icon:     $('#hover_icon').val()
            };

            if(data.id > 0) {
                $(grid_table).jsGrid("updateItem", data).done(function() {
                    console.log(data);
                    $(grid_table).jsGrid("loadData");
                });
            }
            else {
                $(grid_table).jsGrid("insertItem", data).done(function() {
                    $(grid_table).jsGrid("loadData");
                });
            }

        };

    </script>

@endsection
