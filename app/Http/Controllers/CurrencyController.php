<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\CurrencyModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class CurrencyController extends Controller
{
    public function index(){
        $data = CurrencyModel::get();
        return view('admin.settings.currency.index',['data'=>$data]);
    }

    public function add(){
        return view('admin.settings.currency.add');
    }

    public function create(CurrencyRequest $request){
        $data = new CurrencyModel();
        $data->currency_name_ar = $request->currency_name_ar;
        $data->currency_name_en = $request->currency_name_en;
        $data->currency_symbol = $request->currency_symbol;
        $data->currency_abbreviation = $request->currency_abbreviation;
        if ($request->hasFile('currency_flag')) {
            $file = $request->file('currency_flag');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('currency', $filename, 'public');
            $data->currency_flag = $filename;
        }
        if ($data->save()){
            return redirect()->route('settings.currency.index')->with(['success'=>'Data added successfully']);
        }
        else{
            return redirect()->route('settings.currency.index')->with(['fail'=>'Data not added']);
        }
    }

    public function edit($id){
        $data = CurrencyModel::where('id',$id)->first();
        return view('admin.settings.currency.edit',['data'=>$data]);
    }

    public function update(CurrencyRequest $request){
        $data = CurrencyModel::where('id',$request->id)->first();
        $data->currency_name_ar = $request->currency_name_ar;
        $data->currency_name_en = $request->currency_name_en;
        $data->currency_symbol = $request->currency_symbol;
        $data->currency_abbreviation = $request->currency_abbreviation;
        if ($request->hasFile('currency_flag')) {
            $file = $request->file('currency_flag');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('currency', $filename, 'public');
            $data->currency_flag = $filename;
        }
        if ($data->save()){
            return redirect()->route('settings.currency.index')->with(['success'=>'Data update successfully']);
        }
        else{
            return redirect()->route('settings.currency.index')->with(['fail'=>'Data not update']);
        }
    }
}
