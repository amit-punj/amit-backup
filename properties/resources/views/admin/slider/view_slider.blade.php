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
				<h2>Slider Detail</h2>
					<tr>
						<td>Title:</td>
						<td>{{ $slider_detail->title }}</td>
					</tr>
					<tr>
						<td>Description:</td>
						<td>{{ $slider_detail->description }}</td>
					</tr>
					<tr>
						<td>Search Bar:</td>
						<td>
							@if($slider_detail->search_bar == 1)
								Yes
							@else
								No
							@endif
						</td>
					</tr>
					<tr>
						<td>Slider Image:</td>
						<td>
							<img src='{{ asset("images/slider/{$slider_detail->slider_image}") }}' alt="Slider" style="width:200px;height: 200px"">
						</td>
					</tr>
					<tr>
						<td>Status:</td>
						<td>
							{{ $slider_detail->status }}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
				
</div>
@endsection