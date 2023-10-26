@section('title','List of Tenants')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'List of Tenants'])
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if ($errors->any())
                        {!! implode('', $errors->all('<div class="error-message">:message</div>')) !!}
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="top-nevigation">
                            @include('dashboard.topnevigation')
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tenent-title">List of Tenants</div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12">
                        <div  class="user-info-table">
                            @if(count($tenants) > 0 )
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <td >Status</td>
                                        <td >First Name</td>
                                        <td >Last Name</td>
                                        <td >Phone No.</td>
                                        <td >Email</td>
                                        <td >Starting date</td>
                                        <td >End Date</td>
                                        <td >Rental Price</td>
                                        <td >Comments</td>
                                        <td >Action</td>
                                    </tr>
                                    @foreach($tenants as $tenant)
                                    <tr>
                                        @if($tenant->status < 7)
                                            <td >Active</td>
                                        @else 
                                            <td >Past</td>   
                                        @endif
                                        <td >{{ $tenant->name }}</td>
                                        <td >{{ $tenant->last_name }}</td>
                                        <td >{{ $tenant->phone_no }}</td>
                                        <td >{{ $tenant->email }}</td>
                                        <td >{{ $tenant->start_date }}</td>
                                        <td >{{ $tenant->end_date }}</td>
                                        @if($tenant->rent)
                                            <td >{{ $tenant->rent }}</td>
                                        @else
                                            <td >--</td>
                                        @endif
                                        <td >--</td>
                                        <td ><a href="{{url('tenant-details/'.$tenant->id)}}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a></td>
                                    </tr> 
                                    @endforeach                   
                                </tbody>
                            </table>
                            {{ $tenants->links() }}
                            @else
                            <div class="not_found">Not Found Any Tenant</div>
                            @endif
                        </div>
                    </div>
                </div>                                        
            </div>
        </div>
    </div> 
    <style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit-body span { font-weight: bold;  }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right; }
        .not_found {padding: 20px 0; }
        .tenent-title {font-size: 24px; }
        </style>
@endsection