<?php

namespace App\Http\Controllers;

use App\Imports\DonorsImport;
use App\Models\ContactPersonModel;
use App\Models\DonorsCategoryModel;
use App\Models\DonorsModel;
use App\Models\RegionModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class DonorsController extends Controller
{
    public function index(){
        $category_donors = DonorsCategoryModel::get();
        $regions = RegionModel::get();
        return view('admin.fundraising_unit.donors.index',['category_donors'=>$category_donors , 'regions'=>$regions]);
    }

    public function donors_table_ajax(Request $request){
        $query = DonorsModel::query();

        if ($request->filled('search_donors_name')) {
            $query->where(function($q) use ($request) {
                $q->where('donors_arabic_name', 'like', '%' . $request->search_donors_name . '%')
                    ->orWhere('donors_english_name', 'like', '%' . $request->search_donors_name . '%');
            });
        }

        if ($request->filled('region_id')) {
            $query->where('donors_regions_id', $request->region_id);
        }

        if ($request->filled('category_id')) {
            $query->where('donors_donors_categories_id', $request->category_id);
        }

        if ($request->filled('is_partner')) {
            $query->where('donors_is_partner', $request->is_partner);
        }

        $data = $query->get();

        foreach ($data as $key) {
            $key->category = DonorsCategoryModel::find($key->donors_donors_categories_id);
            $key->region = RegionModel::find($key->donors_regions_id);
        }

        return response()->json([
            'success' => true,
            'view' => view('admin.fundraising_unit.donors.ajax.donors_table_ajax', compact('data'))->render()
        ]);
    }

    public function create(Request $request){
        $data = new DonorsModel();
        $data->donors_arabic_name = $request->donors_arabic_name;
        $data->donors_english_name = $request->donors_english_name;
        $data->donors_regions_id = $request->donors_regions_id;
        $data->donors_donors_categories_id = $request->donors_donors_categories_id;
        $data->donors_is_partner = $request->donors_is_partner;
        $data->fax = $request->fax;
        $data->address = $request->address;
        $data->website = $request->website;
        $data->work_field = $request->work_field;
        if ($data->save()){
            return response()->json([
                'success' => 'true',
                'message' => 'تم اضافة البيانات بنجاح',
                'data'=>$data,
            ]);
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'هناك خلل ما لم يتم اضافة البيانات'
            ]);
        }
    }

    public function update(Request $request){
        $data = DonorsModel::where('donors_id',$request->donors_id)->first();
        $data->donors_arabic_name = $request->donors_arabic_name;
        $data->donors_english_name = $request->donors_english_name;
        $data->donors_regions_id = $request->donors_regions_id;
        $data->donors_donors_categories_id = $request->donors_donors_categories_id;
        $data->donors_is_partner = $request->donors_is_partner;
        $data->fax = $request->fax;
        $data->address = $request->address;
        $data->website = $request->website;
        $data->work_field = $request->work_field;
        if ($data->save()){
            return response()->json([
                'success' => 'true',
                'message' => 'تم اضافة البيانات بنجاح',
                'data'=>$data,
            ]);
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'هناك خلل ما لم يتم اضافة البيانات'
            ]);
        }
    }

    public function contact_person_table_ajax(Request $request){
        $data = ContactPersonModel::where('contact_person_donors_id',$request->contact_person_donors_id)->get();
        foreach ($data as $key){
            $key->donor = DonorsModel::where('donors_id',$key->contact_person_donors_id)->first();
        }
        return response()->json([
            'success' => 'true',
            'view'=>view('admin.fundraising_unit.donors.ajax.contact_person_ajax',['data'=>$data])->render()
        ]);
    }

    public function contact_person_create_ajax(Request $request){
        $data = new ContactPersonModel();
        $data->contact_person_donors_id = $request->contact_person_donors_id;
        $data->contact_person_name = $request->contact_person_name;
        $data->contact_person_phone = $request->contact_person_phone;
        $data->contact_person_email = $request->contact_person_email;
        $data->contact_person_gender = $request->contact_person_gender;
        $data->contact_person_position = $request->contact_person_position;
        if ($data->save()){
            return response()->json([
                'success' => 'true',
                'message' => 'تم اضافة البيانات بنجاح'
            ]);
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'تم اضافة البيانات بنجاح'
            ]);
        }
    }

    public function details($id){
        $contact_person = ContactPersonModel::where('contact_person_donors_id',$id)->get();
        return view('admin.fundraising_unit.donors.details',['contact_person'=>$contact_person]);
    }

    public function import_donors_to_excel(Request $request){
        try {
            Excel::import(new DonorsImport,$request->file('donors_file'));
            return redirect()->route('fundraising_unit.donors.index')->with(['success'=>'تم اضافة البيانات بنجاح']);
        } catch (ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $row = $failure->row(); // Row that failed validation
                $errors = $failure->errors(); // Validation errors for the row

                // Handle or display errors as needed
                foreach ($errors as $error) {
                    echo "Row $row: $error\n";
                }
            }
        }
    }
}
