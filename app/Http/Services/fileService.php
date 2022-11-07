<?php

namespace App\Http\Services;

class fileService {

    public function saveImage($image) {
        if(!empty($image)) {
            $image_path = $image->store('post','public');
            return $image_path;
        }
        return false;
    }

}
