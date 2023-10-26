<div class="pro-dashboard-content gray-bg">
    <!-- <div class="container"> -->
        <div class="manage-docs pad30">
            <div class="manage-doc-content">
                <div class="manage-doc-section">
                    <div class="manage-doc-section-content">
                     <form action="{{ url('/admin/provider/vehicle/admin_vehicle_doc') }}" id="admin_provider_doc" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="{{$provider_id}}" name="provider_id">
                        <input type="hidden" value="{{$id}}" name="vehicle_id">
                        <input type="hidden" value="" name="img_array[]" id="errArray">
                        {{ csrf_field() }}

                        <div class="manage-doc-box row no-margin border-top mt-1" style="font-weight: bolder; font-size: initial;">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                Document Name
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                Upload File
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                Expiry Date
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                Preview
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="text-align: center">
                                Status
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                Actions
                            </div>
                        </div>

                        @foreach($VehicleDocuments as $key => $Document)
                        <div class="manage-doc-box row no-margin border-top mt-1">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="manage-doc-box-left form-group">
                                    <p class="manage-txt mt-0 mb-0" style="padding-top: 5px">{{ $Document->name }}</p>
                                </div>
                            </div>





                            <!-- Image -->
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-1">
                                <input type="file" name="document[{{$Document->id}}]" accept="application/pdf, image/*" style="width: -webkit-fill-available !important" id="document{{$Document->id}}" data-id="{{$Document->id}}" class="fileType">
                                <span class="errors" id="error_document{{$Document->id}}" style="color: red"></span>
                            </div>


                            <!-- Expiry -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mt-1">
                             <?php $date = '<input class="form-control expiry" id="expiry'.$Document->id.'" data-id="'.$Document->id.'" type="date" value="" name="expiry['.$Document->id.']">'; ?>
                                @foreach($getDocs as $image)
                                    @if($image->document_id == $Document->id)
                                        <?php $date = '<input class="form-control" type="date" value="'.$image->expiry.'" name="expiry['.$Document->id.']">'; ?>
                                    @endif
                                @endforeach
                                <span><?php echo $date; ?></span>
                                <span class="errors" id="error_expiry{{$Document->id}}" style="color: red"></span>
                            </div>






                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                @foreach($getDocs as $image)
                                    @if($image->document_id == $Document->id)
                                        <img src="{{ storageImg($image->url) }}" width="50px" height="50px">
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-1" style="text-align: center">
                                @php $sts = 'PENDING'; @endphp
                                @foreach($getDocs as $image)
                                    @if($image->document_id == $Document->id)
                                        @if($image->status == 'ASSESSING')
                                            @php $sts = 'PROCESSING'; @endphp
                                        @else
                                            @php $sts = $image->status; @endphp
                                        @endif
                                    @endif
                                @endforeach
                                <span>{{$sts}}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-1">
                                @foreach($getDocs as $image)
                                    @if($image->document_id == $Document->id)
                                        <div class="input-group-btn">
                                            @if( Setting::get('demo_mode') == 0)
                                            @if($image->status == "PROCESSING")
                                                <a href="{{ route('admin.provider.vehicle.document.update_status', [$provider_id,$id, $Document->id,'ACTIVE']) }}" onclick="return confirm('Are you sure?')" style="margin-right: 5px;"><span class="btn btn-success btn-sm">Approve</span></a>
                                                <a href="{{ route('admin.provider.vehicle.document.update_status', [$provider_id,$id, $Document->id,'REJECT']) }}" onclick="return confirm('Are you sure?')"><span class="btn btn-danger btn-sm">Reject</span></a>
                                            @elseif($image->status == "ACTIVE")
                                                <a href="{{ route('admin.provider.vehicle.document.update_status', [$provider_id,$id, $Document->id,'REJECT']) }}" onclick="return confirm('Are you sure?')"><span class="btn btn-danger btn-sm">Reject</span></a>
                                            @elseif($image->status == "REJECT")
                                                <a href="{{ route('admin.provider.vehicle.document.update_status', [$provider_id,$id, $Document->id,'ACTIVE']) }}" onclick="return confirm('Are you sure?')"><span class="btn btn-success btn-sm">Approve</span></a>
                                            @endif
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        <div class="form-actions pull-right mt-3">
                          <input type="submit" value="Save Vehicle Documents" id="vehicle_docs" class="btn btn-success">
                        </div> 
                     </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
</div>
