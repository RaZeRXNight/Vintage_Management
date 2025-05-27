<?php

namespace App\Http\Controllers;

use illuminate\Validation\Validator;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    //
    public function upload(Request $request, $folder)
    {
        // Get the image from the request
        $image = $request->file('ProductIMG'); 

        // Generate a unique name for the image
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Move the image to the specified folder, Creating it if it doesn't exist.
        $path = $image->storeAs($folder, $imageName, 'public');

        // Return the path to the image
        return $path;
    }
}
