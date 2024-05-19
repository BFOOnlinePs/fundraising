<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaReportRequest;
use App\Models\ActivityModel;
use App\Models\AttachmentModel;
use App\Models\MediaReportAttachmentModel;
use App\Models\MediaReportModel;
use App\Models\ProjectActivityModel;
use App\Models\ProjectsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MediaReportController extends Controller
{
    public function index(){
        return view('admin.media_report.index');
    }

    public function media_report_table_ajax(Request $request){
        $query = MediaReportModel::query();

        // Employee
        if (auth()->user()->user_role == 3){
            $query->where('user_id',auth()->user()->id);
        }

        if ($request->filled('search')){
            $query->where(function ($query) use ($request){
                $query->where('title_ar','like','%'.$request->search.'%')->orWhere('title_en','like','%'.$request->search.'%');
            });
        }

        $data = $query->paginate(15);
        return response()->json([
            'success' => 'true',
            'view' => view('admin.media_report.ajax.media_report_table_ajax',['data'=>$data])->render()
        ]);
    }

    public function add(){
        $projects = ProjectsModel::get();
        $media_officers = User::where('user_role',4)->get();
        return view('admin.media_report.add',['media_officers'=>$media_officers,'projects'=>$projects]);
    }

    public function create(MediaReportRequest $request)
    {
        $data = new MediaReportModel();
        $data->title_ar = $request->title_ar;
        $data->title_en = $request->title_en;
        $data->media_report_content_ar = $request->media_report_content_ar;
        $data->media_report_content_en = $request->media_report_content_en;
        $data->status = 'pending';
        $data->project_id = $request->project_id;
        $data->activity_id = $request->activity_id;
        $data->notes = $request->notes;
        $data->user_id = auth()->user()->id;

        if ($request->hasFile('main_photo')) {
            $file = $request->file('main_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('media_report', $filename, 'public');
            $data->main_photo = $filename;
        }

        if ($data->save()) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $attachment = new AttachmentModel();
                    $extension = $image->getClientOriginalExtension();
                    $filename = time() . '_' . rand(1000,9999) . '.' . $extension;

                    // Resize and save the image using Intervention Image
                    $resizedImage = Image::make($image)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode($extension); // Adjust the resize dimensions as needed

                    // Store the resized image
                    Storage::put('public/media_report/' . $filename, $resizedImage->__toString());

                    $attachment->media_report_id = $data->id; // Assuming there's a foreign key relationship
                    $attachment->file = $filename;
                    $attachment->save();
                }
            }

            return redirect()->route('media_report.index')->with(['success' => 'تم اضافة التقرير بنجاح']);
        } else {
            return redirect()->route('media_report.index')->with(['fail' => 'هناك خلل ما لم يتم اضافة التقرير']);
        }
    }
    public function edit($id){
        $projects = ProjectsModel::get();
        $data = MediaReportModel::where('id',$id)->first();
        $attachments = AttachmentModel::where('media_report_id',$id)->get();
        return view('admin.media_report.edit',['data'=>$data,'attachments'=>$attachments,'projects'=>$projects]);
    }

    public function update(Request $request){
        $data = MediaReportModel::where('id',$request->id)->first();
        $data->title_ar = $request->title_ar;
        $data->title_en = $request->title_en;
        $data->media_report_content_ar = $request->media_report_content_ar;
        $data->media_report_content_en = $request->media_report_content_en;
        $data->status = 'pending';
        $data->project_id = $request->project_id;
        $data->activity_id = $request->activity_id;
        $data->notes = $request->notes;

        // Update the main photo if a new one is uploaded
        if ($request->hasFile('main_photo')) {
            $file = $request->file('main_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('media_report', $filename, 'public');
            $data->main_photo = $filename; // Assuming 'main_photo' is the field for the main photo
        }

        if ($data->save()){
            // Delete any attachments marked for deletion
            if ($request->has('deleted_images')) {
                foreach ($request->input('deleted_images') as $deletedImageId) {
                    // Delete the image from the database
                    AttachmentModel::destroy($deletedImageId);
                }
            }

            // Upload new images and save them to the database
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $attachment = new AttachmentModel();
                    $extension = $image->getClientOriginalExtension();
                    $filename = time() . '_' . rand(1000,9999) . '.' . $extension;
                    $image->storeAs('media_report', $filename, 'public');
                    $attachment->media_report_id = $data->id; // Assuming there's a foreign key relationship
                    $attachment->file = $filename;
                    $attachment->save();
                }
            }

            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $image) {
                    $attachment = new MediaReportAttachmentModel();
                    $extension = $image->getClientOriginalExtension();
                    $filename = time() . '_' . rand(1000,9999) . '.' . $extension;

                    // Store the resized image
                    $image->storeAs('media_report', $filename, 'public');

                    $attachment->media_report_id = $data->id; // Assuming there's a foreign key relationship
                    $attachment->file = $filename;
                    $attachment->save();
                }
            }

            return redirect()->route('media_report.edit',['id'=>$request->id])->with(['success'=>'Media report updated successfully']);
        }
        else{
            return redirect()->route('media_report.edit',['id'=>$request->id])->with(['fail'=>'There was an error updating the media report']);
        }
    }


    public function details($id){
        $data = MediaReportModel::where('id',$id)->first();
        return view('admin.media_report.details',['data'=>$data]);
    }

    public function approved_media_report(Request $request){
        $data = MediaReportModel::where('id',$request->id)->first();
        $data->approve_id = auth()->user()->id;
        if ($request->submit == 'approved'){
            $data->status = 'accept';
        }
        else if ($request->submit == 'not_approved'){
            $data->status = 'non_accept';
        }
        if ($data->save()){
            return redirect()->route('media_report.index')->with(['success'=>'تم تغيير الاعدادات بنجاح']);
        }
        else{
            return redirect()->route('media_report.index')->with(['success'=>'هناك خلل ما لم يتم تغيير الاعدادات']);
        }
    }

    public function delete_image_ajax(Request $request){
        $data = AttachmentModel::where('id',$request->id)->first();
        if ($data->delete()){
            return response()->json([
                'success' => 'true',
                'message' => 'تم حذف الصورة بنجاح'
            ]);
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'هناك خلل ما'
            ]);
        }
    }

    public function attachment_ajax(Request $request){
        $data = AttachmentModel::where('media_report_id',$request->id)->get();
        return response()->json([
            'success' => 'true',
            'view' => view('admin.media_report.ajax.list_image_ajax',['data'=>$data])->render()
        ]);
    }

    public function get_activites_if_selected_project_ajax(Request $request){
        $data = ProjectActivityModel::where('project_id',$request->project_id)->get();
        foreach ($data as $key){
            $key->activity = ActivityModel::where('id',$key->activity_id)->first();
        }
        return response()->json([
            'success' => 'true',
            'data' => $data
        ]);
    }

    public function list_other_image_ajax(Request $request){
        $data = MediaReportAttachmentModel::where('media_report_id',$request->id)->get();
        foreach ($data as $item) {
            $item->filename_with_extension = $item->file; // Store the original file name with extension
            $item->file = pathinfo($item->file, PATHINFO_FILENAME); // Store only the filename
            $item->extension = pathinfo($item->filename_with_extension, PATHINFO_EXTENSION); // Store the file extension
        }
        return response()->json([
            'success' => 'true',
            'view' => view('admin.media_report.ajax.list_other_image_ajax',['data'=>$data])->render()
        ]);
    }

    public function delete_other_attachment_ajax(Request $request){
        $data = MediaReportAttachmentModel::where('id',$request->id)->first();
        if ($data->delete()){
            return response()->json([
                'success' => 'true'
            ]);
        }
    }
}
