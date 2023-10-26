@extends('layouts.app')
@section('content')
@include('layouts.banner')
        <div class="container profile-page">
            <div class="row">
                <div class="col-md-3">
                    @include('dashboard.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="profile-page-title">List Of Properties</div>                                                 
                    <div  class="user-info-table">
                        @if (count($properties) >= 1)
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <td >Title</td>
                                        <td >Address</td>
                                        <!-- <td >Rent</td>
                                        <td >Deposit</td> -->
                                        <!-- <td >Action</td> -->
                                        <td >View</td>
                                    </tr>
                                        @foreach($properties as $property)                     
                                            <tr>
                                                <td >{{ $property->title }}</td>
                                                <td >{{ $property->location }}</td>
                                 <!--                <td >{{ $property->rent }}</td>
                                                <td >{{ $property->deposite }}</td> -->
                                                <!--td >
                                                    <a href="">Edit</a>  <a href="{{ url('/delete-property/'.$property->id) }}">Delete</a>
                                                </td-->
                                                <td ><a target="_blank" href="{{ url('/propertydetails/'.$property->id) }}">View</a></td>
                                            </tr>
                                        @endforeach                           
                                </tbody>
                            </table>
                        @else
                            <div>Not found any property.</div>
                        @endif
                    </div>                  
                </div>
            </div>
        </div> 
@endsection