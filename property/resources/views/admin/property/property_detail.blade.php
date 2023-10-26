 @extends('adminlayouts.app')
@section('content')
<main class="app-content">
      <div class="app-title"><h3>Building Detail</h3>
       </div>
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
                    <div class="col-sm-6">
                        <div class="Building-title">Building Details</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="add-unit-main">
                            <a class="btn btn-success" href="{{ url()->previous() }}">Back</a>
                            <a class="btn btn-success" href="{{ url('edit-building-admin/'.$buildingDetail->id) }}">Update Building</a>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                            <div class="unit"><span>Building Name : </span> {{ $buildingDetail->unit_name}}</div>
                            <div class="unit"><span>Address : </span>  {{ $buildingDetail->address}}</div>
                            <div class="unit"><span>Description : </span> {{ $buildingDetail->description}}</div>

                            <div class="unit"><span>Property Manager : </span> 
                                {{ $propertyManager->name." ".$propertyManager->last_name}} 
                            </div>
                            <div class="unit"><span>Property Description Experts : </span> 
                                {{ $propertyDescriptionExperts->name." ".$propertyDescriptionExperts->last_name}} 
                            </div>
                            <div class="unit"><span>Legal Advisor : </span> 
                                {{ $propertyLegalAdvisor->name." ".$propertyLegalAdvisor->last_name}} 
                            </div>
                            <div class="unit"><span>Visit Organizer : </span> 
                                {{ $propertyVisitOrganizer->name." ".$propertyVisitOrganizer->last_name}} 
                            </div>

                            <div class="unit"><h4>Building Rules </h4> </div>
                            <div class="unit rules">
                                <span>Registration Possible : </span> {{ $buildingDetail->registration_possible}} 
                            </div>
                            <div class="unit rules">
                                <span>Cleaning Common Room Incl : </span> {{ $buildingDetail->cleaning_commonc_room_incl}} 
                            </div>
                            <div class="unit rules">
                                <span>Cleaning Private Room Incl : </span> {{ $buildingDetail->cleaning_private_room_incl}} 
                            </div>
                            <div class="unit rules">
                                <span>Animal Allowed : </span> {{ $buildingDetail->animal_allowed}} 
                            </div>
                            <div class="unit rules">
                                <span>Play Musical Instrument : </span> {{ $buildingDetail->play_musical_instrument}} 
                            </div>
                            <div class="unit rules">
                                <span>Smoking Allowed : </span> {{ $buildingDetail->smoking_allowed}} 
                            </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-6">
                        <div class="Building-Units">Building Units</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="add-unit-main">
                            <a class="btn btn-success" href="{{ url('create-property-admin?building='.$buildingDetail->id)}}">Create Unit <span class="glyphicon glyphicon-plus"></span></a>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    @if(count($buildingUnits) > 0)
                    @foreach ($buildingUnits as $unit)
                    <div class="col-sm-4">
                        <div class="unit-body">
                            <div class="unit-delete delete"><a href="{{ url('delete-unit/'.$unit->id) }}"><span class="glyphicon glyphicon-trash"></span></a></div>
                            <div class="unit-delete">
                                <a href="{{ url('edit-unit/'.$unit->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
                            </div>
                            <div class="unit rules"> <span>Unit Type :</span> {{ $unit->u_type }}</div>
                            <div class="unit"><span>Unit Name : </span> {{ $unit->unit_name }} </div>
                            <div class="unit"><span>Rent : </span> {{ App\Helpers\Helper::CURRENCYSYMBAL.$unit->rent }} </div>
                            <div class="unit"><span>Deposit : </span> {{ App\Helpers\Helper::CURRENCYSYMBAL.$unit->deposit }} </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-sm-12">
                        <div class="not_found">Not Found Any Unit</div>
                    </div>
                    @endif
                </div>                                            
            </div>
        </div>
    </div> 
</main>    
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.delete a').click(function(e){
                e.preventDefault();
               var href      = jQuery(this).attr('href');
               var result = confirm("Want to Delete Unit?");
               if (result) {
                   window.location = href;
               }
            }); 
        });
    </script>
    <style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #349688; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit-body span {font-size: 15px; font-weight: bold; color: #349688; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .add-unit-main {text-align: right; margin-top: 20px;}
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .unit span {font-weight: bold; }
        .unit.rules {text-transform: capitalize; } 
        .add-unit-main {text-align: right; margin-top: 20px; }
        .not_found {padding: 15px; }
    </style>
@endsection    