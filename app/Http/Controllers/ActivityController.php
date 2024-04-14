<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\ActivityModel;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){
        $data = ActivityModel::get();
        return view('admin.activity.index',['data'=>$data]);
    }

    public function add(){
        return view('admin.activity.add');
    }

    public function create(ActivityRequest $request){
        $data = new ActivityModel();
        $data->activity_name_ar = $request->activity_name_ar;
        $data->activity_name_en = $request->activity_name_en;
        $data->activity_description_ar = $request->activity_description_ar;
        $data->activity_description_en = $request->activity_description_en;
        if ($data->save()){
            return redirect()->route('activity.index')->with(['success' => 'Data added successfully']);
        }
        else{
            return redirect()->route('activity.index')->with(['fail' => 'Data not added']);
        }
    }

    public function edit($id){
        $data = ActivityModel::where('id',$id)->first();
        return view('admin.activity.edit',['data'=>$data]);
    }

    public function update(ActivityRequest $request){
        $data = ActivityModel::where('id',$request->id)->first();
        $data->activity_name_ar = $request->activity_name_ar;
        $data->activity_name_en = $request->activity_name_en;
        $data->activity_description_ar = $request->activity_description_ar;
        $data->activity_description_en = $request->activity_description_en;
        if ($data->save()){
            return redirect()->route('activity.index')->with(['success' => 'Data updated successfully']);
        }
        else{
            return redirect()->route('activity.index')->with(['fail' => 'Data not update']);
        }
    }
}
