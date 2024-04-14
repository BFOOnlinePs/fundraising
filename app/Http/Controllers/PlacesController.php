<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlacesRequest;
use App\Models\PlacesModel;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function index(){
        $data = PlacesModel::get();
        return view('admin.settings.places.index',['data'=>$data]);
    }

    public function add(){
        return view('admin.settings.places.add');
    }

    public function create(PlacesRequest $request){
        $data = new PlacesModel();
        $data->place_name_ar = $request->place_name_ar;
        $data->place_name_en = $request->place_name_en;
        $data->place_description = $request->place_description;
        if ($data->save()){
            return redirect()->route('settings.places.index')->with(['success'=>'Data added successfully']);
        }
        else{
            return redirect()->route('settings.places.index')->with(['fail'=>'Data not added']);
        }
    }

    public function edit($id){
        $data = PlacesModel::where('id',$id)->first();
        return view('admin.settings.places.edit',['data'=>$data]);
    }

    public function update(PlacesRequest $request){
        $data = PlacesModel::where('id',$request->id)->first();
        $data->place_name_ar = $request->place_name_ar;
        $data->place_name_en = $request->place_name_en;
        $data->place_description = $request->place_description;
        if ($data->save()){
            return redirect()->route('settings.places.index')->with(['success'=>'Data updated successfully']);
        }
        else{
            return redirect()->route('settings.places.index')->with(['fail'=>'Data not updated']);
        }
    }
}
