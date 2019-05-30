@extends('layouts.master')

@section('content')
    <header class="section-header">
        <div class="tbl">
            <div class="tbl-row">
                <div class="tbl-cell">
                    <h2 style="display: inline;">Municipality</h2>
                    <button type="button" class="btn btn-inline pull-right ajax-modal-box" style="display: inline"
                            data-url="{{ route('municipalities.create') }}" data-title="Create">Create
                    </button>

                </div>
            </div>
        </div>
    </header>
    <section class="card">
        <div class="card-block">
            <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Province</th>
                    <th>District</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SN</th>
                    <th>Province</th>
                    <th>District</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody class="loadTable">
                @foreach($municipalities as $municipality)
                    <tr class="tableData">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$municipality->district->province->name}}</td>
                        <td>{{$municipality->district->name}}</td>
                        <td>{{$municipality->name}}</td>
                        <td>{{$municipality->type}}</td>
                        <td>
                            <div class="btn-group btn-group-sm" style="float: none;">
                                <form action="{{ route('municipalities.destroy', array($municipality->id)) }}"
                                      method="DELETE"
                                      class="delete-data-ajax">
                                    {!! csrf_field() !!}
                                    <button type="button" class="btn btn-sm btn-secondary ajax-modal-box"
                                            data-url="{{ route('municipalities.edit', $municipality->id) }}"
                                            data-title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <button type="submit" class="tabledit-delete-button btn btn-sm btn-danger"
                                            style="float: none;"><span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).on('change', '#province_id', function () {
            $('#district_id').empty();
            $.post(
                $(this).attr('data-url'),
                {
                    "_token": "{{ csrf_token() }}",
                    "province_id": $(this).val()
                },
                function (response) {
                    console.log(response);
                    $('#district_id').append('<option value="">Select Any One</option>');
                    $.each(response, function (i, item) {
                        $('#district_id').append('<option value="' + response[i].id + '">' + response[i].name + '</option>');
                    });
                }
            );
        });
        $(document).on('click', '#add-ward', function () {
            $('.append-ward').empty();
            var value = $('#ward').val();
            for (var i = 1; i <= value; i++) {
                $('.append-ward').append('<h4 class="text-center">Ward ' + i + '</h4><hr style="background-color:#00a8ff"/>' +
                    '<div class="row form-group"><div class="col-lg-3">\n' +
                    '        <label for="ward">Total Male</label>\n' +
                    '    </div>\n' +
                    '    <div class="col-lg-9">\n' +
                    '       <input type="number" name="male[]" class="form-control min="0""/>\n' +
                    '    </div></div><div class="row form-group"><div class="col-lg-3">\n' +
                    '        <label for="ward">Total Female</label>\n' +
                    '    </div>\n' +
                    '    <div class="col-lg-9">\n' +
                    '       <input type="number" name="female[]" class="form-control" min="0"/>\n' +
                    '    </div></div><div class="row form-group"><div class="col-lg-3">\n' +
                    '        <label for="ward">Total Population</label>\n' +
                    '    </div>\n' +
                    '    <div class="col-lg-9">\n' +
                    '       <input type="number" name="total_population[]" class="form-control" min="0"/>\n' +
                    '    </div></div><div class="row form-group"><div class="col-lg-3">' +
                    '                   <label for="ward">Male Voter</label>' +
                    '                    </div>' +
                    '    <div class="col-lg-9">\n' +
                    '       <input type="number" name="voter_male[]" class="form-control" min="0"/>\n' +
                    '    </div></div><div class="row form-group"><div class="col-lg-3">\n' +
                    '        <label for="ward">Female Voter</label>\n' +
                    '    </div>\n' +
                    '    <div class="col-lg-9">\n' +
                    '       <input type="number" name="voter_female[]" class="form-control" min="0"/>\n' +
                    '    </div></div><div class="row form-group"><div class="col-lg-3">\n' +
                    '        <label for="ward">Total Voter</label>\n' +
                    '    </div>\n' +
                    '    <div class="col-lg-9">\n' +
                    '       <input type="number" name="total_voter[]" class="form-control" min="0"/>\n' +
                    '    </div></div>');
            }
        })
    </script>
@endsection