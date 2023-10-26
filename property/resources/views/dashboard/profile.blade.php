@section('title','Profile')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Profile'])
        <div class="container profile-page">
            <div class="row">
                <div class="col-md-3">
                    @if($user->image)
                        <div class="user-image"><img src= "{{ url('/images/users/'.$user->image)}}"></div> 
                    @else
                        <div class="user-image"><img src= "{{ url('/images/users/user-image.png')}}"></div> 
                    @endif 
                </div>
                <div class="col-md-9">
                    <!-- <div class="profile-page-title">My Profile</div>  -->
                                                                 
                    <div  class="user-info-table">
                        <table  class="table table-hover table-striped table-bordered">
                            <tbody >
                                @if($user->user_role == 3 || $user->user_role == 4 || $user->user_role == 5 )
                                    <tr >
                                        <td >Type :</td>
                                        <td >{{ ucfirst($user->tenant_type) }}</td>
                                    </tr>
                                    <tr class="company">
                                        <td >Company Name :</td>
                                        @if($user->company_name)
                                            <td >{{ $user->company_name }} </td>
                                        @else
                                            <td> -- </td>
                                        @endif  
                                    </tr>
                                    <tr class="company">
                                        <td >Company Address :</td>
                                        @if($user->company_address)
                                            <td >{{ $user->company_address }} </td>
                                        @else
                                            <td> -- </td>
                                        @endif  
                                    </tr>
                                    <tr class="company">
                                        <td >Vat nr :</td>
                                        @if($user->vat_nr)
                                            <td >{{ $user->vat_nr }} </td>
                                        @else
                                            <td> -- </td>
                                        @endif  
                                    </tr>
                                    <tr class="company">
                                        <td >Registration Number :</td>
                                        @if($user->registration_number)
                                            <td >{{ $user->registration_number }} </td>
                                        @else
                                            <td> -- </td>
                                        @endif  
                                    </tr>
                                    <tr class="company">
                                        <td >Bank Account Number :</td>
                                        @if($user->bank_account_number)
                                            <td >{{ $user->bank_account_number }} </td>
                                        @else
                                            <td> -- </td>
                                        @endif  
                                    </tr>
                                @endif
                                <tr >
                                    <td >First Name :</td>
                                    @if($user->gender)
                                        <td >{{ $user->name }}</td>
                                    @else
                                        <td> -- </td>
                                    @endif
                                </tr>
                                 <tr >
                                    <td >Last Name :</td>
                                    @if($user->gender)
                                        <td >{{ $user->last_name }}</td>
                                    @else
                                        <td> -- </td>
                                    @endif
                                </tr>
                                <tr >
                                    <td >Gender :</td>
                                    @if($user->gender)
                                        <td >{{ $user->gender }}</td>
                                    @else
                                        <td> -- </td>
                                    @endif
                                </tr>
                                <tr >
                                    <td >Phone No :</td>
                                    @if($user->phone_no)
                                        <td >{{ $user->phone_no }} 
                                            @if($user->phone_verify == 1)
                                                <span class="status verified">Verified</span>
                                            @else
                                                <span class="status not_verified">Not Verified</span> 
                                            @endif
                                        </td>
                                    @else
                                        <td> -- </td>
                                    @endif                                   
                                </tr>  
                                <tr >
                                    <td >Email :</td>
                                    <td >{{ $user->email }}
                                        @if($user->email_verified_at != null)
                                            <span class="status verified">Verified</span>
                                        @else
                                            <span class="status not_verified">Not Verified</span> 
                                        @endif
                                    </td>
                                </tr>
                                <tr >
                                    <td >Postal Address :</td>
                                    @if($user->postal)
                                         <td >{{ $user->postal }} </td>
                                    @else
                                        <td> -- </td>
                                    @endif                                   
                                </tr> 
                                <tr >
                                    <td >NR :</td>
                                    @if($user->nr)
                                         <td >{{ $user->nr }} </td>
                                    @else
                                        <td> -- </td>
                                    @endif                                   
                                </tr>
                                <tr >
                                    <td >Zip/Postal Code :</td>
                                    @if($user->postal_code)
                                         <td >{{ $user->postal_code }} </td>
                                    @else
                                        <td> -- </td>
                                    @endif                                   
                                </tr> 
                                <tr >
                                    <td >City/Region/Country :</td>
                                    @if($user->postal_code)
                                         <td >{{ $user->city }} </td>
                                    @else
                                        <td> -- </td>
                                    @endif                                   
                                </tr> 
                                <tr >
                                    <td >ID Card Number :</td>
                                    @if($user->id_card)
                                         <td >{{ $user->id_card }} </td>
                                    @else
                                        <td> -- </td>
                                    @endif                                   
                                </tr>
                                <tr >
                                    <td >Professional Status :</td>
                                    @if($user->professional_status)
                                         <td >{{ $user->professional_status }} </td>
                                    @else
                                        <td> -- </td>
                                    @endif                                   
                                </tr>
                                <!-- <tr >
                                    <td >User Type :</td>
                                    @if($user->user_role == 1)
                                         <td >Tenant</td>                                   
                                    @elseif($user->user_role == 2)
                                        <td >Property Owner</td> 
                                    @elseif($user->user_role == 3)
                                        <td >Property Manager</td>
                                    @elseif($user->user_role == 4)
                                        <td >Property Description Experts</td>
                                    @elseif($user->user_role == 5)
                                        <td >Legal Advisor</td>
                                    @elseif($user->user_role == 6)
                                        <td >Visit Organizer</td>
                                    @elseif($user->user_role == 0)
                                        <td >Admin</td>
                                    @else
                                        <td >Not Define</td>
                                    @endif
                                </tr>      -->                                                       
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="edit-link"><a href="{{ url('/editprofile') }}"> Edit Profile </a></div>
                        </div>
                        <div class="col-sm-4">
                            <div class="edit-link"><a href="{{ url('/change-password') }}"> Change Password </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <style type="text/css">
            .user-image img {width: 120px; border-radius: 50%; height: 120px; }
            .user-image {text-align: center; padding: 15px; }
            span.status.verified {padding: 0 15px; color: green; }
            span.status.not_verified {padding: 0 15px; color: red; }
            @media only screen and (max-width: 767px) {
                .edit-link {margin-top: 30px; } 
            }
        </style>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            var type = '{{$user->tenant_type}}';
            if(type == 'company') { 
                jQuery('.company').show();
            } else {
                jQuery('.company').hide();
            }
        });
    </script>
@endsection