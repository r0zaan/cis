<?php

namespace App\Http\Controllers\Municipality;

use App\District;
use App\Http\Controllers\Controller;
use App\Municipality;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipalities = Municipality::orderBy('name', 'ASC')->get();
        return view('backend.municipality.index', compact('municipalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        $districts = District::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        return view('backend.municipality.create', compact('provinces', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:municipalities',
            'province_id' => 'required',
            'district_id' => 'required',
            'total_ward' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        $municipality = Municipality::create($inputs);
        for ($i = 0; $i < $request['total_ward']; $i++) {
            $municipality->wards()->create([
                'name' => $i+1,
                'total_population' => $request['total_population'][$i],
                'male' => $request['male'][$i],
                'female' => $request['female'][$i],
                'voter_male' => $request['voter_male'][$i],
                'voter_female' => $request['voter_female'][$i],
                'total_voter' => $request['total_voter'][$i],
            ]);
        }
        return [
            'status' => 'success',
            'return_url' => route('districts.index'),
            'message' => 'VDC/Municipality Created'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function show(Municipality $municipality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipality $municipality)
    {
        $provinces = Province::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        $municipality['province_id'] = $municipality->district->province->id;
        $districts = District::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        $storedDistricts = Province::find($municipality->district->province->id)
            ->districts()
            ->orderBy('name', 'ASC')
            ->get()
            ->pluck('name', 'id');
        $wards = $municipality->wards()->orderBy('name')->get();
        return view('backend.municipality.edit', compact('provinces', 'districts', 'municipality', 'storedDistricts', 'wards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Municipality $municipality
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Municipality $municipality)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:municipalities,name,$municipality->id,id",
            'province_id' => 'required',
            'district_id' => 'required',
            'total_ward' => 'required',
            'type' => 'required',
        ]);
//        return $request;
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        $municipality->update($inputs);
        for ($i = 0; $i < $request['total_ward']; $i++) {
            $municipality->wards()->find($request['ward_id'][$i])->update([
                'total_population' => $request['total_population'][$i],
                'male' => $request['male'][$i],
                'female' => $request['female'][$i],
                'voter_male' => $request['voter_male'][$i],
                'voter_female' => $request['voter_female'][$i],
                'total_voter' => $request['total_voter'][$i],
            ]);
        }
        return [
            'status' => 'success',
            'return_url' => route('districts.index'),
            'message' => 'VDC/Municipality Updated'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipality $municipality)
    {
        if (!request()->ajax()) {
            return false;
        }
        foreach ($municipality->wards()->get() as $ward) {
            $ward->delete();
        }
        $municipality->delete();
        return [
            'status' => 'success',
            'message' => 'Municipality Deleted'
        ];
    }

    public function districtData(Request $request)
    {
        $province = Province::find($request['province_id']);
        $districts = $province->districts()->orderBy('name', 'ASC')->get();
        return $districts;
    }
}
