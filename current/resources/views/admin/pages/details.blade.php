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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content card bg-secondary shadow">
                <div class="modal-header card-header bg-white border-0">
                    <h4 class="card-title">Service Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body card-body">
                    <input id="id" name="id" type="text" class="form-control form-control-alternative" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Service</label>
                                <select onchange="SetPricing()" id="service_id" name="service_id" class="form-control form-control-alternative"  placeholder="Role Code">
                                    <option class="text-dark" value="" disabled selected>Select</option>
                                    @foreach ($services as $item)
                                        <option class="text-dark" value="{{$item['id']}}">{{$item['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Pricing <span style="font-weight: 100;">varies per zipcode</span></label>
                                <select onchange="GetTotal()" id="pricing_id" name="pricing_id" class="form-control form-control-alternative">
                                    <option class="text-dark" value="" disabled selected>Select</option>                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Quantity</label>
                                <input oninput="GetTotal()" id="quantity" name="quantity" type="number" step="0.01" min="1" class="form-control form-control-alternative" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Amount</label>
                                <input id="total" name="total" type="number" class="form-control form-control-alternative" disabled style="font-weight: 800;">
                            </div>
                        </div>
                    </div>
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
            <p class="text-white display-2">Shoot Details</p>
        </div>
    </div>
      
    <div id="main-container" class="container-fluid mt--7">
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
                                <div class="col-md-12">
                                    <dl class="row">
                                        <dt class="col-sm-2 text-right"><p class="h5">Date Created:</p></dt>
                                        <dd class="col-sm-10">
                                            <p class="h5">{{ date_format(date_create($quotation['created_at']),"F d, Y h:i:s A") }}</p>
                                        </dd>
                                        <dt class="col-sm-2 text-right"><p class="h5">Customer Name:</p></dt>
                                        <dd class="col-sm-10">
                                            <p class="h5">{{$customer['firstname'].' '.$customer['lastname']}}</p>
                                        </dd>
                                        <dt class="col-sm-2 text-right"><p class="h5">Service Address:</p></dt>
                                        <dd class="col-sm-10">
                                            <p class="h5">{{$quotation['address'].' '.$quotation['zipcode']['zipcode']}}</p>
                                        </dd>
                                        <dt class="col-sm-2 text-right"><p class="h5">Email:</p></dt>
                                        <dd class="col-sm-10">
                                            <p class="h5">{{$customer['email']}}</p>
                                        </dd>
                                        <dt class="col-sm-2 text-right"><p class="h5">Phone:</p></dt>
                                        <dd class="col-sm-10">
                                            <p class="h5">{{$customer['phone']}}</p>
                                        </dd>
                                        <dt class="col-sm-2 text-right"><p class="h5">Start Date: </p></dt>
                                        <dd class="col-sm-10">
                                            <p class="h5">{{date_format(date_create($quotation['start_date']),"F d, Y h:i:s A")}}</p>
                                        </dd>
                                        {{-- <dt class="col-sm-2 text-right"><p class="h5">End Date: </p></dt>
                                        <dd class="col-sm-10">
                                            <p class="h5">{{date_format(date_create($quotation['end_date']),"F d, Y h:i:s A")}}</p>
                                        </dd> --}}
                                        <dt class="col-sm-2 text-right"><p class="h5">Customer's Notes:</p></dt>
                                        <dd class="col-sm-10">
                                            <p class="h5">{{$quotation['notes']}}</p>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-success float-bottom" id="btnAddNew">Add Service Item</button>
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label" style="font-weight: 800;">Total Amount</label>
                                <input id="totalamount" name="totalamount" type="number" min="0" value="0" class="form-control form-control-alternative" disabled style="font-weight: 800;">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="grid-table" class="table-responsive"></div>
                    </div>
                </div>
            </div>
        </div>       
        {{-- <div class="row mt-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">   
                        <button class="btn btn-sm btn-info float-bottom" id="btnPrint">PRINT QUOTATION</button>
                    </div>
                </div>
            </div>
        </div>       --}}
    </div>
    
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

        var quotation   = {!! json_encode($quotation) !!};
        var services    = {!! json_encode($services) !!};
        var pricings    = {!! json_encode($pricings) !!};
        var units       = {!! json_encode($units) !!}
        var zipcodes    = {!! json_encode($zipcodes) !!}

        $('#start_date').val(ConvertDate(quotation.start_date));
        // $('#end_date').val(ConvertDate(quotation.end_date));

        function ConvertDate(value) {
            return new Date(value).toLocaleDateString('en-US', {
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric'
                    });
        }
        
        function SetPricing() {
            var service_id = $('#service_id').val();
            var pricing_id = $('#pricing_id').val('');
            var quantity   = $('#quantity').val('');
            var total      = $('#total').val('');
            document.getElementById('pricing_id').innerHTML = '<option class="text-dark" value="" disabled selected>Select</option>';
            pricings.forEach(pricing => {
                if(pricing.service_id == service_id)
                    units.forEach(unit => {
                        if(pricing.unit_id == unit.id) {
                            zipcodes.forEach(zipcode => {
                                if(pricing.zipcode_id == zipcode.id) {
                                    var option = document.createElement('option');
                                    option.setAttribute('class', 'text-dark');
                                    option.setAttribute('value', pricing.id);
                                    option.text = '$'+ pricing.price + ' per ' + unit.name;
                                    document.getElementById('pricing_id').appendChild(option);
                                }
                            });
                        }
                    });
            });           
        }
        function GetTotal() {
            var pricing_id = $('#pricing_id').val();
            var quantity   = $('#quantity').val();
            if(quantity == null || pricing_id == null) return;
            pricings.forEach(pricing => {
                if(pricing.id == pricing_id)
                    $('#total').val(pricing.price * quantity);
            });
        }
        function SetTotalAmount() {
            $('#totalamount').val('0');
            Controller.ReadWithParameter('/WebService/ReadBreakdown', { 'id' : quotation.id }).done(function(data) {
                var amount = 0;
                data.forEach(element => {
                    amount += element.total;
                });
                $('#totalamount').val(Math.round(amount));
            });
        }
        SetTotalAmount();

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
                noDataContent: "No Services.",

                inserting: false,
                editing: false,
                deleting: false,
                sorting: true,

                confirmDeleting: false,

                // data controller
                controller: {
                    loadData: function() {
                        var d = $.Deferred();
                        Controller.ReadWithParameter('/WebService/ReadBreakdown', { 'id' : quotation.id }).done(function(data) {
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
                        {   name: "quantity",   type: "number",     width: 50,  title: "Qty"                        },
                        {   name: "total",      type: "number",     width: 60,  title: "Amount"                     },
                        {   name: "action",     type: "text",       width: 60,  title: "Action",
                            itemTemplate: function(value, item) {
                                var result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                                
                                var iconDel = $('<span>').text('Remove');

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
                                                                SetTotalAmount();
                                                            }
                                                        }
                                                    });
                                                });
                                
                                return result.add(btnDel);

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

        $(document).on("click", "#btnAddNew", function(e) {   
            
            $("#id").val('-1');
            $("#service_id").val('');
            $("#pricing_id").val('');
            $("#quantity").val('');

            $(modal).modal({ 
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true
            });

        });

        $(document).on("click", "#btnSave", function(e) {
            
            var data = {
                id:             $('#id').val(),
                quotation_id:   quotation.id,
                service_id:     $('#service_id').val(),
                pricing_id:     $('#pricing_id').val(),
                quantity:       $('#quantity').val()
            };

            $(grid_table).jsGrid("updateItem", data).done(function() {
                $(grid_table).jsGrid("loadData");
                SetTotalAmount();
            });

        });

    </script>
	
@endsection