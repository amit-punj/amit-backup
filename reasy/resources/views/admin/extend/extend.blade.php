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
    <div class="app-title"><h3>Extend Request</h3>
    </div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 top-nevigation">
            <div class="tab-content">
                <div id="current" class="">
                    <div class="row">
                        <div class="col-sm-12">
                            @if(count($extend_requests))
                            <div  class="user-info-table">
                                <table  class="table table-hover table-responsive table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th >Unit name</th>
                                            <th >Tanent Name</th>
                                            <th >Property Description Expert</th>
                                            <th >Property Manager</th>
                                            <th >Property Owner</th>
                                            <th >Extend Time</th>
                                            <th >Extend Date</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach($extend_requests as $key => $extend)
                                            <tr> 
                                                <td> <a href="{{ url('view_unit-admin/'.$extend->unit->id)}}">{{ $extend->unit->unit_name}}</a></td>
                                                <td><a href="{{ url('tanent-detail-admin/'.$extend->user->id)}}">{{ $extend->user->name}}</a></td>
                                                <td>{{ $extend->pde->name}}</td>
                                                <td>{{ $extend->pm->name}}</td>
                                                <td>{{ $extend->po->name}}</td>
                                                <td>
                                                    @if($extend->extend_time)
                                                @php 
                                                    $extend_time = $extend->extend_time;
                                                    $days = '';
                                                    if($extend_time > 365){
                                                        $number = explode('.',($extend_time / 365));
                                                        $extend_time=$extend_time % 365;
                                                        $days .= $number[0]." Years ";
                                                    }
                                                    if($extend_time > 30){
                                                        $number = explode('.',($extend_time / 30));
                                                        $extend_time=$extend_time % 30;
                                                        $days .= $number[0]." Months ";
                                                    }
                                                    if($extend_time > 0)
                                                    {
                                                        $days .= $extend_time." days";
                                                    }
                                                @endphp
                                                {{$days}}
                                            @else
                                                0 days
                                            @endif
                                                </td>
                                                <td>{{ $extend->extend_date}}</td>
                                            
                                                
                                            </tr>
                                        @endforeach                                        
                                    </tbody>
                                </table>
                                
                            </div>
                           
                            @else
                                <p>No tickets found!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection