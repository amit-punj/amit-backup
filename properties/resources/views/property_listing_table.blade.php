
     @if(isset($data))
         <table id="tag_container" class="table table-striped table-responsive">
				                <thead>
				                  <tr>
				                    <th scope="col">#</th>
				                    <th scope="col">Title</th>
				                    <th scope="col">Price</th>
                                    <th scope="col">Neighborhood</th>
				                    <th scope="col">Action</th>
				                  </tr>
				                </thead>
                    <tbody>
			           
			                  <?php $x=0; ?>
			                  @foreach($data as $key => $properties)
			                  <?php $x++; ?>
			                  <tr>
			                    <th scope="row">{{ $x }}</th>
                          <td>{{ $properties->title }}</td>
			                    <td>{{ number_format($properties->price,2) }} </td>
                          <td> {{$properties->local_area}} </td>
			                    <td class="despflex"><button data-toggle="collapse" data-target="#demo{{ $x }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-plus-circle" style="color: green; font-size: 20px;"></i></button>
			                    <a href="{{url('property/detail/pub/'.$properties->id)}}" class="btn btn-default btn-xs" style="font-size: 20px; color: green !important;" href="#"><i class="fas fa-eye"></i></a>
			                    </td>
			                  </tr>
			                  <tr>
			                  <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo{{ $x }}"> 
			                    <table class="table table-striped table-dark table-responsive">
			                            <thead>
                                    <tr><th> Address </th>
			                              <th scope="col"> Property Type </th>                                      
                                    <th> Purpose </th>
                                    <th> exchange </th>
                                    <th> All Cash </th>
                                    <th> Bathroom </th>
                                    <th> Rooms </th></tr>
			                            </thead>
			                            <tbody class="table-text">
			                              <tr>

                                      <td>{{$properties->city_name}}</td>
                                      <td> {{ Str::ucfirst($properties->property_type) }} </td>
                                      <td>{{ str_replace('_', ' ', $properties->purpose)}}</td>
                                      <!-- <td>{{ Str::ucfirst($properties->purpose) }}</td> -->
                                      <td>{{$properties->exchange}}</td>
                                      <td>{{ Str::ucfirst($properties->all_cash)}}</td>
                                      <td>{{$properties->bathroom}}</td>
                                      <td> {{$properties->rooms}}</td>
                                    </tr>
			                      </tbody>
			                </table>
              
				              </div>
				              </td>
				        </tr>
    @endforeach
  </tbody>
</table>
{!! $data->render() !!}
@else
No property Found!!
@endif
          