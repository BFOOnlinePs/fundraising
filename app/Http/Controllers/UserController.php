<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('admin.users.index');
    }

    public function users_table_ajax(Request $request){
        $data = User::where('name','like','%'.$request->search.'%')->get();
        return response()->json([
            'success' => 'true',
            'view' => view('admin.users.ajax.users_table_ajax',['data'=>$data])->render()
        ]);
    }

    public function create(Request $request){
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->user_phone1 = $request->user_phone1;
        $data->user_phone2 = $request->user_phone2;
        $data->user_role = $request->user_role;
        $data->user_notes = $request->user_notes;
        $data->user_address = $request->user_address;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('users', $filename, 'public');
            $data->user_photo = $filename;
        }
        if ($data->save()){
            return redirect()->route('users.index')->with(['success' => 'تم اضافة المستخدم بنجاح']);
        }
        else{
            return redirect()->route('users.index')->with(['fail' => 'لم يتم اضافة المستخدم بنجاح']);
        }
    }

    public function edit($id){
        $data = User::where('id',$id)->first();
        return view('admin.users.edit',['data'=>$data]);
    }

    public function update(Request $request){
        $data = User::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        if (!$request->filled('password')){
            $data->password = Hash::make($request->password);
        }
        $data->user_phone1 = $request->user_phone1;
        $data->user_phone2 = $request->user_phone2;
        $data->user_role = $request->user_role;
        $data->user_notes = $request->user_notes;
        $data->user_address = $request->user_address;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('users', $filename, 'public');
            $data->user_photo = $filename;
        }
        if ($data->save()){
            return redirect()->route('users.index')->with(['success' => 'تم اضافة المستخدم بنجاح']);
        }
        else{
            return redirect()->route('users.index')->with(['fail' => 'لم يتم اضافة المستخدم بنجاح']);
        }
    }
}
