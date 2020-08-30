@extends('backend.shared._layout')

@section('css')
    <style>
        h1, h2, h3, h4, h5, h6 {
            font-weight: 400;
        }
    </style>
@endsection

@section('modal')
    <div class="modal fade" id="modal-uploader">
        <div class="modal-dialog modal-lg">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Uploader</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="Reload()">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <p class="text-muted">Drop or Click to upload.</p>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ url('/WebService/UploadContent') }}"
                                enctype="multipart/form-data" class="dropzone" id="image-dropzone">
                                {{ csrf_field() }}
                                <div class="dz-message">
                                    <div class="col-xs-8"></div>
                                </div>
                                <input id="owner_id"    name="owner_id" value="-1"          hidden>
                                <input id="owner"       name="owner"    value="breakdowns"  hidden>
                                <input id="element"     name="element"  value="none"        hidden>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-success" data-dismiss="modal" onclick="Reload()">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
      
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <p class="text-white display-2">Shoot Details</p>
        </div>
    </div>
      
    <div id="main-container" class="container-fluid mt--7 mb-5">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="font-weight: 800;">General Details</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="float-right">Date Created: {{ date_format(date_create($quotation['created_at']),"F d, Y") }}</h4>
                                                        <br>
                                                        <h2 style="font-weight: 800;">{{$customer['firstname'].' '.$customer['lastname']}}</h2>
                                                        <h4><strong>Service Address: </strong></h4>
                                                        <h4>
                                                            {{$quotation['address']}}
                                                            @foreach ($zipcodes as $item)
                                                                @if ($item['id'] == $quotation['zipcode_id'])                                        
                                                                    {{$item['zipcode']}}
                                                                @endif                                            
                                                            @endforeach
                                                        </h4>
                                                        <br>
                                                        <h4><strong>Email: </strong>{{$customer['email']}}</h4>
                                                        <h4><strong>Phone: </strong>{{$customer['phone']}}</h4>
                                                        <br>
                                                        <h4 id="start_date"><strong>Start Date: </strong>{{date_format(date_create($quotation['start_date']),"F d, Y")}}</h4>
                                                        {{-- <h4 id="end_date"><strong>End Date: </strong>{{date_format(date_create($quotation['start_date']),"F d, Y")}}</h4> --}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="grid-table"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="container">     
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2 id="totalamount" style="font-weight: 800;"></h2>
                                                    </div>
                                                </div>    
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <h3>Notes:</h3>
                                                        <h3>{{$quotation['notes']}}</h3>
                                                    </div>
                                                </div>
                                                <div class="row my-7">
                                                    <div class="col-md-6">
                                                        <a href="/" style="font-weight: 800;" class="text-muted">MFJ 360 PRO</a>
                                                        <h5 class="text-muted">Our mission at MFJ 360 Pro, is to bring your space alive.</h5>
                                                        <h5 class="text-muted">phone: (831)200-2484<br>email: info@mfj360pro.com</h5>
                                                        <h5 class="text-muted copyright-text">© 2020 Copyright MFJ360PRO. All Rights Reserved.</h5>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="/"><img src="{{ asset('img/logo-black.png') }}" class="float-right" height="150" style="opacity: 0.6;"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($quotation['status']['flow'] == 5)
    <div id="main-container" class="container-fluid mb-5">
        @foreach ($contributors as $contributor)
            <div class="row mt-5">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 style="font-weight: 800;">Uploads From: {{$contributor['firstname'].' '.$contributor['lastname']}} (
                                            @foreach ($contributor['roles'] as $role)
                                                {{$role['display_name']}}
                                            @endforeach
                                            )
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-secondary">
                            <div class="container">   
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <h3>Photos</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            @foreach ($uploads['uploads'] as $upload)
                                                                @if ($upload['element'] == 'image' && $upload['uploaded_by'] == $contributor['id'])
                                                                    <div id="image-{{$upload['id']}}" class="col-md-3 p-2 text-right">
                                                                        <img src="/storage/{{$upload['value']}}" alt="" class="img-thumbnail my-2">
                                                                        <a class="btn btn-sm pb-0 m-0 btn-info text-white" href="/storage/{{$upload['value']}}" download=""><i class="ni ni-cloud-download-95"></i></a>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="card-footer"></div> --}}
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <h3>Matterport Links</h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($uploads['uploads'] as $upload)
                                                    @if ($upload['element'] == 'links' && $upload['uploaded_by'] == $contributor['id'])
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Link</label>
                                                                    <input value="{{json_decode($upload['value'])[0]}}" type="text" class="form-control form-control-alternative">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">iFrame (embed link)</label>
                                                                    <textarea rows="6" type="text" class="form-control form-control-alternative">{{json_decode($upload['value'])[1]}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            {{-- <div class="card-footer"></div> --}}
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <h3>Video</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            @foreach ($uploads['uploads'] as $upload)
                                                                @if ($upload['element'] == 'video' && $upload['uploaded_by'] == $contributor['id'])
                                                                    <div id="view-{{$upload['id']}}" class="col-md-3 p-2 text-right">
                                                                        <video src="/storage/{{$upload['value']}}" controls loop class="img-thumbnail my-2"></video>
                                                                        <a class="btn btn-sm pb-0 m-0 btn-info text-white" href="/storage/{{$upload['value']}}" download=""><i class="ni ni-cloud-download-95"></i></a>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="card-footer"></div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
    
@endsection

@section('script')

    <script type="text/javascript">

        var modal_uploader = "#modal-uploader";

        Dropzone.autoDiscover = false;
        var imageDropzone = new Dropzone("#image-dropzone", {
            uploadMultiple: true,
            parallelUploads: 1,
            maxFilesize: 50,
            addRemoveLinks: true,
            dictRemoveFile: 'Remove file',
            dictFileTooBig: 'Image is larger than 50MB',
            timeout: 10000,
            acceptedFiles: ".jpeg,.jpg,.png,.JPEG,.JPG,.PNG,.mp4,.mov,.MP4,.MOV",
            // renameFile: function(file) {
            //     var dt = new Date();
            //     var time = dt.getTime();
            //    return time + '_' + file.name.replace(/\s+/g, '-').toLowerCase();
            // }
        });

        imageDropzone.on("success", function(file, result) {
            console.log(result);
        });

        function Reload() {
            location.reload();
        }

        function Download(file) {
            console.log(file);
        }

        function DownloadAll(files) {
            console.log(files);
        }

        function Remove(id) {
            Controller.Delete('/WebService/DeleteUploadedContent', {'id':id}).done(function(){
                // Reload();
                var element = document.getElementById('image-'+id);
                element.parentNode.removeChild(element);
            });
        }

        function Save(el, id, type) {
            var data = {
                'owner_id'      : id,
                'owner'         : 'breakdowns',
                'value'         : [$('#link-'+id).val(), $('#iframe-'+id).val()],
                'element'       : type 
            }
            console.log(el);
            el.textContent = "Saving...";
            Controller.Update('/WebService/UpsertUploadedContent', data).done(function() {
                // Reload();
                // setTimeout(function() {
                    el.textContent = "Save";
                // }, 3000);
            });
        }

        function Upload(owner_id, element) {

            console.log(owner_id, element);

            $('#owner_id').val(owner_id);
            $('#element').val(element);

            imageDropzone.removeAllFiles();

            $(modal_uploader).modal({ 
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        }

    </script>

    <script type="text/javascript">

        setSideBar('#menu-shoots');

        var grid_table = "#grid-table";

        $(function() {

            $(grid_table).jsGrid({

                // table config
                width: "100%",
                height: "auto",
                autoload: true,
                updateOnResize: true,

                paging: true,
                pageIndex: 1,
                pageSize: 100,
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
                        Controller.ReadWithParameter('/WebService/ReadBreakdown', { 'id' : '{{$quotation['id']}}' }).done(function(data) {
                            var amount = 0;
                            data.forEach(element => {
                                amount += element.total;
                                console.log(amount);
                            });
                            $('#totalamount').text('Total Amount: $' + Math.round(amount));
                            d.resolve(data);
                        });
                        return d.promise();
                    },
                    insertItem: function(item) {
                        Controller.Create('/WebService/UpsertBreakdown', item).done(function(data) {
                            
                        });
                    },
                    updateItem: function(item) {
                        Controller.Update('/WebService/UpsertBreakdown', item).done(function(data) {
                            
                        });
                    },
                    deleteItem: function(item) {
                        Controller.Delete('/WebService/DeleteBreakdown', item).done(function(data) {

                        });
                    }
                },
                // data fields
                fields:
                    [
                        {   name: "id",         type: "disabled",   width: 40,  title: "ID",        visible: false  },
                        {   name: "service",    type: "text",       width: 100, title: "Service"                    },
                        {   name: "package",    type: "text",       width: 100, title: "Price Package"              },
                        {   name: "quantity",   type: "number",     width: 50,  title: "Quantity"                   },
                        {   name: "total",      type: "number",     width: 60,  title: "Amount"                     }
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

    </script>
	
@endsection