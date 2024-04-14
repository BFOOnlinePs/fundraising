<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request){
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique filename
            $filename = time() . '_' . $image->getClientOriginalName();

            // Store the image in storage/app/public/media_report directory
            $image->storeAs('public/media_report', $filename);

            return response()->json(['success' => true, 'filename' => $filename]);
        }

        return response()->json(['success' => false]);
    }
}
