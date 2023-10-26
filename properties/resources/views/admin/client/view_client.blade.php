<style type="text/css">
* {
  box-sizing: border-box;
}
body {
  margin: 0;
  font-family: Arial;
}

/* The grid: Four equal columns that floats next to each other */
.column {
    display: inline-flex;
    width: 25%;
    padding: 10px;
}

/* Style the images inside the grid */
.column img {
  opacity: 0.8; 
  cursor: pointer; 
}

.column img:hover {
  opacity: 0.3;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* The expanding image container */
.container {
  position: relative;
  display: none;
}

/* Expanding image text */
#imgtext {
  position: absolute;
  bottom: 15px;
  left: 15px;
  color: white;
  font-size: 20px;
}

/* Closable button inside the expanded image */
.closebtn {

       margin-left: -9%;
    /* margin-left: -77%; */
    color: red;
    position: absolute;
    font-size: 15px;
    cursor: pointer;
}
</style>
@extends('admin.layouts.app')
@section('content')
<div style="margin-left: 10px;">
 <div class="card mb-4">
		<div class="card-body">
			<table class="table user-view-table m-0">
				<tbody>
				<div class="button" style="margin-top: 7%;">
				<h2>Client Detail</h2>
					<tr>
						<td>Username:</td>
						<td>{{ $slider_detail->username }}</td>
					</tr>
					<tr>
						<td>First Name:</td>
						<td>{{ $slider_detail->fname }}</td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td>{{ $slider_detail->lname }}</td>
					</tr>
					<tr>
						<td>Email:</td>
						<td>{{ $slider_detail->email }}</td>
					</tr>
					<tr>
						<td>Mobile No:</td>
						<td>{{ $slider_detail->mobile }}</td>
					</tr>
					<tr>
						<td>Client Image:</td>
						<td>
						<?php 
							$profile = $slider_detail->client_image;
	                        if(!isset($profile) || is_null($profile) || $profile == "" )
	                        {
	                            $profile = "no-image.jpg"; 
	                        }
						?>
							<img src='{{ asset("images/client/{$profile}") }}' alt="Client" style="width:200px;height: 200px"">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
				
</div>
@endsection