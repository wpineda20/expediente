<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;

class FileController extends Controller
{
    /**
     * Verify that the file is an image
     */
    public static function verifyTypeFile($file)
    {
        try {
            $ext = explode('/', explode(':', substr($file, 0, strpos($file, ';'))) [1])[1];

            if ($ext == "svg+xml" || $ext == "png" || $ext == "pdf" || $ext == "jpg" || $ext == "jpeg") {
                // dd($ext);
                return true;
            }
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public static function uploadPhoto(string $file, string $filename, string $oldPhoto){
        try {
            // Getting the extesion
            $oldPhoto = str_replace('/storage/', '/app/public/', $oldPhoto);
            // dd(File::exists(storage_path().$oldPhoto), storage_path().$oldPhoto, storage_path());
            File::delete(storage_path().$oldPhoto);
            $ext = explode('/', explode(':', substr($file, 0, strpos($file, ';'))) [1])[1];
            if ($ext == 'svg+xml') {
                $ext = 'svg';
            }
            //Getting the data from the base64 string
            $file = explode(',', $file);
            //Creating the name
            $fileName = "public/photos/$fileName.$ext";
            //Storing the file
            $file = Storage::put($fileName, base64_decode($file[1]));
            //Getting the url to the file
            $url = Storage::url($fileName);

            return $url;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
