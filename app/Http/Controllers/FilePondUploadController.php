<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class FilePondUploadController extends Controller{
    public function uploadImage(Request $request){
        // Log::info($request->all());
        // return response([rand(0, 100).'asdasdas']);
        $randId = microtime();

        $destinationPathImage = 'images/tmp/'.$randId;
        
        if (!file_exists('images/tmp/'.$randId )) {
            mkdir('images/tmp/'.$randId, 0755, true); 
        }

        $files = $request->file('documentations');
        foreach($files as $file){
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $original_name = pathinfo($filename, PATHINFO_FILENAME);
    
            // Valid extensions
            $validextensions = array("jpeg","jpg","png");
    
            if(in_array(strtolower($extension), $validextensions)){
                // Rename file 
                $fileNameImages = str_replace(' ', '_', $original_name) .'.' . $extension;
                // Uploading file to given path
                $file->move($destinationPathImage, $fileNameImages);
                return response()->json($randId. '/' . $fileNameImages);
            }else{
                return response([$filename], 500);
            }
        }   
    }

    public function deleteImage($folder_id){
        try{
            File::deleteDirectory('images/tmp/'. str_replace('"', '', $folder_id));
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response([$folder_id], 500);
        }
        return response(['code' => 1], 200);
    }
}
