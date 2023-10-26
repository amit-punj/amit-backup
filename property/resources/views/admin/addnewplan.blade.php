@extends('adminlayouts.app')

@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Add New Plan</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item"><a href="{{url('/admin/addnewplan')}}">Add New Plan</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <!-- <h3 class="tile-title">Vertical Form</h3> -->
            <div class="tile-body">
              @if(session()->has('message'))
                  <div class="alert alert-success">
                      {{ session()->get('message') }}
                  </div>
              @endif
              <form method="post" action="{{url('/admin/addnewplan')}}" id="create_plan">
              	@csrf
                <div class="form-group">
                  <label class="control-label">Title</label>
                  <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Full Title" name="title" value="{{ old('title') }}" autocomplete="title">
                    @if ($errors->has('title'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('title') }} </strong>
                       </span>
                   @endif
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Status</label>
                    <select class="form-control" name="status" value="{{ old('status') }}" autocomplete="status">
                      <option value="1">Enable</option>
                      <option value="0">Disable</option>
                    </select>
                    @if ($errors->has('status'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('status') }} </strong>
                       </span>
                   @endif
                </div>

                <div class="form-group">
                    <label for="plan_type">Plan Type</label>
                    <select class="form-control" name="plan_type" value="{{ old('plan_type') }}" autocomplete="plan_type">
                      <option value="Paid">Paid</option>
                      <option value="Trail">Trail</option>
                    </select>
                    @if ($errors->has('plan_type'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('plan_type') }} </strong>
                       </span>
                   @endif
                </div>

                <div class="form-group">
                  <label class="control-label">Plan Time Period</label>
                  <select class="form-control" name="time_period_type" value="{{ old('time_period_type') }}" autocomplete="time_period_type" id="time_period_type">
                      <option value="">Select Time</option>
                      <option value="monthly">Monthly Basis</option>
                      <option value="yearly">Yearly Basis</option>
                    </select>
                   @if ($errors->has('time_period_type'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('time_period_type') }} </strong>
                       </span>
                   @endif
                </div>
                <div class="form-group" id="number_of_months">
                  <label class="control-label">Select Number of Months</label>
                  <select class="form-control" name="number_of_months" value="{{ old('number_of_months') }}" autocomplete="number_of_months">
                      <option value="1">1 Month</option>
                      <option value="2">2 Months</option>
                      <option value="3">3 Months</option>
                      <option value="4">4 Months</option>
                      <option value="5">5 Months</option>
                      <option value="6">6 Months</option>
                      <option value="7">7 Months</option>
                      <option value="8">8 Months</option>
                      <option value="9">9 Months</option>
                      <option value="10">10 Months</option>
                    </select>
                   @if ($errors->has('number_of_months'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('number_of_months') }} </strong>
                       </span>
                   @endif
                </div>
                <div class="form-group" id="number_of_years">
                  <label class="control-label">Select Number of Years</label>
                  <select class="form-control" name="number_of_years" value="{{ old('number_of_years') }}" autocomplete="number_of_years">
                      <option value="1">1 Year</option>
                      <option value="2">2 Years</option>
                      <option value="3">3 Years</option>
                      <option value="4">4 Years</option>
                      <option value="5">5 Years</option>
                    </select>
                   @if ($errors->has('number_of_years'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('number_of_years') }} </strong>
                       </span>
                   @endif
                </div>


                <div class="form-group">
                  <label class="control-label">Price</label>
                  <input class="form-control" type="text" placeholder="Enter Price" name="price" value="{{ old('price') }}" autocomplete="price">
                   @if ($errors->has('price'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('price') }} </strong>
                       </span>
                   @endif
                </div>
                <div class="form-group">
                  <label class="control-label">Short Description</label>
                  <textarea id="" class="form-control" name="short_description" rows="4" placeholder="Enter your content" name="short_description" value="{{ old('short_description') }}" autocomplete="price">{{ old('short_description') }}</textarea>
                  @if ($errors->has('short_description'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('short_description') }} </strong>
                       </span>
                   @endif
                </div>
                <div class="form-group">
                  <label class="control-label">Features</label>
                  <textarea id="features" class="form-control" name="features" rows="4" placeholder="Enter your content" name="features" value="{{ old('features') }}" autocomplete="price">{{ old('features') }}</textarea>
                  @if ($errors->has('features'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('features') }} </strong>
                       </span>
                   @endif
                </div>
                <div class="form-group">
                  <label class="control-label">Description</label>
                  <textarea id="add_cms_content" class="form-control" name="description" rows="4" placeholder="Enter your content" value="{{ old('description') }}" autocomplete="description">{{ old('description') }}</textarea>
                  @if ($errors->has('description'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('description') }} </strong>
                       </span>
                   @endif
                </div>
                 <div class="tile-footer">
	              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
	            </div>
              </form>
            </div>
           
          </div>
        </div>
        <div class="clearix"></div>
      </div>
      <style>
        .popover-content.note-children-container {display: none; }
        div#number_of_months, div#number_of_years {display: none; }
        .form-group label.red {color: red; }

      </style>
      <script type="text/javascript">
          jQuery(document).ready(function(){
              jQuery('#time_period_type').click(function(){
                  if(jQuery(this).val() == 'monthly'){
                      jQuery('#number_of_months').show();
                      jQuery('#number_of_years').hide();
                  } else if(jQuery(this).val() == 'yearly'){
                      jQuery('#number_of_months').hide();
                      jQuery('#number_of_years').show();
                  } else {
                      jQuery('#number_of_months').hide();
                      jQuery('#number_of_years').hide();
                  }
              });
          });
          jQuery('#create_plan').validate({
              errorClass:"red",
              validClass:"green",
              rules:{
                  title:{
                    required:true,
                     minlength:4,
                  },
                  time_period_type:{
                    required:true,
                  },
                  price:{
                    required:true,
                    number: true,
                  },
                  features:{
                    required:true,
                  },
                  short_description:{
                    required:true,
                  },
                  description:{
                    required:true,
                  }
              }      
          });
      </script>
      <script type="text/javascript">
      $(document).ready(function() {
           $('#features').summernote({
             height:100,
           });
       });
    </script>
    </main>
@endsection
