<div class="row form-group">
    <div class="col-lg-3">
        <label for="Province">Province <span class="red-label">*</span></label>
    </div>

    <div class="col-lg-9">
        {{ Form::select('province_id',$provinces, null, ['class'=>'form-control'])}}
        <div class="error-message"></div>
    </div>
</div>
<div class="row form-group">
    <div class="col-lg-3">
        <label for="Name">Name <span class="red-label">*</span></label>
    </div>
    <div class="col-lg-9">
        {{ Form::text('name', null, ['class'=>'form-control'])}}
        <div class="error-message"></div>
    </div>
</div>
