<?php

namespace App\Http\Controllers;

use App\Models\DonorsCategoryModel;
use Illuminate\Http\Request;

class DonorsCategoryController extends Controller
{
    public function index(){
        $data = DonorsCategoryModel::get();
        return view('admin.fundraising_unit.donors_category.index',['data'=>$data]);
    }

    public function create(Request $request){
        $data = new DonorsCategoryModel();
        $data->donors_categories_arabic_name = $request->donors_categories_arabic_name;
        $data->donors_categories_english_name = $request->donors_categories_english_name;
        if ($data->save()){
            return response()->json([
                'success'=>'true',
                'message'=>'تم اضافة البيانات بنجاح'
            ],200);
        }
        else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم اضافة البيانات'
            ]);
        }
    }

    public function donors_category_table_ajax(Request $request){
        $data = DonorsCategoryModel::get();
        return response()->json([
            'success'=>'true',
            'view'=>view('admin.fundraising_unit.donors_category.ajax.donors_category_table_ajax',['data'=>$data])->render()
        ]);
    }

    public function update(Request $request){
        $data = DonorsCategoryModel::find($request->id);
        $data->donors_categories_arabic_name = $request->donors_categories_arabic_name;
        $data->donors_categories_english_name = $request->donors_categories_english_name;
        if ($data->save()){
            return response()->json([
                'success'=>'true',
                'message'=>'تم تعديل البيانات بنجاح'
            ],200);
        }
        else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم تعديل البيانات'
            ]);
        }

    }
}
