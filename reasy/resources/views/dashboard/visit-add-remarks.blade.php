@section('title','Create Unit')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Add Remark'])
	<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 mb-20">
            	<form method="POST" action="{{ url('/visit/add-remarks/19') }}" id="visit_add_remark">
        	        @csrf
            		<div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Visit Status *') }}</label>
                        <div class="col-md-6">
                            <select name="status" id="status" required="" class="form-control @error('status') is-invalid @enderror status">
                                <!-- <option value="">Select Status</option> -->
                                <option value="unit">Upcoming</option>
                                <option value="building">Completed</option>
                                <option value="cancel">Cancel</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark *') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('remark') is-invalid @enderror remark" name="remark" required="" rows="5" cols="50" placeholder="Add Remark">{{ old('remark','Add Remarks') }}</textarea>
                            @error('remark')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    <div class="form-group row">
                    	<label for="type" class="col-md-4 col-form-label text-md-right"></label>
                        <div class=" col-md-6 btn-group btn-group-lg" >
                            <button class="btn btn-primary btn-lg" type="Submit">Add</button>
                        </div>
                    </div>
            	</form>
            </div>
        </div>
    </div>
    
<script type="text/javascript">
	jQuery('#visit_add_remark').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            status:{
                required:true,
            },
            remark:{
                required:true,
            }
        }      
    });
</script>
@endsection