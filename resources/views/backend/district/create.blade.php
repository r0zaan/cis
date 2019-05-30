
<div class="modal-body">
{{Form::open(['method'=>'POST', 'action'=>'District\DistrictController@store', 'class'=>'ajax-form-post'])}}

@include('backend.district.form')
<div class="row">
    <div class="offset-lg-2 col-lg-8">
        {{ Form::submit('Create', ['class'=>'btn btn-primary'])}}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>

{{Form::close()}}
</div>