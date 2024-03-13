<?php

namespace App\Http\Controllers;

use App\Models\RegionModel;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(){
        $data = RegionModel::get();
        return view('admin.settings.region.index',['data'=>$data]);
    }

    public function create(Request $request){
        $data = new RegionModel();
        $data->regions_name = $request->regions_name;
        if ($data->save()){
            return redirect()->route('settings.region.index')->with(['success'=>'Data added successfully']);
        }
        else{
            return redirect()->route('settings.region.index')->with(['fail'=>'Data not added']);
        }
    }

    public function region_table_ajax(Request $request){
        $data = RegionModel::get();
        return response()->json([
            'success'=>'true',
            'view'=>view('admin.settings.region.ajax.region_table',['data'=>$data])->render()
        ]);
    }

    public function update(Request $request){
        $data = RegionModel::where('regions_id',$request->region_id)->first();
        $data->regions_name = $request->regions_name;
        if($data->save()){
            return response()->json([
                'success' => 'true',
                'message' => 'Data updated'
            ]);
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'Data not updated'
            ]);
        }
    }
}
