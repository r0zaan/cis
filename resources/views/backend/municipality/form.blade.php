<div class="row form-group">
    <div class="col-lg-3">
        <label for="Province">Province <span class="red-label">*</span></label>
    </div>
    <div class="col-lg-9">
        {{ Form::select('province_id',$provinces, null, ['class'=>'form-control select2','id'=>'province_id','data-url' => url('municipalities/province/'),'placeholder' => 'Select Any One'])}}
        <div class="error-message"></div>
    </div>
</div>
<div class="row form-group">
    <div class="col-lg-3">
        <label for="District">District <span class="red-label">*</span></label>
    </div>

    <div class="col-lg-9">
        {{ Form::select('district_id',(!empty($storedDistricts)) ? $storedDistricts : [], null, ['class'=>'form-control select2','id'=>'district_id'])}}
        <div class="error-message"></div>
    </div>
</div>
<div class="row form-group">
    <div class="col-lg-3">
        <label for="name">Name <span class="red-label">*</span></label>
    </div>
    <div class="col-lg-9">
        {{ Form::text('name', null, ['class'=>'form-control'])}}
        <div class="error-message"></div>
    </div>
</div>
<div class="row form-group">
    <div class="col-lg-3">
        <label for="type">Type <span class="red-label">*</span></label>
    </div>
    <div class="col-lg-9">
        {{ Form::select('type',['Metropolitan' => 'Metropolitan','Sub-metropolitan' => 'Sub-metropolitan','Municipality' => 'Municipality','VDC'=>'VDC'], null, ['class'=>'form-control','placeholder'=>'Select Any One'])}}
        <div class="error-message"></div>
    </div>
</div>
<div class="row form-group">
    <div class="col-lg-3">
        <label for="Ward">Ward <span class="red-label">*</span></label>
    </div>
    <div class="col-lg-6">
        {{ Form::number('total_ward', null, ['class'=>'form-control','placeholder'=>'Select Any One','id' => 'ward','min'=>'0'])}}
        <div class="error-message"></div>
    </div>
    <div class="col-lg-3">
        <button type="button" class="btn btn-secondary" id="add-ward">Add</button>
    </div>
</div>
<div class="append-ward">
    @if(!empty($storedDistricts))
        @foreach($wards as $ward)
            <h4 class="text-center">Ward {{$ward->name}}</h4>
            <hr style="background-color:#00a8ff"/>
            <div class="row form-group">
                <div class="col-lg-3">
                    <label for="ward">Total Male</label>
                </div>
                <div class="col-lg-9">
                    {{ Form::number('male[]', $ward['male'], ['class'=>'form-control','min'=>'0'])}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3">
                    <label for="ward">Total Female</label>
                </div>
                <div class="col-lg-9">
                    {{ Form::number('female[]', $ward['female'], ['class'=>'form-control','min'=>'0'])}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3">
                    <label for="ward">Total Population</label>
                </div>
                <div class="col-lg-9">
                    {{ Form::number('total_population[]', $ward['total_population'], ['class'=>'form-control','min'=>'0'])}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3">
                    <label for="ward">Male Voter</label>
                </div>
                <div class="col-lg-9">
                    {{ Form::number('voter_male[]',  $ward['voter_male'], ['class'=>'form-control','min'=>'0'])}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3">
                    <label for="ward">Female Voter</label>
                </div>
                <div class="col-lg-9">
                    {{ Form::number('voter_female[]',  $ward['voter_female'], ['class'=>'form-control','min'=>'0'])}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3">
                    <label for="ward">Total Voter</label>
                </div>
                <div class="col-lg-9">
                    {{ Form::number('total_voter[]',  $ward['total_voter'], ['class'=>'form-control','min'=>'0'])}}
                </div>
            </div>
        @endforeach
    @endif


</div>
<div class="hidden">
    @if(!empty($storedDistricts))
        @foreach($wards as $ward)
            <input type="hidden" name="ward_id[]" value="{{$ward->id}}"/>
        @endforeach
    @endif

</div>
