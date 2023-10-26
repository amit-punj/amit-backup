 @extends('adminlayouts.app')
@section('content')
<?php
$role = Auth::user()->user_role; 
//$contractPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'contract_permission');
?>
<style type="text/css">
    #loading-image{
        margin-left: 37%;
    margin-top: -47%;
    display: none;
    }
</style>
<main class="app-content">
    <div class="app-title"><h3>Contract List</h3>
    </div>
<div class="container">
    <div class="row">
        <form method="get">
              @csrf       
            <div class="col-md-10 col-12 col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="keyword" value="{{( isset($_GET['keyword']) )? $_GET['keyword'] : ''}}" class="form-control" placeholder="Filter by Owner Name" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="search" id="search" class="form-control color-gray">
                                <option value="">Search Filter</option>
                                <option value="6" {{( isset($_GET['search']) && $_GET['search'] == 6 )? 'selected' : ''}}>Running</option>
                                <option value="0" {{( isset($_GET['search']) && $_GET['search'] == 0 )? 'selected' : ''}}>Draft</option>
                                <option value="9" {{( isset($_GET['search']) && $_GET['search'] == 9 )? 'selected' : ''}}>Passed</option>
                                <option value="Future" disabled="">Future</option>
                                <option value="8" {{( isset($_GET['search']) && $_GET['search'] == 8 )? 'selected' : ''}}>On Notice Period</option>
                                <option value="house" disabled="">Payment Received </option>
                                <option value="house" disabled="">Small payment Delay </option>
                                <option value="house" disabled="">Payment Delay </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 col-sm-12">
                <div>
                    <button type="submit" id="search_" class="btn btn-success btn-block search_">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-12 top-nevigation">
            <div class="tab-content">
                <div id="current" class="">
                    <div class="row">
                        <div class="col-sm-12">
                            @if(count($contracts) > 0 )
                            <div  class="user-info-table">
                                <table  class="table table-hover table-responsive table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th >Unit name</th>
                                            <th >User Name</th>
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
                                                <td> <a href="{{url('view_unit-admin/'.$contract->unit_id)}}">{{ substr($contract->unit['unit_name'],0,20) }}</a></td>
                                                <td>
                                                <!-- <a href="{{ url('tenant-details/'.$contract->tenant_id) }}">{{ $contract->user['name'] }}</a> -->
                                                {{ $contract->user['name'] }}</td>
                                                <td > <a href="{{ url('contract-detail-admin/'.$contract->id) }}">{{ucfirst( $contract->contract_type )}}</a></td>
                                                <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{$contract->unit['rent'] + $contract->unit['cost_provision']}}</td>
                                                <td >{{ ucfirst($contract->payment_method) }} ({{ucfirst($contract->payment_status)}})</td>
                                                <td >
                                                    @if($contract->status == 0 && $contract->payment_status == 'paid')
                                                        <span>Draft(Pending for confirmation)</span>
                                                    @elseif($contract->status == 0 && $contract->payment_method == 'bank' && $contract->payment_status == 'pending')
                                                        <span>Draft(Pending bank receipt)</span>
                                                    @elseif($contract->status == 0 && $contract->payment_method == 'stripe' && $contract->payment_status == 'hold')
                                                        <span>Draft(Pending for confirmation)</span>
                                                    @elseif($contract->status == 3)
                                                        <span>Draft(Booking confirmed)</span>
                                                    @elseif($contract->status == 4)
                                                        <span>Draft(Booking canceled by PM)</span>
                                                    @elseif($contract->status == 6)
                                                        <span>Running</span>
                                                    @elseif($contract->status == 7)
                                                        <span>Draft(Booking canceled by tenant)</span>
                                                    @elseif($contract->status == 8)
                                                        <span>Termination request send</span>
                                                    @elseif($contract->status == 9)
                                                        <span>Passed</span>
                                                    @endif
                                                </td>
                                                <td >{!! \Helper::Date($contract->start_date); !!}</td>
                                                <td >{!! \Helper::Date($contract->end_date); !!}</td>
                                                <td ><a href="{{url('contract-detail-admin/'.$contract->id)}}">View</a>
                                                <?php
                                                $deposit = (isset($contract->unit['deposit'])) ? $contract->unit['deposit'] + $contract->unit['rent'] + $contract->unit['cost_provision'] : '0' ;
                                                $payment_method = (isset($contract->payment_method) ) ? ucfirst($contract->payment_method) : '' ;
                                                $bank_name = (isset($contract->account['bank_name']) ) ? $contract->account['bank_name'] : '' ;
                                                $ada_number = (isset($contract->account['ada_number']) ) ? $contract->account['ada_number'] : '' ;
                                                $account_number = (isset($contract->account['account_number']) ) ? $contract->account['account_number'] : ''  ;
                                                $routing_number = (isset($contract->account['routing_number']) ) ? $contract->account['routing_number'] : '' ;
                                                $paypal_email = (isset($contract->account['paypal_email']) ) ? $contract->account['paypal_email'] : '' ;
                                                $unit_name = (isset($contract->unit['unit_name']) ) ? substr($contract->unit['unit_name'],0,20) : '' ;
                                                ?>
                                                @if( ($contract->status == '0' && $contract->payment_status == 'paid' ) || ($contract->status == '0' && $contract->payment_status == 'hold' ))
                                                    <?php
                                                        $contractPermission = App\Helpers\Helper::accessPermission($contract->po_id,Auth::user()->user_role,'contract_permission');
                                                    ?>
                                                    @if($role == 0)
                                                    <button data-id="{{$contract->id}}" data-status="3" class="booking_action btn btn-success">Accept</button>
                                                    <button data-id="{{$contract->id}}" data-status="4" class="booking_action btn btn-danger">Reject</button><br>
                                                    <a href="javascript::void();" data-id="{{$contract->id}}" data-method = {{$payment_method}} data-amount="{{$deposit}}" data-account="{{$account_number}}" data-router="{{$routing_number}}" data-aba="{{$ada_number}}" data-bank="{{$bank_name}}" data-unit="{{$unit_name}}" data-email="{{$paypal_email}}" data-tenant="{{$contract->user['name']}}" class="payment bank_details">Refund details!</a>
                                                    @elseif($role == 0 && ( ($contractPermission == 1) || ($contractPermission ==2) ) )
                                                    <button data-id="{{$contract->id}}" data-status="3" class="booking_action btn btn-success">Accept</button>
                                                    <button data-id="{{$contract->id}}" data-status="4" class="booking_action btn btn-danger">Reject</button><br>
                                                    <a href="javascript::void();" data-id="{{$contract->id}}" data-method = {{$payment_method}} data-amount="{{$deposit}}" data-account="{{$account_number}}" data-router="{{$routing_number}}" data-aba="{{$ada_number}}" data-bank="{{$bank_name}}" data-unit="{{$unit_name}}" data-email="{{$paypal_email}}" data-tenant="{{$contract->user['name']}}" class="payment bank_details">Refund details!</a>
                                                    @endif
                                                @elseif($contract->status == 0 && $contract->payment_method == 'bank' && $contract->payment_status == 'pending')
                                                    <?php
                                                        $contractPermission = App\Helpers\Helper::accessPermission($contract->po_id,Auth::user()->user_role,'contract_permission');
                                                    ?>
                                                    @if($role == 0)
                                                    <button data-id="{{$contract->id}}" data-status="4" class="booking_action btn btn-danger">Reject</button>
                                                    @elseif($role == 0 && ( ($contractPermission == 1) || ($contractPermission ==2) ) )
                                                    <button data-id="{{$contract->id}}" data-status="4" class="booking_action btn btn-danger">Reject</button>
                                                    @endif
                                                @endif
                                                @if($role == 0 || $role == 0)
                                                    @if($contract->status == 9)
                                                        <?php $ratingByTenant = '';
                                                        $ratingByYou = ''; ?>
                                                        @if(isset($contract->rating) && count($contract->rating) > 0)
                                                            @foreach($contract->rating as $key => $rating)
                                                                @if($rating->given_by == \Auth::user()->id )
                                                                    <?php $ratingByYou = $rating->rating; ?>
                                                                @else
                                                                    <?php $ratingByTenant = $rating->rating; ?>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        <!-- <a class="give_rating" data-ratingbytenant="{{$ratingByTenant}}" data-ratingbyyou="{{$ratingByYou}}" data-id="{{$contract->id}}">Rating</a> -->
                                                        <a class="give_rating" data-toggle="modal" data-target="#give_rating_modal_{{$key1}}">Rating</a>
    <div class="modal fade" id="give_rating_modal_{{$key1}}" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" method="POST" action="{{ url('give-rating') }}" enctype="multipart/form-data" id="upload_receipt_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Give rating to Tenant</h3>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="booking_id" id="booking_id" value="{{$contract->id}}">
                        <input type="hidden" name="url" id="url" value="{{url()->current()}}">
                        <div class="form-group row">
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rating given by Tenant') }}</label>
                            <div class="col-md-8">
                                <label for="input-1" class="control-label">Read only stars:</label>
                                <input id="input-1" name="input-1" class="rating by-tenant rating-loading" value="{{$ratingByTenant}}" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs">
                            </div>
                        </div>
                        <div class="form-group row">
                            <?php $readonly = (!empty($ratingByYou) && $ratingByYou != '') ? 'data-readonly="true"' : '' ; ?>
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Give rating to Tenant') }}</label>
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
    <div class="modal fade" id="bank_details" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Refund Details</h3>
                </div>
                <div class="modal-body termsToPrint">
                    <table>
                        <tbody>
                            <tr>
                                <th id="unit"></th>
                                <th id="tenant"></th>
                            </tr>
                            <tr>
                                <td>Paid amount:</td>
                                <td><p id="amount"></p></td>
                            </tr>
                            <tr>
                                <td>Payment Method:</td>
                                <td><p id="method"></p></td>
                            </tr>
                            <tr>
                                <td>Bank Name:</td>
                                <td><p id="bank"></p></td>
                            </tr>
                            <tr>
                                <td>ABA number:</td>
                                <td><p id="aba"></p></td>
                            </tr>
                            <tr>
                                <td>Account number:</td>
                                <td><p id="account"></p></td>
                            </tr>
                            <tr>
                                <td>Routing code:</td>
                                <td><p id="router"></p></td>
                            </tr>
                            <tr>
                                <td>Paypal Email:</td>
                                <td><p id="paypal_email"></p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <!-- <button class="btn btn-success" id="bank_payment_done">Pay</button> -->
                    </div>
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <!-- <button class="btn btn-info" onclick="window.print();">Print</button> -->
                        <button class="btn btn-info" id="printOut">Print</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
   <!--  <div class="modal fade" id="give_rating_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" method="POST" action="{{ url('give-rating') }}" enctype="multipart/form-data" id="upload_receipt_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Give rating to Tenant</h3>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="booking_id" id="booking_id" value="">
                        <input type="hidden" name="url" id="url" value="{{url()->current()}}">
                        <div class="form-group row">
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rating given by Tenant') }}</label>
                            <div class="col-md-8">
                                <label for="input-1" class="control-label">Read only stars:</label>
                                <input id="input-1" name="input-1" class="rating by-tenant rating-loading" value="" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Give rating to Tenant') }}</label>
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
<div class="container">
        <!-- content to be printed here -->
