<?php

namespace App\Http\Controllers;

use App\Http\Requests\CitesRequest;
use App\Http\Requests\CurrencyRequest;
use App\Models\CitesModel;
use App\Models\CurrencyModel;
use Illuminate\Http\Request;

class CitesController extends Controller
{
    public function index(){
        $data = CitesModel::get();
        return view('admin.settings.cites.index',['data'=>$data]);
    }

    public function add(){
        return view('admin.settings.cites.add');
    }

    public function create(CitesRequest $request){
        $data = new CitesModel();
        $data->city_name_ar = $request->city_name_ar;
        $data->city_name_en = $request->city_name_en;
        $data->city_description = $request->city_description;
        if ($data->save()){
            return redirect()->route('settings.cites.index')->with(['success'=>'Data added successfully']);
        }
        else{
            return redirect()->route('settings.cites.index')->with(['fail'=>'Data not added']);
        }
    }

    public function edit($id){
        $data = CitesModel::where('id',$id)->first();
        return view('admin.settings.cites.edit',['data'=>$data]);
    }

    public function update(CitesRequest $request){
        $data = CitesModel::where('id',$request->id)->first();
        $data->city_name_ar = $request->city_name_ar;
        $data->city_name_en = $request->city_name_en;
        $data->city_description = $request->city_description;
        if ($data->save()){
            return redirect()->route('settings.cites.index')->with(['success'=>'Data update successfully']);
        }
        else{
            return redirect()->route('settings.cites.index')->with(['fail'=>'Data not updated']);
        }
    }
}
