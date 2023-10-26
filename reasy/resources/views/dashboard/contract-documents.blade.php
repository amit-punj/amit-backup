<?php
$role = Auth::user()->user_role; 
$documentsPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'documents_permission');
?>
<div class="row">
    <div class="col-sm-12 top-nevigation">
        <ul class="nav nav-tabs" style="margin-left: -6px;">
            <li class="active"><a data-toggle="tab" href="#menu_description">Rental Agreement</a></li>
            <li><a data-toggle="tab" href="#menu_assign_unit">Place Description</a></li>
            <!-- <li><a data-toggle="tab" href="#menu_tenant">Legal Advisor</a></li> -->
            <li><a data-toggle="tab" href="#Water_meters">Meter Reading</a></li>
            <!-- <li><a data-toggle="tab" href="#Electricity_meters">Electricity Meter</a></li> -->
        </ul>
        <?php $documents = (isset($documents)) ? $documents : array() ; ?>
        <div class="tab-content">
            <div id="menu_description" class="tab-pane fade in active">
                @if(isset($contract->rent_agreement) && $contract->rent_agreement != '')
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <span>{{ $contract->rent_agreement}}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="documemt_action">
                                        @if(Auth::user()->user_role == 2)
                                            <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                        @elseif(Auth::user()->user_role == 3 && ($documentsPermission != 0) && ($documentsPermission != 1))
                                            <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                        @endif
                                            <a href="{{ url('images/agreements/'.$contract->rent_agreement) }}"><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p>No rental documents</p>
                @endif
            </div>
            <div id="menu_assign_unit" class="tab-pane fade">
                @if(count($documents) > 0)
                    <div class="row">
                        @foreach($documents as $key => $document)
                            @if($document->user_type == 4)
                                <div class="col-sm-4">
                                    <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <h3 style="margin-top: 0;">{{($document->related_to == 'EntryPDReport') ? 'Entry Report' : 'Exit Report' }}</h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <span>{{ $document->doc_name}}</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="documemt_action">
                                                 @if(Auth::user()->user_role == 2)
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                 @elseif(Auth::user()->user_role == 3 
                                                 && ($documentsPermission != 0) && ($documentsPermission != 1))
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                @endif
                                                    <a download href="{{url('document/'.$document->doc_name) }}"><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p>Documents not uploaded by Property description expert</p>
                @endif
            </div>
            <!-- <div id="menu_tenant" class="tab-pane fade">
                @if(count($documents) > 0)
                    <div class="row">
                        @foreach($documents as $key => $document)
                            @if($document->user_type == 5)
                                <div class="col-sm-4">
                                    <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span>{{ $document->doc_name}}</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="documemt_action">
                                                 @if(Auth::user()->user_role == 2)
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                @elseif(Auth::user()->user_role == 3 && ($documentsPermission != 0) && ($documentsPermission != 1))
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                @endif
                                                    <a href="#"><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p>Documents not uploaded by legal advisor</p>
                @endif
            </div> -->
            <div id="Water_meters" class="tab-pane fade">
                @if(count($meterReadings) > 0)
                <div class="row">
                    <div class="col-sm-12">
                        <div  class="user-info-table">
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <td >S.No</td>
                                        <td >Meter Type</td>
                                        <td >Date</td>
                                        <!-- <td >Last Reading</td> -->
                                        <td >Reading Type</td>
                                        <td >Current Reading</td>
                                        <!-- <td >Per unit Price</td>
                                        <td >Total Amount</td> -->
                                        <td >Status</td>
                                        <td >Document's</td>
                                    </tr>
                                    @foreach($meterReadings as $Reading)    
                                    <tr>
                                        <td >{{$loop->index+1}}</td>
                                        <td > 
                                            @if(isset($Reading->meter->meter_type) && $Reading->meter->meter_type == 'water_meter')
                                                Water Meter
                                            @elseif(isset($Reading->meter->meter_type) 
                                            && $Reading->meter->meter_type == 'electric_meter')
                                                Electical Meter
                                            @elseif(isset($Reading->meter->meter_type) 
                                            && $Reading->meter->meter_type == 'gas_meter')
                                                Gas Meter
                                            @endif
                                        </td>
                                        <td > {{ $Reading->reading_date }}</td>
                                        <!-- <td >
                                            @if($Reading->last_reading == '')
                                                No Last Reading
                                            @else
                                                {{ $Reading->last_reading }}
                                            @endif
                                        </td> -->
                                        <td>
                                            {{ucfirst($Reading->reading_type)}} meter reading 
                                        </td>
                                        <td >{{ $Reading->current_reading }}</td>
                                       <!--  <td >{{ App\Helpers\Helper::CURRENCYSYMBAL.$Reading->per_unit_price }}</td>
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL.$Reading->amount }}</td> -->
                                        <td class="upper_text">{{ $Reading->status }}</td>
                                        @if($Reading->upload_document)
                                        <td >
                                            <div class="documemt_action">
                                                Uploaded  
                                                @if($role == 3)
                                                    @if($documentsPermission !=0)
                                                        <a class="delete" href="{{ url('delete-meter-reading/'.$Reading->id) }}"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>
                                                    @endif
                                                @endif
                                                @if($Reading->upload_document != '')
                                                    <a href="{{ url('images/meter_reading_document/').'/'.$Reading->upload_document }}" download><span title="Download Document" class="glyphicon glyphicon-download-alt"></span></a>
                                                @endif   
                                            </div>
                                        </td>
                                        @else
                                        <td>Not Uploaded</td>
                                        @endif
                                    </tr> 
                                    @endforeach  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                {{ $meterReadings->links() }}
                @else
                <div class="row">
                    <div class="col-sm-12">
                        <div class="not_found_reading">Not Found Any Reading</div>
                    </div>
                </div>
                @endif 
            </div>
            <div id="Electricity_meters" class="tab-pane fade">
                @if(count($documents) > 0)
                    <div class="row">
                        @foreach($documents as $key => $document)
                            @if($document->user_type == 'electricity')
                                <div class="col-sm-4">
                                    <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span>{{ $document->doc_name}}</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="documemt_action">
                                                @if(Auth::user()->user_role == 2)
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                 @elseif(Auth::user()->user_role == 3 
                                                 && ($documentsPermission != 0) && ($documentsPermission != 1))
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                @endif
                                                    <a href="#"><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p>No documents for electricity meter</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="get" id="add_custom_building">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Upload Document</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="doc_type" class="col-md-4 col-form-label text-md-right">{{ __('Document Type') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="doc_type" id="doc_type">
                                <option value="">Select</option>
                                <option value="pm">Property Manager</option>
                                <option value="mr">Meter Reading</option>
                                <option value="pde">Property Description Expert</option>
                                <option value="lad">Legal Advisor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="meter_div" style="display: none;">
                        <label for="meter_type" class="col-md-4 col-form-label text-md-right">{{ __('Meter Type') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="meter_type" id="meter_type">
                                <option value="">Select</option>
                                <option value="water">Water</option>
                                <option value="internent">Ineternet</option>
                                <option value="electricity">Electricity</option>
                                <option value="gas">Gas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="doc_name" class="col-md-4 col-form-label text-md-right">{{ __('Document Name') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="doc_name" id="doc_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="doc" class="col-md-4 col-form-label text-md-right">{{ __('Document') }}</label>
                        <div class="col-md-6">
                            <input type="file" name="doc" id="doc">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" id="b_create" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#doc_type').change(function(){
        var val = $(this).val();
        if(val == 'mr')
        {
            $('#meter_div').show();
        }
        else{
            $('#meter_div').hide();
        }
    });
</script>