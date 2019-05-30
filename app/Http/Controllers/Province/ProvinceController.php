<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::orderBy('name','ASC')->get();
        return view('backend.province.index',compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.province.create');
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
            'name' => 'required|unique:provinces',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        Province::create($inputs);
        return [
            'status' => 'success',
            'return_url' => route('provinces.index'),
            'message' => 'Province Created'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        return view('backend.province.show',compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        return view('backend.province.edit',compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Province  $province
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:provinces,name,$province->id,id",
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $province->update($inputs);
        return [
            'status' => 'success',
            'return_url' => route('provinces.index'),
            'message' => 'Province Updated'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Province  $province
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        if (!request()->ajax()) {
            return false;
        }
        $province->delete();
        return [
            'status' => 'success',
            'message' => 'Province Deleted'
        ];
    }
}
