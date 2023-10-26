@extends('admin.layout.base')

@section('title', 'Area ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
           @if(Setting::get('demo_mode') == 1)
        <div class="col-md-12" style="height:50px;color:red;">
                    ** Demo Mode : No Permission to Edit and Delete.
                </div>
                @endif 
            <h5 class="mb-1">Area List</h5>
            <a href="{{ route('admin.areaservice.area.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Area</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Distance Unit</th>
                        <th>Service Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($areas as $index => $area)
                    <tr class="row">
                        <td >{{$index + 1}}</td>
                        <td >{{$area->name}}</td>
                        <td >
                        @if($area->unit == 1) <span>Kilometers</span>
                        @elseif($area->unit == 2) <span>Miles</span>
                        @endif
                        </td>
                        <td >
                        @if($area->service == 0) <span>Pick</span>
                        @elseif($area->service == 1) <span>Drop</span>
                        @elseif($area->service == 2) <span>Pick & Drop</span>
                        @endif
                        </td>
                        <!--  <td style="width: 10%; text-align: center"> </td> -->
                        <td >
                        <a href="{{url('/area-info/'.$area->id)}}" id="detail"><i class="fa fa-id-card mr-4" aria-hidden="true"> View</i></a>
                        <a href="{{url('/edit-area/'.$area->id)}}" id="edit"><i class="fa fa-pencil-square-o mr-4" aria-hidden="true"> Edit</i></a>
                        <a style="color: red;" href="{{url('/delete-area/'.$area->id)}}" id="delete" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash fa-del" aria-hidden="true"> Delete</i></a>
                        </td>
                        <td>
                            <form action="{{ route('admin.service.destroy', $service->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                @if( Setting::get('demo_mode') == 0)
                                <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-info btn-block">
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
                        <th>Name</th>
                        <th>Distance Unit</th>
                        <th>Service Type</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection