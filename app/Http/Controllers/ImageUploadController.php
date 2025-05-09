<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    //
    public function upload(Request $request, $folder)
    {

        // Validate the image
        $request->validate([
            'ProductIMG' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!file_exists(public_path($folder))) {
            mkdir(public_path($folder), 0777, true); // Create the folder if it doesn't exist
        }
        
        
        $image = $request->file('ProductIMG'); // Get the image from the request
        // Generate a unique name for the image
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Move the image to the specified folder
        $image->move(public_path($folder), $imageName);

        // Return the path to the image
        return $folder . '/' . $imageName;
    }
}
