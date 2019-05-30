<div class="modal-body">
    {{Form::model($municipality, ['method'=>'PATCH',
		'action'=>['Municipality\MunicipalityController@update', $municipality->id],
		'class'=>'ajax-form-post'])}}

    @include('backend.municipality.form')
    <div class="row">
        <div class="offset-lg-2 col-lg-8">
            {{ Form::submit('Update', ['class'=>'btn btn-primary'])}}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>

    {{Form::close()}}
</div>