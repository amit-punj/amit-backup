@extends('admin.layouts.app')
@section('content')
<div style="margin-left: 10px;">
 <div class="card mb-4">
		<div class="card-body">
			<table class="table user-view-table m-0">
				<tbody>
				<div class="button" style="margin-top: 7%;">
				<h2>Buyer Detail</h2>
 			<div class="subbutton" style="float: right; margin-top: -5%; margin-right: 10px;">
				<a href='{{url("admin/edit/requirement/{$requirement->id}")}}' title="edit" class=" btn btn-primary"><i class="fas fa-user-edit"></i></a>
				<a href='{{ url("admin/delete/requirement/{$requirement->id}") }}' onclick="return confirm('Are you sure to delete this user?')"  class=" btn btn-danger" title="delete"><i class="fas fa-minus-circle"></i></a>
				</div>
				</div>
				  <?php  
                  $explode = explode(',', $requirement['amenities']);
                  $explode1 = explode(',', $requirement['building_features']);
                ?>
				<tr>
						<td>Title:</td>
						<td>{{ $requirement->title }}</td>
					</tr>
					<tr>
						<td>City</td>
						<td>{{ $requirement->city_name }}</td>
					</tr>
					<tr>
						<td>Property type</td>
						<td>{{ $requirement->property_type }}</td>
					</tr>
					<tr>
						<td>Purpose</td>
						<td>{{ $requirement->purpose }}</td>
					</tr>
					<tr>
						<td>Price-Minimum or Maximum</td>
						<td>${{ $requirement->min_price }} - {{ $requirement->max_price }}</td>
					</tr>
					<tr>
						<td>Purpose:</td>
						<td>{{ $requirement->purpose }}</td>
					</tr>
					<tr>
						<td>Min or Maximum rooms</td>
						<td>{{ $requirement->min_room}} to {{ $requirement->max_room }} Rooms</td>
					</tr>
					<tr>
						<td>All cash </td>
						<td>{{ $requirement->all_cash }}</td>
					</tr>
					<tr>
						<td>Exchange </td>
						<td>{{ $requirement->exchange }}</td>
					</tr>
					<tr>
						<td>Minimum bathroom </td>
						<td>{{ $requirement->min_bathroom }}</td>
					</tr>
					<tr>
						<td>Maximum bathroom </td>
						<td>{{ $requirement->max_bathroom }}</td>
					</tr>
					<tr>
						<td>All Cash</td>
						<td>{{ $requirement->all_cash }}</td>
					</tr>
					<tr>
						<td>Pre approved</td>
						<td>{{ $requirement->pre_approved }}</td>
					</tr>
					<tr>
						<td>Investment buyer</td>
						<td>{{ $requirement->investment_buyer }}</td>
					</tr>
					<tr>
						<td>Exchange</td>
						<td>{{ $requirement->exchange }}</td>
					</tr>
					<tr>
						<td>Description </td>
						<td>{{ $requirement->discription }}</td>
					</tr>
					@if(isset($abc))
					<tr>
						<td>Amenities </td>
						<td>
						<?php
							foreach ($amenities as $key => $value) {
								if(in_array($value->id, $explode))
								{
									$abc[]=  $value->amenities_name;
								}
							}
							echo implode(',', $abc);
						?>
						</td>
					</tr>
					@endif
					<tr>
						<td>Building features :</td>
						<td>
						<?php
							foreach ($building_features as $value2) {
								if(in_array($value2->id, $explode1))
								{
									$abcd[]=  $value2->feature_name;
								}
							}
							if(isset($abcd))
							{
							echo implode(',', $abcd);
						}
						else{
							echo"No Building features found!!!";
						}
						?>
						</td>
					</tr>
					
				</tbody>
			</table>
		</div>
	</div>
				
</div>
@endsection