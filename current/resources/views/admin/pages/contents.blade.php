@extends('backend.shared._layout')

@section('css')
    <style>
        .fit-image-container {
            border-radius: 20px;
            overflow: hidden;
            width: 150px;
            height: 150px;
            position: relative;
            display: block;
            z-index: 10;
            margin: auto;
        }
        .fit-image {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
        }
        .fit-details {
            border-radius: 20px;
            width: 150px;
            /* height: 150px; */
            position: relative;
            display: block;
            z-index: 10;
            margin: auto;
        }
        .grid-square {
            width: 200px;
            height: 230px;
            display: inline-block;
            background-color: #fff;
            border: solid 1px rgb(0,0,0,0.1);
            padding: 10px;
            margin: 10px;
        }
        .selected {
            background-color: #ddd;
        }
        .handle {
            cursor: grab;
        }
        /* .modal, .modal-dialog {
            margin: 1rem;
            max-width: 100% !important;
            max-height: 100% !important;
        } */
    </style>
@endsection

@section('modal')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <form method="post" action="{{ url('/WebService/UpsertContent') }}" enctype="multipart/form-data">
                    <div class="modal-header card-header bg-white border-0">
                        <h4 class="card-title">Content Information</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body card-body">
                            <input id="id" name="id" type="text" class="form-control form-control-alternative" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Element</label>
                                        <input id="element" name="element" type="text" class="form-control form-control-alternative">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Display Name</label>
                                        <input id="display_name" name="display_name" type="text" class="form-control form-control-alternative">
                                    </div>
                                </div> --}}
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Details</label>
                                        <input id="details" name="details" type="text" class="form-control form-control-alternative">
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Type</label>
                                        <input id="type" name="type" type="text" class="form-control form-control-alternative">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Value</label>
                                        <textarea rows="10" id="value" name="value" type="text" class="form-control form-control-alternative"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Cover Photo</label>
                                        <input id="cover" name="cover" type="file" class="form-control form-control-alternative">
                                        {{-- <img src="{{url('img/logo-black.png')}}" class="img-thumbnail"> --}}
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
    <div class="modal fade" id="modal-uploader">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Uploader</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="LoadTables()">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <div class="col-md-12">
                        <p class="text-muted">Drop images here or click to upload.</p>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="{{ url('/WebService/FileUpload') }}"
                                            enctype="multipart/form-data" class="dropzone" id="image-dropzone">
                                            {{ csrf_field() }}
                                            <div class="dz-message">
                                                <div class="col-xs-8"></div>
                                            </div>
                                            {{-- <input id="owner" hidden name="owner" value="{{$owner}}">
                                            <input id="ownerid" hidden name="ownerid" value="{{$id}}">
                                            <input id="cover" hidden name="cover" value="1">
                                            <input id="mobile" hidden name="mobile" value="0">
                                            <input id="thumbnail" hidden name="thumbnail" value="0">
                                            <input id="gallery" hidden name="gallery" value="0"> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-success" data-dismiss="modal" onclick="LoadTables()">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
  
<script>

</script>
    
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <p class="text-white display-2">Page Contents</p>
        </div>
    </div>
        
    <div class="container-fluid mt--7">

        <div class="row mb-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="heading mb-0">Contents</h3>
                        <button class="btn btn-sm btn-success my-2" onclick="CreateContent()">Create Content</button>
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
        Dropzone.autoDiscover = false;
        var imageDropzone = new Dropzone("#image-dropzone", {
            uploadMultiple: true,
            parallelUploads: 1,
            maxFilesize: 3,
            addRemoveLinks: true,
            dictRemoveFile: 'Remove file',
            dictFileTooBig: 'Image is larger than 3MB',
            timeout: 10000,
            acceptedFiles: ".jpeg,.jpg,.png,.JPEG,.JPG,.PNG",
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time + '_' + file.name.replace(/\s+/g, '-').toLowerCase();
            }
        });

        imageDropzone.on("success", function(file, result) {
            console.log(result);
        });

    </script>

    <script type="text/javascript">

        setSideBar('#menu-contents');

        var grid_table = "#grid-table";
        var modal = "#modal-default";
        var modal_uploader = "#modal-uploader";

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
                        Controller.Read('/WebService/ReadContents').done(function(data) {
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertContent', item).done(function(data) {
                            // CreateAlert(data);
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertContent', item).done(function(data) {
                            // CreateAlert(data);
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteContent', item).done(function(data) {

                        });
                    }
                },

                // data fields
                fields: 
                    [

                        {   name: "id",             type: "disabled",   width: 40,  title: "ID",            visible: false  },
                        {   name: "element",        type: "text",       width: 80,  title: "Element"                        },
                        {   name: "display_name",   type: "text",       width: 80,  title: "Display Name",  visible: false  },
                        {   name: "value",          type: "text",       width: 100, title: "Value"                          },
                        {   name: "details",        type: "text",       width: 100, title: "Details",       visible: false  },
                        {   name: "type",           type: "text",       width: 40,  title: "Type"                           },
                        {   name: "action",         type: "text",       width: 50,  title: "Action",

                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);

                                var iconEdt = $('<span>').text('Edit');
                                var iconDel = $('<span>').text('Remove');

                                var btnEdt = $("<button>").addClass('btn btn-sm btn-info').append(iconEdt)
                                                .click(function(e) {                       

                                                    $("#id").val(item.id);
                                                    $("#element").val(item.element);
                                                    // $("#display_name").val(item.display_name);
                                                    $("#value").val(item.value);
                                                    // $("#details").val(item.details);
                                                    // $("#type").val(item.type);

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
                
                var div = document.createElement('div');
                div.setAttribute('class', 'fit-image-container');
                var img = document.createElement('img');
                img.setAttribute('src', phly_url + value);
                img.setAttribute('class', 'img-fluid fit-image');
                div.appendChild(img);
                return div;

            }
        });

        jsGrid.fields.image = jsGrid.ImageField = ImageField;

        function CreateContent() {   
            
            $("#id").val('-1');
            $("#element").val('');
            // $("#display_name").val('');
            $("#value").val('');
            $("#cover").val('');
            // $("#details").val('');
            // $("#type").val('');

            $(modal).modal({ 
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        };

        function SaveContent() {

            var data = {
                id:             $('#id').val(),
                element:        $('#element').val(),
                // display_name:   $('#display_name').val(),
                value:          $('#value').val(),
                cover:          $('#cover').val()
                // details:        $('#details').val(),
                // type:           $('#type').val()
            };

            console.log(data);

            // if(data.id > 0) {
                $(grid_table).jsGrid("updateItem", data).done(function() {
                    $(grid_table).jsGrid("loadData");
                });
            // }
            // else {
            //     $(grid_table).jsGrid("insertItem", data).done(function() {
            //         $(grid_table).jsGrid("loadData");
            //     });
            // }

        };

    </script>    

@endsection