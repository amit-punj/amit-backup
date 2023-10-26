@section('title','Guarantor details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Guarantor details'])
        <div class="container profile-page">
            <div class="row">
                <div class="col-md-3">
                    @if($guarantor->photo_id_proof)
                        <div class="user-image"><img src= "{{ url('/images/guarantor/'.$guarantor->photo_id_proof)}}"></div> 
                    @else
                        <div class="user-image"><img src= "{{ url('/images/users/user-image.png')}}"></div> 
                    @endif 
                </div>
                <div class="col-md-9">
                    <div  class="user-info-table">
                        <h2>Personal information</h2>
                        <table  class="table table-hover table-striped table-bordered">
                            <tbody >
                                <tr >
                                    <td >Name :</td>
                                    @if($guarantor->name)
                                        <td >{{ $guarantor->name }}</td>
                                    @else
                                        <td> -- </td>
                                    @endif
                                </tr>
                                <tr >
                                    <td >Phone No :</td>
                                    @if($guarantor->phone_no)
                                        <td >{{ $guarantor->phone_no }} 
                                        </td>
                                    @else
                                        <td> -- </td>
                                    @endif                                   
                                </tr>  
                                <tr >
                                    <td >Email :</td>
                                    <td >{{ $guarantor->email }}
                                    </td>
                                </tr>
                                <tr >
                                    <td >Address :</td>
                                    @if($guarantor->address)
                                         <td >{{ $guarantor->address }} </td>
                                    @else
                                        <td> -- </td>
                                    @endif                                   
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
        <style type="text/css">
            .user-image img {width: 120px; border-radius: 50%; height: 120px; }
            .user-image {text-align: center; padding: 15px; }
            span.status.verified {padding: 0 15px; color: green; }
            span.status.not_verified {padding: 0 15px; color: red; }
            .user-account-table {margin-top: 35px; }
            @media only screen and (max-width: 767px) {
                .edit-link {margin-top: 30px; } 
            }
        </style>
@endsection