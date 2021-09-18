@php $status = ['1' => 'Active', '0' => 'Inactive'] @endphp


<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="utility_bill" class="col-form-label text-md-right">{{ __('Start Date') }}</label>
            <input name="start_stamp" class="form-control", type="date" value="" id="start_stamp">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="photo_id" class="col-form-label text-md-right">{{ __('End Date') }}</label>
            <input name="end_stamp" class="form-control", type="date" value="" id="end_stamp">
        </div>
    </div>

</div>

<div class="row mt-20 text-right pb-3">
    <div class="col-sm-12">
        {{--@include('partials.form.save-cancel', ['submitValue'=>"Search", 'cancelValue' => 'Cancel', 'skipCancel'=> true, 'submitBtnStatus' => 'Primary'])--}}
        <button type="text" id="btnFiterSubmitSearch" class="btn btn-info">Search</button>
    </div>
    </div>
</div>
