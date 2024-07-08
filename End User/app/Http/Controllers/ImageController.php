<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function img(Request $request)
    {
        $file_path = $request->input('file_path');
        // $folder = env("FILE_FOLDER", "");
        $folder = env("FILE_FOLDER", "D:\github\CS262_Section2_Team1_Final_Project\Administration User\public\storage");
        $file = $folder . '/' . $file_path;

        // check if file exists
        if (!file_exists($file)) {
            return response()->json([
                'message' => 'File not found',
                'path' => $file,
            ], 404);
        }

        // return file
        return response()->file($file);
    }
}
