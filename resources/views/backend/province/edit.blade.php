<div class="modal-body">
    {{Form::model($province, ['method'=>'PATCH',
		'action'=>['Province\ProvinceController@update', $province->id],
		'class'=>'ajax-form-post'])}}

    @include('backend.province.form')
    <div class="row">
        <div class="offset-lg-2 col-lg-8">
            {{ Form::submit('Update', ['class'=>'btn btn-primary'])}}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>

    {{Form::close()}}
</div>