@section('title','Dashboard')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Dashboard'])
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container bootom-space">
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
                    <div class="col-md-6 col-lg-3">
                      <div class="title">General Information</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-building fa-3x"></i>
                            <div class="info">
                                <h4>Buildings</h4>
                                <p><b>5</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small info coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Units</h4>
                                <p><b>25</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                            <div class="info">
                                <h4>Contracts</h4>
                                <p><b>10</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                            <div class="info">
                                <h4>Tenants</h4>
                                <p><b>500</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small warning coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Occupied units</h4>
                                <p><b>10</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Unoccupied units</h4>
                                <p><b>15</b></p>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-6 col-lg-2">
                      <div class="title">Revenue</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                            <div class="info">
                                <h4>Lifetime Revenue</h4>
                                <p><b>$50000</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small info coloured-icon"><i class="icon fa fa-usd fa-3x"></i>
                            <div class="info">
                                <h4>Average Revenue</h4>
                                <p><b>$2500</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                      <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">Last Booking Request</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Floor 1 </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon</a></td>
                                        <td>Accepted</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Floor 3 </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>Rejected</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Floor 13 </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>Rejected</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Floor 9 </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>Rejected</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Floor 80</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>Rejected</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">Pending Payments</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>Payment Day</th>
                                        <th>Payment For</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                         <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020 </td>
                                        <td>Rent</td>
                                        <td>$120</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                         <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020 </td>
                                        <td>Water Bill</td>
                                        <td>$120</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                         <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020 </td>
                                        <td>Rent</td>
                                        <td>$120</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                         <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020 </td>
                                        <td>Electric Bill</td>
                                        <td>$120</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                         <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020 </td>
                                        <td>Internet Bill</td>
                                        <td>$120</td>
                                    </tr>                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">Termination Request</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>U. Name</th>
                                        <th>Tenant</th>
                                        <th>C. Start Date</th>
                                        <th>C. End Date</th>
                                        <th>Termination Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020 </td>
                                        <td>07 September, 2020 </td>
                                        <td>07 September, 2020</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                    </tr>                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">Extend Request</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>C. Start Date</th>
                                        <th>C. End Date</th>
                                        <th>Extend Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                        <td>1 Month</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                        <td>1 Month</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020 </td>
                                        <td>07 September, 2020</td>
                                        <td>1 Year</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                        <td>1 Month</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>07 September, 2020</td>
                                        <td>1 Year</td>
                                    </tr>                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">Contract Near End</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                    </tr>               
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">Tickets</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Complete</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Complete</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Pending</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Complete</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Pending</td>
                                    </tr>      
                                </tbody>
                            </table>
                        </div>
                    </div>

                  </div>
                  <div class="row">
                                        <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">Leagle Actions</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>Action By</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>  
                      <div class="col-md-6">
                        <div class="tile tenant">
                            <h3 class="tile-title">New Tenants</h3>
                            <table class="table table-striped" id="tenant_table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></td>
                                        <td>Alex Jhon</td>
                                        <td>jhon@gmail.com</td>
                                        <td><a href="{{ url('tenant-details/1') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></td>
                                        <td>Alex Jhon</td>
                                        <td>jhon@gmail.com</td>
                                        <td><a href="{{ url('tenant-details/1') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></td>
                                        <td>Alex Jhon</td>
                                        <td>jhon@gmail.com</td>
                                        <td><a href="{{ url('tenant-details/1') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></td>
                                        <td>Alex Jhon</td>
                                        <td>jhon@gmail.com</td>
                                        <td><a href="{{ url('tenant-details/1') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></td>
                                        <td>Alex Jhon</td>
                                        <td>jhon@gmail.com</td>
                                        <td><a href="{{ url('tenant-details/1') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">Task</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Assign By</th>
                                        <th>Assign To</th>
                                        <th>Assign Date</th>
                                        <th>Related To</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Jhon Alex </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Complete</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Complete</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Pending</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Complete</td>
                                    </tr> 
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Lorem Ipsum is simply dummy text of the ...</td>
                                        <td>Pending</td>
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                    </div>
      <!--  -->
                  </div>
                </div>
            </div>
        </div> 
    <style type="text/css">
      .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
      .widget-small {display: -webkit-box; display: -ms-flexbox; display: flex; border-radius: 4px; color: #FFF; margin-bottom: 30px; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); }
      .widget-small .icon {display: -webkit-box; display: -ms-flexbox; display: flex; min-width: 50px; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; padding: 20px; background-color: rgba(0, 0, 0, 0.2); border-radius: 4px 0 0 4px; font-size: 2.5rem; }
      .widget-small .info {-webkit-box-flex: 1; -ms-flex: 1; flex: 1; padding: 0 20px; -ms-flex-item-align: center; align-self: center; }
      .widget-small .info h4 {text-transform: uppercase; margin: 0; margin-bottom: 5px; font-weight: 400; font-size: 1.1rem; }
      .widget-small .info p {margin: 0; font-size: 16px; }
      .widget-small.primary {background-color: #009688; }
      .widget-small.primary.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767;; color: #2a2a2a; }
      .widget-small.primary.coloured-icon .icon {background-color: #009688; color: #fff; }
      .widget-small.info {background-color: #17a2b8; }
      .widget-small.info.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
      .widget-small.info.coloured-icon .icon {background-color: #17a2b8; color: #fff; }
      .widget-small.warning {background-color: #ffc107; }
      .widget-small.warning.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
      .widget-small.warning.coloured-icon .icon {background-color: #ffc107; color: #fff; }
      .widget-small.danger {background-color: #dc3545; }
      .widget-small.danger.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
      .widget-small.danger.coloured-icon .icon {background-color: #dc3545; color: #fff; }
      .title {font-size: 20px; }
      .tile { box-shadow: 2px 2px 4px #756767; padding: 15px; margin-bottom: 15px; border-radius: 3px; }
      .tile.tenant img {border-radius: 50%; }
      .tile.tenant a span {color: black; }
      table#tenant_table td {vertical-align: middle; }
      .messanger {display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-orient: vertical; -webkit-box-direction: normal; -ms-flex-direction: column; flex-direction: column; }
      .messanger .messages {-webkit-box-flex: 1; -ms-flex: 1; flex: 1; margin: 10px 0; padding: 0 10px; max-height: 260px; overflow-y: auto; overflow-x: hidden; }
      .messanger .messages .message {display: -webkit-box; display: -ms-flexbox; display: flex; margin-bottom: 15px; -webkit-box-align: start; -ms-flex-align: start; align-items: flex-start; }
      .messanger .messages .message.me {-webkit-box-orient: horizontal; -webkit-box-direction: reverse; -ms-flex-direction: row-reverse; flex-direction: row-reverse; }
      .messanger .messages .message.me img {margin-right: 0; margin-left: 15px; }
      .messanger .messages .message.me .info {background-color: #f48400; color: #FFF; }
      .messanger .messages .message.me .info:before {display: none; }
      .messanger .messages .message.me .info:after {position: absolute; right: -13px; top: 0; content: ""; width: 0; height: 0; border-style: solid; border-width: 0 16px 16px 0; border-color: transparent #f48400 transparent transparent; -webkit-transform: rotate(270deg); -ms-transform: rotate(270deg); transform: rotate(270deg); }
      .messanger .messages .message img {border-radius: 50%; margin-right: 15px; }
      .messanger .messages .message .info {margin: 0; background-color: #ddd; padding: 5px 10px; border-radius: 3px; position: relative; -ms-flex-item-align: start; align-self: flex-start; }
      .messanger .messages .message .info:before {position: absolute; left: -14px; top: 0; content: ""; width: 0; height: 0; border-style: solid; border-width: 0 16px 16px 0; border-color: transparent #ddd transparent transparent; }
      .messanger .sender {display: -webkit-box; display: -ms-flexbox; display: flex; }
      .messanger .sender input[type="text"] {-webkit-box-flex: 1; -ms-flex: 1; flex: 1; border: 1px solid #a6a9a8; outline: none; padding: 5px 10px; }
      .messanger .sender button {border-radius: 0; }
      table td a {color: black; }
    </style>
@endsection