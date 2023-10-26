@extends('layouts.main')
@section('content')
<style type="text/css">
span.hidden-sm-down {
    color: white;
}
h5{
  color: white;
}
.edit{
  float: right;
}
.btn:hover {
    color: white;
    text-decoration: none;
}
ul.pagination{
  justify-content: center;
}
.active .btn{
  background-color: #278001 !important;
  color: #fff !important;
}
.btn-InActive {
    background: transparent !important;
    color: green !important;
}

.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: green;
    border-color: green;
}
.page-link {
    color: #37a745;
    }
    .small-box-footer {
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    z-index: 10;
    margin-right: 3%;
    color: green;
    margin-top: -2%;
    font-size: 20px;
    float: right;
}
div#main {
    background-color: #f3f3f3;
}
th{
  width: 1%;
}
.border-none.table td{
  border-top: none !important;
} 
.note
{
  text-align: center;height: 80px;background-color:  #0f2b61;color: #fff;font-weight: bold;line-height: 80px;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: auto;
  font-family: arial;
  margin-top: 5%;
}
.title {
  font-size: 22px;
}
.backbtn{
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
.margin-item{
  padding: 0 10px 10px 10px;
}

.main {background-color: #f3f3f3;}
.name{
 font-size: 25px;
}
.name2{
margin-top: 2%;
margin-bottom: 2%;
}
.text-item{
  font-size: 16px;

}
.text_child{
  font-size: 15px;

}
.dummy-user{
      width: 50%;
    height: 117px;
}
.small-box-footer{
  margin-top: -3%;
  float: right;
}
@media screen and (max-width: 1024px){
.col-md-5.user-info{
  margin-left: 3%;
}
}
@media screen and (max-width: 823px){
  .profile_pic{
    margin-top: 11px;
    height: 130px;
    width: 130px;
  }
  .text_child{
    font-size: 12px;
  }
  .text-item{
    font-size: 14px;
  }
  .dummy-user{
    width: 43%;
    height: 85px;
    float: right;
  }
}
@media screen and (max-width: 769px){
  .text-item{
    font-size: 14px;
  }
  .text_child{
    font-size: 12px;
  }
  .firm_logo{
    height: 130px !important;
    width: 130px !important;
  }
}
@media only screen and (max-width: 736px){
  .profile_pic{
    margin-top: 11px !important;
  }
  
table.border-none.table.table-responsive {
    margin-left: 9% !important;
}
.dummy-user{
  height: 130px !important;
  width: 130px !important;
}
}
@media screen and (max-width: 640px){
  table.border-none.table.table-responsive {
   margin-top: -3%;
}
.profile_pic{
    margin-top: 0 !important;
  }
  .name{
    font-size: 21px;
  }
  .text_child{
    font-size: 12px;
  }
  .text-item{
    font-size: 14px;
  }
  .profile_pic{
    height: 100px;
    width: 100px;
    margin-top: 14px;
  }
  .dummy-user{
    width: 47%;
    height: 73px;
  }
}
@media screen and (max-width: 568px){
  table.border-none.table.table-responsive {
   margin-top: unset;
   margin-left: 0;
}

  .profile_pic{
    width: 48%;
    height: 150px;
    margin-top: 0;
  }
  .border-none.table td{
    width: 1%;
  }
  .dummy-user{
    float: unset;
    width: 20%;
    height: 73px;
  
  }
  .col-md-5.user-info{
  margin-left: -49px;
}
.edit{
  float: unset;
}
.name2{
  margin: 0;
}
.name1{
  font-size: 18px;
}
}
@media screen and (max-width: 420px){
  .col-md-5.user-info {
    margin-left: -34px;
}
}
@media screen and (max-width: 375px){
  .col-md-5.user-info {
    margin-left: -36px;
}
}
@media screen and (max-width: 320px){
  .table td{
    font-size: 10px;
  }
  .col-md-5.col-sm-8.col-xs-6.user-info {
    margin-left: -11%;
}
.name{
  font-size: 14px;
}
}
 </style>
 <div class="container">
  <div class="row m-0">
        <div class="col-md-3 setmd">
            @include('dashboard.dashboard-sidebar')
        </div>
        <div class="col-md-9 setmd">
   <div class="note"><p style="font-size: 22px;">Agent<span style="color: #41ac1b"> Profile </span></p>
   </div>
  <div class="card">
        <div class="row margin-item" style="display: flex;">
             <div class="col-md-6 col-sm-6 col-xs-6 name2">
                <span class="name">{{ $user->fname}} @if(isset($user->lname)){{ $user->lname}} @endif</span>
            </div>    
             <div class="col-md-6 col-sm-6 col-xs-6 name2">
               <div class="name1"><a class="edit" href="{{url('agent-profile')}}" >
                        <i class="fa fa-fw fa-edit fa-2x "></i>
                      </a>
                      </div>
             </div>
         <!--   <div style="display: inline-flex;"> -->
            <div class="col-md-3 col-sm-2 col-xs-12"> 
             @if(isset($user->profile_pic))
             <img class="profile_pic" src="{{ asset('images/'.$user->profile_pic)}}" height="170" width="170">
             @else
             <img src="{{ asset('images/default/dummy-user.png')}}" height="170" width="170">
             @endif
            </div>
             <div class="col-md-5 col-sm-8 col-xs-6  user-info">
             <table class="border-none table table-responsive">
              <tbody>
             <tr>
              <td class="text-item"><i class="fas fa-envelope-open"></i> Email :</td>
              <td class="text_child">{{ $user->email }}</td>
             </tr>
             @if(isset($user->phone_no))
            <tr>
             <td class="text-item"><i class="fas fa-mobile-alt"></i>
              Phone :</td>
              <td class="text_child">{{ $user->phone_no }}</td>
            </tr>
          @endif
          <tr>
            <td class="text-item">Firm Profile :</td>
            <td class="text_child"><a style="color: green;" href="#"> {{ $user->realestate_firm}} </a></td>
          </tr>
          <tr>
            <td class="text-item">City :</td>
            <td class="text_child"> {{$user->city_name}}</td>
          </tr>
             </tbody>
           </table>
        </div>
        <div class="col-md-4 col-sm-5 col-xs-5 two_col" style="">
         @if(isset($user->firm_logo))
          <img class="firm_logo" src="{{ asset('images/'.$user->firm_logo)}}" style="width: 39%; height: 100px;">
          @else
          <img src="{{ asset('images/default/dummy-user.png')}}" class="dummy-user">
         @endif
        </div>
      </div>
    </div>
  </div>
 </div>
</div>

@endsection