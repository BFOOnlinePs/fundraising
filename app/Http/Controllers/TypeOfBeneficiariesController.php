<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeOfBeneficiariesRequest;
use App\Models\TypeOfBeneficiariesModel;
use Illuminate\Http\Request;

class TypeOfBeneficiariesController extends Controller
{
    public function index(){
        $data = TypeOfBeneficiariesModel::get();
        return view('admin.settings.type_of_beneficiaries.index',['data'=>$data]);
    }

    public function add(){
        return view('admin.settings.type_of_beneficiaries.add');
    }

    public function create(TypeOfBeneficiariesRequest $request){
        $data = new TypeOfBeneficiariesModel();
        $data->type_name = $request->type_name;
        if ($data->save()){
            return redirect()->route('settings.type_of_beneficiaries.index')->with(['success'=>'Data added successfully']);
        }
        else{
            return redirect()->route('settings.type_of_beneficiaries.index')->with(['success'=>'Data not added']);
        }
    }

    public function edit($id){
        $data = TypeOfBeneficiariesModel::where('id',$id)->first();
        return view('admin.settings.type_of_beneficiaries.edit',['data'=>$data]);
    }

    public function update(TypeOfBeneficiariesRequest $request){
        $data = TypeOfBeneficiariesModel::where('id',$request->id)->first();
        $data->type_name = $request->type_name;
        if ($data->save()){
            return redirect()->route('settings.type_of_beneficiaries.index')->with(['success'=>'Data updated successfully']);
        }
        else{
            return redirect()->route('settings.type_of_beneficiaries.index')->with(['success'=>'Data not update']);
        }
    }
}
