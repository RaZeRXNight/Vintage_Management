<?php

namespace App\Http\Controllers;

use illuminate\Validation\Validator;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    //
    public function upload(Request $request, $folder)
    {
        // Validate the image...
        $request->validate([ 'ProductIMG' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', ]);

        // Create Folder if it doesn't exists...
        if (!file_exists(public_path($folder))) { mkdir(public_path($folder), 0777, true); }
        
        // Get the image from the request
        $image = $request->file('ProductIMG'); 

        // Generate a unique name for the image
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        echo $imageName;

        // Move the image to the specified folder
        // $image->storeAs(public_path($folder), $imageName);

        // Return the path to the image
        return $folder . '/' . $imageName;
    }
}
