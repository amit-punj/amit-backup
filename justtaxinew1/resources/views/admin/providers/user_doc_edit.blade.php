<div class="pro-dashboard-content gray-bg">
    <div class="container">
        <div class="manage-docs pad30">
            <div class="manage-doc-content">
                <div class="manage-doc-section pad50">
                    <div class="manage-doc-section-content">
                    <form action="{{ url('/admin/provider/admin_provider_doc') }}" id="admin_provider_doc" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="{{$id}}" name="provider_id">
                        {{ csrf_field() }}
                        @foreach($DriverDocuments as $key => $Document)
                        <div class="manage-doc-box row no-margin border-top mt-1">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="manage-doc-box-left form-group">
                                    <p class="manage-txt mt-0 mb-0" style="padding-top: 15px">{{ $Document->name }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                @foreach($getDocs as $image)
                                    @if($image->document_id == $Document->id)
                                        @if (pathinfo($image->url, PATHINFO_EXTENSION) == 'pdf')
                                            <img src="{{url('/main/pdf.png')}}" width="50px" height="50px">
                                        @else
                                            <img src="{{ img($image->url) }}" width="50px" height="50px">
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-1">
                                @foreach($getDocs as $image)
                                    @if($image->document_id == $Document->id)
                                        <span>{{$image->status}}</span>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 mt-1">
                                <input type="file" name="document[{{$Document->id}}]" accept="application/pdf, image/*" style="width: -webkit-fill-available !important">
                            </div>
                        </div>
                        @endforeach
                        <div class="form-actions pull-right mt-1">
                          <input type="submit" value="Save Driver Documents" id="vehicle_docs" class="btn btn-success">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>