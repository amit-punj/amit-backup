 <table class="table table-striped table-responsive">
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
                @if(count($data))
                  <?php $number=0; $i=01111; $p= 108; ?>
                  @foreach($data as $key => $lists)
                  <?php $number++; $i++; $p++; ?>
                  <tr>
                    <th scope="row">{{ $number }}</th>
                    <td>{{ $lists->title }}</td>
                    <td> {{$lists->min_price}} - {{ $lists->max_price }} </td>
                    <td> {{$lists->local_area}} </td>
                    <td style="display: inline-flex;">
                          <button  data-toggle="collapse" data-target="#demo{{ $i }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-plus-circle" style="color: green; font-size: 17px;"></i>
                          </button>
                          <a href="{{ url('requirement/detail/pub/'.$lists->id)}}" class="btn btn-default btn-xs" style="font-size: 17px; color: green !important;" href="#"><i class="fas fa-eye"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="12" class="hiddenRow">
                      <div class="accordian-body collapse" id="demo{{ $i }}"> 
                          <table class="table table-dark table-responsive">
                              <thead>
                                <tr>
                                  <th>Address</th>
                                  <th>Property Type</th>
                                  <th>Type</th>
                                  <th>exchange</th>
                                  <th>All Cash</th>
                                  <th>Bathroom</th>
                                  <th>Rooms</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>{{$lists->city_name}}</td>
                                  <td> {{ Str::ucfirst($lists->property_type) }} </td>
                                  <td>{{ Str::ucfirst($lists->purpose) }}</td>
                                  <td>{{$lists->exchange}}</td>
                                  <td>{{ Str::ucfirst($lists->all_cash)}}</td>
                                  <td>{{$lists->min_bathroom}} - {{ $lists->max_bathroom }}</td>
                                  <td>{{$lists->min_room}} - {{$lists->max_room}}</td>
                                </tr>
                            </tbody>
                          </table>
                      </div>
                    </td>
                  </tr>

        <!-- Related properties -->
        
    @endforeach
  </tbody>
</table>
</div>
{!! $data->render() !!}
        <!-- Related properties -->
                     
    
    @else
    No Requirement found!!!
    @endif