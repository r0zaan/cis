@extends('layouts.master')

@section('content')
    <header class="section-header">
        <div class="tbl">
            <div class="tbl-row">
                <div class="tbl-cell">
                    <h2 style="display: inline;">District</h2>
                    <button type="button" class="btn btn-inline pull-right ajax-modal-box" style="display: inline"
                            data-url="{{ route('districts.create') }}" data-title="Create">Create
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
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SN</th>
                    <th>Province</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody class="loadTable">
                @foreach($districts as $district)
                    <tr class="tableData">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$district->province->name}}</td>
                        <td>{{$district->name}}</td>
                        <td>
                            <div class="btn-group btn-group-sm" style="float: none;">
                                <form action="{{ route('districts.destroy', array($district->id)) }}" method="DELETE"
                                      class="delete-data-ajax">
                                    {!! csrf_field() !!}
                                    <button type="button" class="btn btn-sm btn-secondary ajax-modal-box"
                                            data-url="{{ route('districts.edit', $district->id) }}" data-title="Edit">
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