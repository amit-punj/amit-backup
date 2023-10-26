@extends('admin.layouts.app')
@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB --> 

<div class="page-content-wrap">
	<!-- START WIDGETS -->                    
	<div class="row">
		<div class="col-md-3">
			<!-- START WIDGET SLIDER -->
			<div class="widget widget-default widget-carousel">
				<div class="owl-carousel" id="owl-example">
					<div>                                    
						<div class="widget-title">Total Users</div>
						<div class="widget-int">{{$total_properties}}</div>
					</div>
					<div>                                    
						<div class="widget-title">Total Agents</div>
						<div class="widget-int">{{$total_agents}}</div>
					</div>
					<div>                                    
						<div class="widget-title">Total Customers</div>
						<div class="widget-int">{{$total_customers}}</div>
					</div>
				</div>                            
				<div class="widget-controls">                                
					<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
				</div>                             
			</div>         
			<!-- END WIDGET SLIDER -->
		</div>
		<div class="col-md-3">
			<!-- START WIDGET MESSAGES -->
			<div class="widget widget-default widget-item-icon" onclick="location.href=\'{{ url("/admin/simpleagents")}}\';">
				<div class="widget-item-left">
					<span class="fa fa-asterisk"></span>
				</div>                             
				<div class="widget-data">
					<div class="widget-int num-count">{{$total_requirements}}</div>
					<div class="widget-title">Total Requirements</div>
					<div class="widget-subtitle">On your website</div>
				</div>      
				<div class="widget-controls">                                
					<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
				</div>
			</div>                            
			<!-- END WIDGET MESSAGES -->
		</div>
		<div class="col-md-3">
			<!-- START WIDGET REGISTRED -->
			<div class="widget widget-default widget-item-icon" onclick="location.href=\'{{ url("/admin/customers")}}\';">
				<div class="widget-item-left">
					<span class="fa fa-home"></span>
				</div>
				<div class="widget-data">
					<div class="widget-int num-count">{{$total_properties}}</div>
					<div class="widget-title">Total Properties</div>
					<div class="widget-subtitle">On your website</div>
				</div>
				<div class="widget-controls">                                
					<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
				</div>                            
			</div>                            
			<!-- END WIDGET REGISTRED -->
		</div>
		<div class="col-md-3">
			<!-- START WIDGET CLOCK -->
			<div class="widget widget-danger widget-padding-sm">
				<div class="widget-big-int plugin-clock">00:00</div>                            
				<div class="widget-subtitle plugin-date">Loading...</div>
				<div class="widget-controls">                                
					<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
				</div>                            
				<div class="widget-buttons widget-c3">
					<div class="col">
						<a href="#"><span class="fa fa-clock-o"></span></a>
					</div>
					<div class="col">
						<a href="#"><span class="fa fa-bell"></span></a>
					</div>
					<div class="col">
						<a href="#"><span class="fa fa-calendar"></span></a>
					</div>
				</div>                            
			</div>                        
			<!-- END WIDGET CLOCK -->
		</div>
	</div>
	<!-- END WIDGETS -->                    
</div>
@endsection