</div>
<div id="loader_div" class="loader_div">
  <img id="loading-image" src="{{ asset('images/loader.gif')}}">
</div>
<script type="text/javascript">
        $(function(){
            $('#printOut').click(function(e){
                e.preventDefault();
                var w = window.open();
                // var printOne = $('.contentToPrint').html();
                var printTwo = $('.termsToPrint').html();
                w.document.write('<html><head><title>Bank Details</title></head><body><h1>Bank Details</h1><hr />' + printTwo) + '</body></html>';
                w.window.print();
                w.document.close();
                return false;
            });
        });
    </script>
<style type="text/css">
       button.booking_action.btn.btn-success{
            width: 100%;
        }
        button.booking_action.btn.btn-danger {
            margin-top: 5px;
            width: 100%;
        }
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
    .unit-delete span {color: #000000bd; position: relative; float: right; }
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
    .termsToPrint tr td {width: 10%;}
    #unit{width: 75%;}
</style>
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
    jQuery('.give_rating21').click(function(){
        var id      = $(this).data('id');
        $('#give_rating_modal').modal('show');
        $("#give_rating_modal #booking_id").val(id);

        var id      = $(this).data('id');
        var ratingbytenant      = $(this).data('ratingbytenant');
        var ratingbyyou      = $(this).data('ratingbyyou');
        alert(ratingbyyou+'//'+ratingbytenant);
        $('#give_rating_modal').modal('show');
        $("#give_rating_modal #booking_id").val(id);
        $("#give_rating_modal .by-tenant").val(ratingbytenant);
        $("#give_rating_modal .by-you").val(ratingbyyou);
        $("#input-id").rating();
    });
    jQuery('.cancel_refund_details').click(function(){
        var id      = $(this).data('id');
        $('#cancel_refund_details_modal').modal('show');
        $("#cancel_refund_details_modal #booking_id").val(id);
    });
    jQuery('.bank_details').click(function(){
        var amount      = $(this).data('amount');
        var account     = $(this).data('account');
        var router      = $(this).data('router');
        var aba         = $(this).data('aba');
        var bank        = $(this).data('bank');
        var unit        = $(this).data('unit');
        var tenant      = $(this).data('tenant');
        var email      = $(this).data('email');
        var method      = $(this).data('method');
        $('#bank_details').modal('show');
        $("#bank_details #amount").text( amount );
        $("#bank_details #router").text( router );
        $("#bank_details #account").text( account );
        $("#bank_details #aba").text( aba );
        $("#bank_details #bank").text( bank );            
        $("#bank_details #paypal_email").text( email );            
        $("#bank_details #method").text( method );            
        $("#bank_details #unit").text( 'References: '+unit  );            
        $("#bank_details #tenant").text( tenant );            
    });

    jQuery('.booking_action').click(function(){
        var id      = $(this).data('id');
        var status  = jQuery(this).data('status');
        var thisa   = $(this);
        var result  = "";
        if(status == '3'){
            var result = confirm("Want to accept the booking?");
        }
        else if(status == '4'){
            var result = confirm("Want to reject the booking?");
        }
        if (!result) {
            return false;
        }
         jQuery(".loader_div").show();
        $.ajax(
        {
            url: "{{url('update-booking-status')}}",
            type: "post",
            data: {
                '_token':'<?php echo csrf_token() ?>',
                'id':id,
                'status':status
            },
            success : function(data) {
               jQuery(".loader_div").hide(); 
                var myJSON = JSON.parse(data);
                if(myJSON.success){
                    toastr.success(myJSON.success);
                    setTimeout(function(){ location.reload(); }, 3000);
                } else if(myJSON.error){
                    toastr.error(myJSON.error);
                    setTimeout(function(){ location.reload(); }, 3000);
                } else {
                    location.reload();
                }
            },
            error : function(data) {
            }
        });
    });

</script>
@endsection