@extends('layouts.main')
@section('content')
<style type="text/css">
.note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
.project-tab {
   
   margin-top: 1%;
}
.project-tab #tabs{
    background: #007b5e;
    color: #eee;
}
.project-tab #tabs h6.section-title{
    color: #eee;
}
.project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: green;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 3px solid !important;
    font-size: 16px;
    font-weight: bold;
}
.project-tab .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #0f2b61;
    font-size: 16px;
    font-weight: 600;
}
.project-tab thead{
    background: #f3f3f3;
    color: #333;
}
.project-tab a{
    text-decoration: none;
    color: #333;
    font-weight: 600;
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
    #rmhov a:hover {
    color: black;
}
ul.pagination{
    justify-content: center;
}
.despflex{
  display: flex;
  margin-left: -5%;
}
@media screen and (max-width: 420px){
        td{
            font-size: 12px;
        }
        th{
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
		 @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
         @endif
          @if(Session::has('flash_message_delete'))
                    <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_delete') !!}</strong>
                    </div>
         @endif
				 <div class="note"><p style="font-size: 22px;">  My  <span style="color: #41ac1b">  Search  </span> List </p>
		         </div>

		    <!-- tabs -->
		    <section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                               <div class="col-6">
                                <a class="nav-item nav-link"  href="{{ url('agent/search_list/data')}}" role="tab" aria-controls="nav-home" aria-selected="true">Property</a>
                                </div>
                                <div class="col-6">
                                <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Buyers</a>
                                </div>
                            </div>
                        </nav>
                            <div>
                            @if(count($search_data_buyers))
            <div class="table-responsive">
            <table class="table table-striped" id="rmhov">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>URL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $i= 1; ?>
                        @foreach($search_data_buyers as $data)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{substr($data->title,0,21)}}..</td>
                                <td><a href="{{ $data->url }}"> {{ substr($data->url,0,15)}}...</a></td>
                                <td class="despflex">
                                 <a href="{{ $data->url }}" class="btn btn-default btn-xs" style="font-size: 17px; color: green;" ><i class="fas fa-eye"></i></a>
                                    <a href="{{ url('agent/edit/data/search/'.$data->id)}}" class="btn btn-default btn-xs" style="font-size: 17px; color: green;" ><i class="fa fa-pencil-square"></i></a>
                                    <a href='{{ url("agent/delete/search/$data->id")}}' onclick="return confirm('Are you sure to delete this Buyer Listing?')"  class=" btn btn-default btn-xs" style="font-size: 17px; color: green;" title="delete"><i class="fas fa-minus-circle"></i></a>
                                    
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      </table>  
                              <div> 
                                 {!! $search_data_buyers->render() !!}
                            </div>    
                            @else
                             No Data found 
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	 
		</div>
	</div>
</div>
@endsection