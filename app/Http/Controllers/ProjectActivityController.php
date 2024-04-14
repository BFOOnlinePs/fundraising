<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectActivityRequest;
use App\Models\ActivityModel;
use App\Models\ProjectActivityModel;
use App\Models\ProjectsModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectActivityController extends Controller
{
    public function index(){
        $data = ProjectActivityModel::get();
        foreach ($data as $key){
            $key->project = ProjectsModel::where('id',$key->project_id)->first();
            $key->activity = ActivityModel::where('id',$key->activity_id)->first();
            $key->user = User::where('id',$key->insert_by)->first();
        }
        return view('admin.project_activity.index',['data'=>$data]);
    }

    public function add(){
        $projects = ProjectsModel::get();
        $activites = ActivityModel::get();
        return view('admin.project_activity.add',['projects'=>$projects,'activites'=>$activites]);
    }

    public function create(ProjectActivityRequest $request){
        $data = new ProjectActivityModel();
        $data->project_id = $request->project_id;
        $data->activity_id = $request->activity_id;
        $data->insert_by = auth()->user()->id;
        $data->insert_at = Carbon::now();
        if ($data->save()){
            return redirect()->route('project_activity.index')->with(['success'=>'Data added successfully']);
        }
        else{
            return redirect()->route('project_activity.index')->with(['fail'=>'Data not added']);
        }
    }

    public function edit($id){
        $projects = ProjectsModel::get();
        $activites = ActivityModel::get();
        $data = ProjectActivityModel::where('id',$id)->first();
        return view('admin.project_activity.edit',['data'=>$data,'projects'=>$projects,'activites'=>$activites]);
    }

    public function update(ProjectActivityRequest $request){
        $data = ProjectActivityModel::where('id',$request->id)->first();
        $data->project_id = $request->project_id;
        $data->activity_id = $request->activity_id;
        $data->insert_by = auth()->user()->id;
        $data->insert_at = Carbon::now();
        if ($data->save()){
            return redirect()->route('project_activity.index')->with(['success'=>'Data updated successfully']);
        }
        else{
            return redirect()->route('project_activity.index')->with(['fail'=>'Data not update']);
        }
    }
}
