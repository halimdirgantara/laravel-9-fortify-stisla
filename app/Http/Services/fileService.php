<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class fileService {

    public function saveImage($image) {
        if(!empty($image)) {
            $imagePath = $image->store('post','public');
            return $imagePath;
        }
        return false;
    }

    public function deleteImage($image) {
        if(!empty($image)) {
            $imageDelete = Storage::disk('public')->delete($image);
            return $imageDelete;
        }
        return false;
    }

}
