@extends('admin.layout.base')

@section('title', 'Area Info ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.areaservice.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

            <h5 style="margin-bottom: 2em;">@lang('admin.areaservice.area_info')</h5>
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group row">
                    <label for="name" class="col-md-2">City Name: </label>
                    <div class="col-md-10">
                        <span class="" id="name">{{$area->name}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unit" class="col-md-2 ">Unit Measurement: </label>
                    <div class="col-md-10">
                        <span class=""> {{($area->unit == 1) ? 'Kilometers' : 'Miles'}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_type" class="col-md-2 ">Service Type: </label>
                    <div class="col-md-10">
                        @if($area->service == 0) 
                            <span>Pick</span>
                        @elseif($area->service == 1) 
                            <span>Drop</span>
                        @elseif($area->service == 2) 
                            <span>Pick & Drop</span>
                        @endif
                    </div>
                </div>
            <!-- Start area service type  -->
            <div class="box box-block bg-white">
                @if(Setting::get('demo_mode') == 1)
                    <div class="col-md-12" style="height:50px;color:red;">
                            ** Demo Mode : No Permission to Edit and Delete.
                    </div>
                @endif 
                <h5 class="mb-1">Area Service Types</h5>
                <a href="{{ route('admin.areaservice.create.servicetype',$area->id) }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Service</a>
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vehicle Type</th>
                            <!-- <th>Provider Name</th> -->
                            <th>Capacity</th>
                            <th>Base Price</th>
                            <th>Base Distance</th>
                            <th>Distance Price</th>
                            <th>Time Price</th>
                            <th>Hour Price</th>
                            <th>Price Calculation</th>
                            <th>Vehicle Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($areaService as $index => $service)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{$service->service_type->name}}</td>
                            <!-- <td>{{ $service->provider_name }}</td> -->
                            <td>{{ $service->capacity }}</td>
                            <td>{{ currency($service->fixed) }}</td>
                            <td>{{ distance($service->distance) }}</td>
                            <td>{{ currency($service->price) }}</td>
                            <td>{{ currency($service->minute) }}</td>
                            @if($service->calculator == 'DISTANCEHOUR') 
                            <td>{{ currency($service->hour) }}</td>
                            @else
                            <td>No Hour Price</td>
                            @endif
                            <td>@lang('servicetypes.'.$service->calculator)</td>
                            <td>
                                @if($service->image) 
                                    <img src="{{img($service->image)}}" style="height: 50px">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.areaservice.destroy.servicetype', $service->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    @if( Setting::get('demo_mode') == 0)
                                    <a href="{{ route('admin.areaservice.edit.servicetype', [$service->id,$area->id]) }}" class="btn btn-info btn-block">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Vehicle Type</th>
                            <!-- <th>Provider Name</th> -->
                            <th>Capacity</th>
                            <th>Base Price</th>
                            <th>Base Distance</th>
                            <th>Distance Price</th>
                            <th>Time Price</th>
                            <th>Hour Price</th>
                            <th>Price Calculation</th>
                            <th>Vehicle Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
             <!-- end area service type  -->
        </div>
    </div>
</div>
@endsection
