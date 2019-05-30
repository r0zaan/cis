<?php

namespace App\Http\Controllers\District;

use App\District;
use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::orderBy('name','ASC')->get();
        return view('backend.district.index',compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.district.create',compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:districts',
            'province_id' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        District::create($inputs);
        return [
            'status' => 'success',
            'return_url' => route('districts.index'),
            'message' => 'District Created'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        return view('backend.district.show',compact('district'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $provinces = Province::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.district.edit',compact('district','provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:districts,name,$district->id,id",
            'province_id' => "required",
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        $district->update($inputs);
        return [
            'status' => 'success',
            'return_url' => route('districts.index'),
            'message' => 'District Updated'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        if (!request()->ajax()) {
            return false;
        }
        $district->delete();
        return [
            'status' => 'success',
            'message' => 'District Deleted'
        ];
    }
}
