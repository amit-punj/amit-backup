@extends('admin.layouts.app')
@section('content')

<div id="content">
  <div id="content-header">
    <ul class="breadcrumb">
        <li><a href="{{ url('dashboard') }}">Home</a></li>                    
        <li class="active">Subscription</li>
    </ul>
    <h1>Edit Subscription</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="col-md-12">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Subscription</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-subscription/'.$SubscriptionDetails->id) }}" name="basic_validate" id="edit_category" novalidate="novalidate">{{ csrf_field() }}
              <div class="form-group row">
                <label class="col-sm-2 control-label">Subscription Name</label>
                <div class="col-sm-10">
                  <input type="text" name="subsciption_name" id="subsciption_name" class="form-control" value="{{ $SubscriptionDetails->name }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea type="text" name="subsciption_desc" id="subsciption_desc" class="form-control">{{ $SubscriptionDetails->description }}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label">Month Price $</label>
                <div class="col-sm-10">
                  <input type="text" name="month_price" id="month_price" value="{{ $SubscriptionDetails->month_price }}" class="form-control"><p id="errmsg"></p>
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
                  <input type="text" name="subsciption_price" id="subsciption_price" class="form-control" value="{{ $SubscriptionDetails->price }}"><p id="errmsg"></p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Duration (Months)</label>
                <div class="col-sm-10">
                  <select name="subsciption_duration" id="subsciption_duration" class="form-control">
                    <option {{ ($SubscriptionDetails->duration  == 0)?'selected="selected"' : ''}} value="0">0 </option>
                    <option {{ ($SubscriptionDetails->duration  == 1)?'selected="selected"' : ''}} value="1">1 </option>
                    <option {{ ($SubscriptionDetails->duration  == 2)?'selected="selected"' : ''}} value="2">2 </option>
                    <option {{ ($SubscriptionDetails->duration  == 3)?'selected="selected"' : ''}} value="3">3 </option>
                    <option {{ ($SubscriptionDetails->duration  == 4)?'selected="selected"' : ''}} value="4">4 </option>
                    <option {{ ($SubscriptionDetails->duration  == 5)?'selected="selected"' : ''}} value="5">5 </option>
                    <option {{ ($SubscriptionDetails->duration  == 6)?'selected="selected"' : ''}} value="6">6 </option>
                    <option {{ ($SubscriptionDetails->duration  == 7)?'selected="selected"' : ''}} value="7">7 </option>
                    <option {{ ($SubscriptionDetails->duration  == 8)?'selected="selected"' : ''}} value="8">8 </option>
                    <option {{ ($SubscriptionDetails->duration  == 9)?'selected="selected"' : ''}} value="9">9 </option>
                    <option {{ ($SubscriptionDetails->duration  == 10)?'selected="selected"' : ''}} value="10">10 </option>
                    <option {{ ($SubscriptionDetails->duration  == 11)?'selected="selected"' : ''}} value="11">11 </option>
                    <option {{ ($SubscriptionDetails->duration  == 12)?'selected="selected"' : ''}} value="12">12 </option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Duration (Days)</label>
                <div class="col-sm-10">
                  <input type="number" name="days" id="days" min="1" class="form-control" value="{{ $SubscriptionDetails->agent }}"><p id="errmsg1"></p>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Subscription" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection