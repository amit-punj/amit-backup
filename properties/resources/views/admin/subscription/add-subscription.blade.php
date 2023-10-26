@extends('admin.layouts.app')

@section('content')

<div id="content">
  <div id="content-header">
    <ul class="breadcrumb">
        <li><a href="{{ url('dashboard') }}">Home</a></li>                    
        <li class="active">Subscription</li>
    </ul>
    <h1>Add New Subscription</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="col-md-12">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Subscription</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-subscription') }}" name="basic_validate" id="add_subsciption" novalidate="novalidate">{{ csrf_field() }}
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Name</label>
                <div class="col-sm-10">
                  <input type="text" name="subsciption_name" id="subsciption_name"  class="form-control">
                   @if ($errors->has('subsciption_name'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('subsciption_name') }}</strong>
                            </span>
                        @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Description</label>
                <div class="col-sm-10">
                  <textarea type="text" name="subsciption_desc" id="subsciption_desc" class="form-control"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label">Month Price $</label>
                <div class="col-sm-10">
                  <input type="text" name="month_price" id="month_price" class="form-control"><p id="errmsg"></p>
                   @if ($errors->has('month_price'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('month_price') }}</strong>
                            </span>
                        @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label">Annual Price $</label>
                <div class="col-sm-10">
                  <input type="text" name="subsciption_price" id="subsciption_price" class="form-control"><p id="errmsg"></p>
                   @if ($errors->has('subsciption_price'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('subsciption_price') }}</strong>
                            </span>
                        @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Duration (Months)</label>
                <div class="col-sm-10">
                	<select name="subsciption_duration" id="subsciption_duration" class="form-control">
                		<option value="1">1 </option>
                		<option value="2">2 </option>
                		<option value="3">3 </option>
                		<option value="4">4 </option>
                    <option value="5">5 </option>
                    <option value="6">6 </option>
                    <option value="7">7 </option>
                    <option value="8">8 </option>
                    <option value="9">9 </option>
                    <option value="10">10 </option>
                    <option value="11">11 </option>
                    <option value="12">12 </option>
                	</select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Duration (Days)</label>
                <div class="col-sm-10">
                  <input type="number" name="days" id="days" min="1" class="form-control" value=""><p id="errmsg1"></p>
                </div>
              </div>
              <div class="form-actions">
                <input style="margin-left: 17%;" type="submit" value="Add New Subscription" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection