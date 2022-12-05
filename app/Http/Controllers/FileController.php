<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class FileController extends Controller
{
    public static function base64ToFile(String $fileBase64 = "file", String $fileName="fileName", String $directoryName = "files")
    {
        $url = "";
        try {
            // Getting the extesion
            $ext = explode('/', explode(':', substr($fileBase64, 0, strpos($fileBase64, ';'))) [1])[1];
            //Getting the data from the base64 string
            $fileArray = explode(',', $fileBase64);
            //Creating the name
            $path = "public/$directoryName/$fileName.$ext";
            //Storing the file
            Storage::put($path, base64_decode($fileArray[1]));
            //Getting the url to the file
            $url = Storage::url($path);
            // $clasificationPlace->icon_marker = $url;
        } catch (\Throwable $th) {
            // throw $th;
            $url = "";
        }

        return $url;
    }
}
