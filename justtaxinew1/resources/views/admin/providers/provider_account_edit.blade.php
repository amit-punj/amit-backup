<form class="form-horizontal" method="POST" action="{{ route('admin.provider.account') }}" id="create_propert_form3">
    {{ csrf_field() }}
    <input type="hidden" value="{{$id}}" name="provider_id">
    <div class="form-group row">
        <label class="col-sm-3 control-label">Account Number</label>
        <div class="col-sm-8">
            <input type="number" min="0" name="account" class="form-control" id="account" value="{{ $providerAccount->bank_account ? $providerAccount->bank_account : '' }}">
            <span class="errors" id="a_error_account"></span>
            @if ($errors->has('account'))
                <span class="help-inline">
                    <strong>{{ $errors->first('account') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label">Bank Name</label>
        <div class="col-sm-8">
            <input type="text" name="bank_name" class="form-control" id="bank_name" value="{{ $providerAccount->bank_name ? $providerAccount->bank_name : '' }}">
            <span class="errors" id="a_error_bank_name"></span>
            @if ($errors->has('bank_name'))
                <span class="help-inline">
                    <strong>{{ $errors->first('bank_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label">Branch Name</label>
        <div class="col-sm-8">
            <input type="text" name="branch_name" class="form-control" id="branch_name" value="{{ $providerAccount->branch_name ? $providerAccount->branch_name : '' }}">
            <span class="errors" id="a_error_branch_name"></span>
            @if ($errors->has('branch_name'))
                <span class="help-inline">
                    <strong>{{ $errors->first('branch_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label">Branch Code</label>
        <div class="col-sm-8">
            <input type="text" name="branch_code" class="form-control" id="branch_code" value="{{ $providerAccount->branch_code ? $providerAccount->branch_code : '' }}">
            <span class="errors" id="a_error_branch_code"></span>
            @if ($errors->has('branch_code'))
                <span class="help-inline">
                    <strong>{{ $errors->first('branch_code') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label">IFSC Code</label>
        <div class="col-sm-8">
            <input type="text" name="ifsc_code" class="form-control" id="ifsc_code" value="{{ $providerAccount->ifsc_code ? $providerAccount->ifsc_code : '' }}">
            <span class="errors" id="a_error_ifsc_code"></span>
            @if ($errors->has('ifsc_code'))
                <span class="help-inline">
                    <strong>{{ $errors->first('ifsc_code') }}</strong>
                </span>
            @endif
        </div>
    </div>                          
    <div class="form-actions" style="text-align: center">
      <input type="submit" value="Save Account" id="next3" class="btn btn-success">
    </div>
</form>

<script type="text/javascript">

    $("#create_propert_form3").validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            account:{
                required:true,
            },
            bank_name:{
                required:true,
            },
            branch_name:{
                required:true,
            },
            branch_code:{
                required:true,
            },
            ifsc_code:{
                required:true,
            },
        }

    });

    
</script>