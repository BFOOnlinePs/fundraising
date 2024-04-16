<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectsRequest;
use App\Models\CurrencyModel;
use App\Models\ProjectsModel;
use App\Models\TypeOfBeneficiariesModel;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(){
        return view('admin.projects.index');
    }

    public function project_table_ajax(Request $request){
        $data = ProjectsModel::paginate(15);
        return response()->json([
            'success' => 'true',
            'view' => view('admin.projects.ajax.project_table_ajax',['data'=>$data])->render()
        ]);
    }

    public function add(){
        $currency = CurrencyModel::get();
        $beneficiary = TypeOfBeneficiariesModel::get();
        return view('admin.projects.add',['currency'=>$currency,'beneficiary'=>$beneficiary]);
    }

    public function create(ProjectsRequest $request){
        $data = new ProjectsModel();
        $data->reference_number = $request->reference_number;
        $data->project_name_ar = $request->project_name_ar;
        $data->project_name_en = $request->project_name_en;
        $data->project_description = $request->project_description;
        $data->planned_start_date = $request->planned_start_date;
        $data->planned_end_date = $request->planned_end_date;
        $data->institution_role = $request->institution_role;
        $data->budget = $request->budget;
        $data->currency_id = $request->currency_id;
        $data->beneficiary_id = $request->beneficiary_id;
        if ($data->save()){
            return redirect()->route('projects.index')->with(['success' => 'Data added successfully']);
        }
        else{
            return redirect()->route('projects.index')->with(['fail' => 'Data not added']);
        }
    }

    public function edit($id)
    {
        $currency = CurrencyModel::get();
        $beneficiary = TypeOfBeneficiariesModel::get();
        $data = ProjectsModel::where('id',$id)->first();
        return view('admin.projects.edit',['data'=>$data,'currency'=>$currency,'beneficiary'=>$beneficiary]);
    }

    public function update(ProjectsRequest $request){
        $data = ProjectsModel::where('id',$request->id)->first();
        $data->reference_number = $request->reference_number;
        $data->project_name_ar = $request->project_name_ar;
        $data->project_name_en = $request->project_name_en;
        $data->project_description = $request->project_description;
        $data->planned_start_date = $request->planned_start_date;
        $data->planned_end_date = $request->planned_end_date;
        $data->institution_role = $request->institution_role;
        $data->budget = $request->budget;
        $data->currency_id = $request->currency_id;
        $data->beneficiary_id = $request->beneficiary_id;
        if ($data->save()){
            return redirect()->route('projects.index')->with(['success' => 'Data updated successfully']);
        }
        else{
            return redirect()->route('projects.index')->with(['fail' => 'Data not update']);
        }
    }
}
