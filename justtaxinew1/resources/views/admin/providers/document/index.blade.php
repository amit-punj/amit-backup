@extends('admin.layout.base')

@section('title', 'Provider Documents ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
          @if(Setting::get('demo_mode') == 1)
                <div class="col-md-12" style="height:50px;color:red;">
                    <h1>** Demo Mode : No Permission to Edit and Delete.</h1>
                </div>
             @endif
            <h5 class="mb-1">@lang('admin.provides.type_allocation')</h5>
            <div class="row">
                <div class="col-xs-12">
                    @if($ProviderService->count() > 0)
                    <hr><h4>Vehicle List :  </h4>
                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>@lang('admin.provides.vehicle_type')</th>
                                <th>@lang('admin.provides.registration_number')</th>
                                <th>@lang('admin.provides.vehicle_model')</th>
                                <th>@lang('admin.provides.chassis')</th>
                                <th>Prime Vehicle</th>
                                <th>@lang('admin.provides.status')</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ProviderService as $service)
                            <tr>
                                <td>
                                    <input type="hidden" id="ser_service_type_{{$service->id}}" value="{{$service->service_type_id}}">
                                    {{ $service->service_type->name }}
                                </td>
                                <td id="ser_service_number_{{$service->id}}">{{ $service->service_number }}</td>
                                <td id="ser_service_model_{{$service->id}}">{{ $service->service_model }}</td>
                                <td id="ser_chassis_number_{{$service->id}}">{{ $service->chassis_number }}</td>
                                <td> 
                                    <label class="switch">
                                        <input {{ ($service->active_status == 1 && count_DriverDocuments() <= $Provider->active_documents() ) ? "" : "disabled"  }} type="checkbox" {{ ($service->prime == 1) ? "checked" : ''  }} data-id="{{$service->id}}" class="change" id="togBtn">
                                        <div class="slider round"></div>
                                    </label>
                                </td>
                                <td>{{ $service->status }}</td>
                                <td>
                                    @if( Setting::get('demo_mode') == 0)
                                        @if($service->prime == 0)
                                        <form action="{{ route('admin.provider.document.service', [$Provider->id, $service->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                         <button class="btn btn-info btn-sm edit" data-id= "{{$service->id}}">Edit</button>
                                         <button class="btn btn-success btn-sm" onclick="docModal('{{$Provider->id}}','{{$service->id}}')">Document</button>
                                        @endif
                                     @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>@lang('admin.provides.vehicle_type')</th>
                                <th>@lang('admin.provides.registration_number')</th>
                                <th>@lang('admin.provides.vehicle_model')</th>
                                <th>@lang('admin.provides.chassis')</th>
                                <th>Prime Vehicle</th>
                                <th>@lang('admin.provides.status')</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                    <hr>
                </div>
                <form action="{{ route('admin.provider.document.store', $Provider->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="service_id" id="service_id" value="">
                    <div class="col-xs-2">
                        <select class="form-control input" id="service_type" name="service_type" required>
                            @forelse($ServiceTypes as $Type)
                            <option value="{{ $Type->id }}">{{ $Type->name }}</option>
                            @empty
                            <option>- Please Create a Vehicle Type -</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" required id="service_number" name="service_number" class="form-control" value="{{old('service_number')}}" placeholder="Number (CY 98769)">
                    </div>
                    <div class="col-xs-3">
                        <input type="text" required id="service_model" name="service_model" class="form-control" value="{{old('service_model')}}" placeholder="Model (Audi R8 - Black)">
                    </div>
                    <div class="col-xs-3">
                        <input type="text" required id="chassis_number" name="chassis_number" class="form-control"  value="{{old('chassis_number')}}" placeholder="Chassis Number (QW877987F768C8779)">
                    </div>
                    @if( Setting::get('demo_mode') == 0)
                    <div class="col-xs-2">
                        <button class="btn btn-primary btn-block" id="submit" type="submit">Add</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="box box-block bg-white">
            <h5 class="mb-1">@lang('admin.provides.provider_documents')</h5>
            <form action="{{ url('/admin/provider/admin_provider_doc') }}" id="admin_provider_doc" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="{{$Provider->id}}" name="provider_id">
                    {{ csrf_field() }}
                <table class="table table-striped table-bordered dataTable" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('admin.provides.document_type')</th>
                            <th>Upload Document</th>
                            <th>Expiry Date</th>
                            <th>View</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="file" name="abc" id="abc" accept="application/pdf, image/*" style="width: -webkit-fill-available !important"></td>
                            <td><input class="form-control" type="date" value="" name="xyz" id="xyz"></td>
                        </tr>
                        @foreach($DriverDocuments as $key => $Document)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $Document->name }}</td>
                            <td>
                                <input type="file" name="document[{{$Document->id}}]" id="document" accept="application/pdf, image/*" style="width: -webkit-fill-available !important">
                            </td>
                            <td>
                                <?php $date = '<input class="form-control" type="date" value="" name="expiry['.$Document->id.']">'; ?>
                                @foreach($Provider->documents as $image)
                                    @if($image->document_id == $Document->id)
                                        <?php $date = '<input class="form-control" type="date" value="'.$image->expiry.'" name="expiry['.$Document->id.']">'; ?>
                                    @endif
                                @endforeach
                                <span><?php echo $date; ?></span>
                            </td>
                            <td>
                                @foreach($Provider->documents as $image)
                                    @if($image->document_id == $Document->id)
                                        @if (pathinfo($image->url, PATHINFO_EXTENSION) == 'pdf')
                                            <img src="{{url('/main/pdf.png')}}" width="50px" height="50px">
                                        @else
                                            <img src="{{ storageImg($image->url) }}" width="50px" height="50px">
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @php $sts = 'PENDING'; @endphp
                                @foreach($Provider->documents as $image)
                                    @if($image->document_id == $Document->id)
                                        @if($image->status == 'ASSESSING')
                                            @php $sts = 'PROCESSING'; @endphp
                                        @else
                                            @php $sts = $image->status; @endphp
                                        @endif
                                    @endif
                                @endforeach
                                <span>{{$sts}}</span>
                            </td>
                            <td>
                                <div class="input-group-btn">
                                @if( Setting::get('demo_mode') == 0)
                                    @foreach($Provider->documents as $image)
                                    @if($image->document_id == $Document->id)
                                        <a href="{{ route('admin.provider.document.edit', [$Provider->id, $image->id]) }}"><span class="btn btn-success btn-large">View</span></a>
                                        <!-- <a href="{{ route('admin.provider.document.destroy', [$Provider->id, $image->id]) }}" onclick="return confirm('Are you sure?')"><span class="btn btn-danger btn-large">Delete</span></a> -->
                                    @endif
                                    @endforeach
                                @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th>#</th>
                            <th>@lang('admin.provides.document_type')</th>
                            <th>Upload Document</th>
                            <th>Expiry Date</th>
                            <th>View</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </tfoot> -->
                </table>
                <div class="form-actions pull-right mt-3">
                    <input type="submit" value="Save Driver Documents" id="vehicle_docs" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.Docs Modal -->
