@extends('admin.layouts.main')

@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                    Poi List
                        <span class="float-right">
                            <a href='{{ url("admin/tours") }}'>Back To Tour List</a>
                            <a href='{{ url("admin/tours/{$tour->id}/add_poi") }}'>
                                <button class="btn btn-success">Add New</button>
                            </a>
                        </span>
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <div class="clearfix"></div>
                    @if(count($poi_details))
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th>#</th>
                                <th>Tour Name</th>
                                <th>Poi Name</th>
                                <th>Poi Type</th>
                                <th>Make Default</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach($poi_details as $poi)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$tour->tour_name}}</td>
                                        <td>{{$poi->poi_name}}</td>
                                        <td>{{$poi->content_type}}</td>
                                        <td>
                                            <label class="switch">
                                              <input class="status" data-id="{{ $poi->id }}" type="checkbox" <?php if($poi->default_poi == 1) echo 'checked'; ?> >
                                              <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>{{$poi->created_at}}</td>
                                        <td>
                                            <a href='{{ url("admin/tours/{$poi->id}/edit_poi") }}' title="Edit" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href='{{ url("admin/tours/{$poi->id}/delete_poi") }}' onclick="return confirm('Are you sure to delete this Poi?')" title="Delete" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p>No Poi found here !</p>
                    @endif

                </div>
            </div>
            <!-- END WIDGETS -->
        </div>
    </div>

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function()
  {    
      $(".status").click(function(){
      var id = $(this); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var status = 0;
        var ids = $(this).data('id');
        var tour_id = '{{$tour->id}}';
        if ($(this).prop('checked') ) 
        {
            status = 1;
        }
            $.ajax(
            {
                url: "{{url('admin/tours/default_poi')}}",
                type: "post",
                data: {'id':ids,'tour_id':tour_id,'status':status },
                success : function(data) { 
                  var myJSON = JSON.parse(data); 
                  console.log(myJSON);                
                    if(myJSON.response > "0")
                    {
                        $(".status").prop("checked", false);
                        if(status == 1){
                            $(id).prop("checked", true);
                        }
                      // $("#btnsub").prop('disabled', true);
                      // $('#search_eroor').text("You have already Active Search bar, Please InActive first!");
                    }                     
                },
                error : function(data) {
                }
            });
        
      });
  });
</script>
@endsection
