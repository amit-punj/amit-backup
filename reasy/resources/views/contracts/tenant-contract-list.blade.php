@section('title','Contracts')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Contracts'])
<div class="container">
    <div class="row">
        <form autocomplete="off" method="GET" action="{{ url('my-contract-list') }}" enctype="multipart/form-data" id="upload_receipt_form">
              @csrf       
            <div class="col-md-10 col-12 col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="keyword" class="form-control" value="{{( isset($_GET['keyword']) )? $_GET['keyword'] : ''}}" placeholder="Filter by Owner Name" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="search" id="search" class="form-control color-gray">
                                <option value="">Search Filter</option>
                                <option value="6" {{( isset($_GET['search']) && $_GET['search'] == 6 )? 'selected' : ''}}>Active</option>
                                <option value="0" {{( isset($_GET['search']) && $_GET['search'] == 0 )? 'selected' : ''}}>Draft</option>
                                <option value="9" {{( isset($_GET['search']) && $_GET['search'] == 9 )? 'selected' : ''}}>Passed</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 col-sm-12">
                <div>
                    <button type="submit" id="search_" class="btn btn-success btn-block search_">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-12 top-nevigation">
            <div class="tab-content">
                <div id="current" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-sm-12">
                            @if(count($contracts) > 0 )
                            <div  class="user-info-table">
                                <table  class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th >Unit name</th>
                                            <!-- <th >Tenant name</th> -->
                                            <th >Contract</th>
                                            <th >Amount</th>
                                            <th >Payment method</th>
                                            <th >Status</th>
                                            <th >Starting date</th>
                                            <th >End date</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach($contracts as $key1 => $contract) 
                                            <tr> 
                                                <td> <a href="{{url('propertydetails/'.$contract->unit_id)}}">{{ substr($contract->unit['unit_name'],0,20) }}</a></td>
                                                <!-- <a href="{{ url('tenant-details/'.$contract->tenant_id) }}">{{ $contract->user['name'] }}</a> -->
                                                <!-- <td>{{ $contract->user['name'] }}</td> -->
                                                <td > <a href="{{ url('contract-details/'.$contract->id) }}">{{ucfirst( $contract->contract_type )}}</a></td>
                                                <td >$ {{$contract->total_amount}}</td>
                                                <td > 
                                                    @if($contract->payment_method == 'stripe')
                                                        Credit or Debit Card
                                                    @else
                                                        {{ ucfirst($contract->payment_method) }}
                                                    @endif
                                                    ({{ucfirst($contract->payment_status)}})</td>
                                                <td >
                                                    @if($contract->status == 0 )
                                                        <span>Draft(Pending for confirmation)</span>
                                                    @elseif($contract->status == 0 && $contract->payment_method == 'bank' && $contract->payment_status == 'pending')
                                                        <span>Draft(Pending bank receipt)</span>
                                                    @elseif($contract->status == 0 && $contract->payment_method == 'stripe' && $contract->payment_status == 'hold')
                                                        <span>Draft(Pending for confirmation)</span>
                                                    @elseif($contract->status == 3)
                                                        <span>Booked</span>
                                                    @elseif($contract->status == 4)
                                                        <span>Draft(Booking request canceled by PM)</span>
                                                    @elseif($contract->status == 6)
                                                        <span>Active</span>
                                                    @elseif($contract->status == 7)
                                                        <span>Draft(Booking canceled by tenant)</span>
                                                    @elseif($contract->status == 8)
                                                        <span>Termination request send</span>
                                                    @elseif($contract->status == 9)
                                                        <span>Passed</span>
                                                    @elseif($contract->status == 10)
                                                        <span>Draft (Unable to upload receipt)</span>
                                                    @endif
                                                </td>
                                                <td >{!! \Helper::Date($contract->start_date); !!}</td>
                                                <td >{!! \Helper::Date($contract->end_date); !!}</td>
                                                <td >
                                                    <a href="{{url('contract-details/'.$contract->id)}}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a>
                                                    @if($contract->status == 0 || $contract->status == 1 || $contract->status == 2 || $contract->status == 3 || $contract->status == 5 )
                                                    <a href="{{url('contract-cancelBY-tenant/'.$contract->id)}}" onclick="return confirm('Want to cancel this!');" class="btn btn-danger">Cancel</a>
                                                    @endif
                                                    @if($contract->payment_method == 'bank' && $contract->payment_status == 'pending')
                                                        @if($contract->status == 10 || $contract->status == 4)
                                                        
                                                        @else
                                                        <a href="javascript::void();" class="upload_receipt" data-id="{{$contract->id}}">Upload proof of payment!</a>
                                                        @endif
                                                    @elseif($contract->payment_method == 'bank' && $contract->payment_status == 'paid')
                                                        <span >Proof of payment uploaded!</span>
                                                    @elseif($contract->status == 9)
                                                        <?php $ratingByPO = '';
                                                        $ratingByYou = ''; ?>
                                                        @if(isset($contract->rating) && count($contract->rating) > 0)
                                                            @foreach($contract->rating as $key => $rating)
                                                                @if($rating->given_by == \Auth::user()->id )
                                                                    <?php $ratingByYou = $rating->rating; ?>
                                                                @else
                                                                    <?php $ratingByPO = $rating->rating; ?>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        <a class="give_rating" data-toggle="modal" data-target="#give_rating_modal_{{$key1}}">Rating</a>
    <div class="modal fade" id="give_rating_modal_{{$key1}}" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" method="POST" action="{{ url('give-rating') }}" enctype="multipart/form-data" id="upload_receipt_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Give rating to PO</h3>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="booking_id" id="booking_id" value="{{$contract->id}}">
                        <input type="hidden" name="url" id="url" value="{{url()->current()}}">
                        <div class="form-group row">
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rating given by PO') }}</label>
                            <div class="col-md-8">
                                <label for="input-1" class="control-label">Read only stars:</label>
                                <input id="input-1" name="input-1" class="rating by-po rating-loading" value="{{$ratingByPO}}" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs">
                            </div>
                        </div>
                        <div class="form-group row">
                            <?php $readonly = (!empty($ratingByYou) && $ratingByYou != '') ? 'data-readonly="true"' : '' ; ?>
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Give rating to PO') }}</label>
                            <div class="col-md-8">
                                <!-- <label for="input-1" class="control-label">One star:</label> -->
                                <input id="input-1" name="input-1" class="rating by-you rating-loading" value="{{$ratingByYou}}" {{$readonly}} data-min="0" data-max="5" data-step="0.5" data-size="xs">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="upload" {{ (!empty($ratingByYou) && $ratingByYou != '') ? 'disabled' : ''  }} class="btn btn-success">Give Rating</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="row" style="justify-content: center; margin-top: 2%;">
                                <ul class="pagination">
                                    <!-- LINK FIRST AND PREV -->
                                    <?php
                                    // $limit = 2 ; // Amount of data per page  

                                    // To determine what data will be displayed in the table in the database
                                    // $query = url()->full();
                                    // echo $query =  parse_url($query, PHP_URL_QUERY); 
                                    // echo "<br>";
                                    // echo $string = (isset($query) && !empty($query)) ? '&' : '?' ;

                                    $limit_start = ( $page - 1 ) * $limit ;    
                                    if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
                                    ?>
                                    <li class="disabled active"><a class="btn mx-1" href="#">First</a></li>
                                    <li class="disabled"><a class="btn btn-InActive mx-1" href="#">&laquo;</a></li>
                                    <?php
                                    }else{ // Jika page bukan page ke 1
                                    $link_prev = ($page > 1)? $page - 1 : 1;
                                    ?>
                                    <li><a class="btn btn-InActive mx-1" href="<?php echo url()->full(); ?>&pageno=1">First</a></li>
                                    <li><a class="btn btn-InActive mx-1" href="<?php echo url()->full(); ?>&pageno=<?php echo $link_prev; ?>">&laquo;</a></li>
                                    <?php
                                    }
                                    ?>

                                    <!-- LINK NUMBER -->
                                    <?php
                                    $jumlah_page = $total_pages; // Hitung jumlah halamannya
                                    $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                                    $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
                                    $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

                                    for($i = $start_number; $i <= $end_number; $i++){
                                    $link_active = ($page == $i)? ' class="active"' : '';
                                    $btn_active = ($page == $i)? '' : 'btn-InActive';
                                    ?>
                                    <li<?php echo $link_active; ?>><a class="btn mx-1 <?php echo $btn_active; ?>" href="<?php echo url()->full(); ?>&pageno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                    }
                                    ?>

                                    <!-- LINK NEXT AND LAST -->
                                    <?php
                                    // Jika page sama dengan jumlah page, maka disable link NEXT nya
                                    // Artinya page tersebut adalah page terakhir 
                                    if($page == $jumlah_page){ // Jika page terakhir
                                    ?>
                                    <li class="disabled"><a class="btn btn-InActive mx-1" href="#">&raquo;</a></li>
                                    <li class="disabled active"><a class="btn mx-1" href="#">Last</a></li>
                                    <?php
                                    }else{ // Jika Bukan page terakhir
                                    $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                                    ?>
                                    <li><a class="btn btn-InActive mx-1" href="<?php echo url()->full(); ?>&pageno=<?php echo $link_next; ?>">&raquo;</a></li>
                                    <li><a class="btn btn-InActive mx-1" href="<?php echo url()->full(); ?>&pageno=<?php echo $jumlah_page; ?>">Last</a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            @else
                                <p>No contracts found!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="modal fade" id="extend" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="get" id="visit_add_remark">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Contract Extenssions</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Select Date') }}</label>
                            <div class="col-md-8">
                                <div id="any_days" class="">
                                    <div id="datepicker_not_av"></div>
                                </div>
                                <input type="hidden" name="selecteddates" value="" class="selecteddates" />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark *') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('remark') is-invalid @enderror remark" name="remark" required="" rows="5" cols="50" placeholder="Add Remark">{{ old('remark','Add Remarks') }}</textarea>
                                @error('remark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="b_create" class="btn btn-success">Extend</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cancel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="visit_add_remark">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Add Remark</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark *') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('remark') is-invalid @enderror remark" name="remark" required="" rows="5" cols="50" placeholder="Add Remark">{{ old('remark','Add Remarks') }}</textarea>
                                @error('remark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="b_create" class="btn btn-success">Extend</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upload_receipt_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" method="POST" action="{{ url('upload-receipt') }}" enctype="multipart/form-data" id="upload_receipt_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Upload Bank Receipt</h3>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="booking_id" id="booking_id" value="">
                        <input type="hidden" name="url" id="url" value="{{url()->current()}}">
                        <div class="form-group row">
                            <div class="col-md-12">
                               <p><strong>Note:</strong> Please upload receipt which you get from bank after payment.</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Upload Receipt') }}</label>
                            <div class="col-md-9">
                               <input type="file" id="receipt" name="receipt">
                            </div>
                            @error('receipt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="upload" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="modal fade" id="give_rating_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" method="POST" action="{{ url('give-rating') }}" enctype="multipart/form-data" id="upload_receipt_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Give rating to PO</h3>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="booking_id" id="booking_id" value="">
                        <input type="hidden" name="url" id="url" value="{{url()->current()}}">
                        <div class="form-group row">
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rating given by PO') }}</label>
                            <div class="col-md-8">
                                <label for="input-1" class="control-label">Read only stars:</label>
                                <input id="input-1" name="input-1" class="rating by-po rating-loading" value="" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Give rating to PO') }}</label>
                            <div class="col-md-8">
                                <label for="input-1" class="control-label">One star:</label>
                                <input id="input-1" name="input-1" class="rating by-you rating-loading" value="" data-min="0" data-max="5" data-step="0.5" data-size="xs">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="upload" class="btn btn-success">Give Rating</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
</div>
<style type="text/css">
    .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
    .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; height: 380px }
    .unit_number {font-size: 18px; }
    .unit-body span { font-weight: bold;  }
    .unit {padding: 5px 0; }
    .top-nevigation {padding-bottom: 25px; }
    ul.nav.nav-tabs {border: 0; }
    .top-nevigation li {border: 0 !important; padding: 0 6px; }
    /*.top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }*/
    .top-nevigation li.active a {background: #f28302; color: #fff; }
    .add-unit-main {text-align: right; }
    .unit-delete spaimg
{
    margin-top:10px;
    width:50px;
    height:50px;
    float:left;
    
}n {color: #000000bd; position: relative; float: right; }
    .Current_Active_Contract {font-size: 24px; text-align: center; }
    .documemt_action {text-align: right; }
    .documemt_action a {color: #000000bd; padding: 0 5px; }
    .contract-alert {background-color: bisque; padding: 9px; margin: 8px; border-radius: 5px; }
    .contract-alert-title {font-size: 24px; }
    ul.nav.nav-tabs {padding: 30px 0 0; }
    ul.nav.nav-tabs li a {font-size: 15px; background-color: #fae4c4; color: inherit; }
    ul.nav.nav-tabs li {padding: 0 5px; }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: white; cursor: default; background-color: #f28401; }
    ul.nav.nav-tabs li.active a {background-color: #f28401; color: white; }
    .fs-24{ font-size: 24px; }
    .unit-action { margin: 20px 0px; }
    .float-right { float: right; }
    .checked { color: orange;}

/*img
{
    margin-top:10px;
    width:50px;
    height:50px;
    float:left;
    
}*/

</style>
<script>
$("#input-id").rating();
</script>
<script>
    $( function() {
        var values = [];
        $( "#datepicker_not_av" ).multiDatesPicker({
            changeMonth: true,
            changeYear: true,
            minDate:0,
            onSelect: function(selectedDate) {
                var vindex = values.findIndex(v => v == selectedDate);
                if(vindex != -1){values.splice(vindex,1);}else{
                values.push(selectedDate);
            }
            var unique = values.filter(function(itm, i, values) {
                return i == values.indexOf(itm);
            });
            $('.selecteddates').val(unique);
            }
        });
    } );
    function cancelContract() {
      if (confirm("Want to cancel this!")) {
        $('#cancel').modal('show');
      } 
    }
    function CompleteContract() {
      if (confirm("Want to Complete this!")) {
        $('#cancel').modal('show');
      } 
    }
    jQuery('.upload_receipt').click(function(){
        var id      = $(this).data('id');
        $('#upload_receipt_modal').modal('show');
        $("#upload_receipt_modal #booking_id").val(id);
    });
    jQuery('.give_rating21').click(function(){
        var id      = $(this).data('id');
        var ratingbypo      = $(this).data('ratingbypo');
        var ratingbyyou      = $(this).data('ratingbyyou');
        alert(ratingbyyou+'//'+ratingbypo);
        $('#give_rating_modal').modal('show');
        $("#give_rating_modal #booking_id").val(id);
        $("#give_rating_modal .by-po").val(ratingbypo);
        $("#give_rating_modal .by-you").val(ratingbyyou);
        $("#input-id").rating();
    });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} kb');
    $("#upload_receipt_form").validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            receipt: {
              required: true,
              accept: "image/*",
              // filesize: 20000,
            }
        },
        messages: {
            receipt: {
              required: "Please upload receipt",
              accept: "The Receipt must be a file of type: jpeg, png, jpg.",
              filesize: "The Receipt may not be greater than 2MB",
            }
        },
    });
</script>
@endsection