<div id="ModalAddDocs" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title col-sm-11">Vehicle Documents</h1>
                <button data-dismiss="modal" type="button" class="close col-sm-1 mt-1">x</button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.edit').click(function(){
            var ids = $(this).data('id');
            var service_type = $('#ser_service_type_'+ids+'').val();
            var service_number = $('#ser_service_number_'+ids+'').text();
            var service_model = $('#ser_service_model_'+ids+'').text();
            var chassis_number = $('#ser_chassis_number_'+ids+'').text();
            $("#service_id").val(ids);
            $("#service_type option[value='"+ service_type + "']").attr('selected', true);
            $("#service_number").val(service_number);
            $("#service_model").val(service_model);
            $("#chassis_number").val(chassis_number);
            $("#submit").text('Update');
        });
    });

    function docModal($provider_id,$id){
        var url = "{{url('/admin/provider/vehicle_document_update')}}"+"/"+$provider_id+"/"+$id;
        $('#ModalAddDocs .modal-body').load(url,function(result){
            $('#ModalAddDocs').modal({show:true});
        });
        // $('#admin_provider_doc').on('submit',function(e){
        //     e.preventDefault();
        //     alert('form submit');
        // })
    }
    
</script>
<script>
 $(".change").click(function() {
    var user_id = $(this).data('id');
      if($(this).prop("checked") == true){
          var value = 1;
      }
      else if($(this).prop("checked") == false){
          var value = 0;
      }

      $.ajax({
          type: "POST",
          url: '{{ route("admin.provider.vehicle.prime_status") }}',
          data: {
            '_token': '<?php echo csrf_token() ?>',
            'prime': value,
            'id': user_id
          },
          success: function(data){
            location.reload();
          }
      });
});
</script>
<script type="text/javascript">
    $("#admin_provider_doc").validate({
        rules: {
            "abc": {
                required: true
            },
            "xyz":{
                required: function(element){
                    if($("#abc").val() == ""){
                        return true;
                    }
                }
            }
        },
        messages: {
            "abc": {
                required: "Please, enter a name"
            },
             "xyz": {
                required: "Please, enter"
            },
        },
        submitHandler: function (form) { // for demo
            alert('valid form submitted'); // for demo
            alert($("#abc").val());
            return false; // for demo
        }
    });
</script>
@endsection