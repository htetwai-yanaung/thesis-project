<?php

namespace Modules\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\App\Http\Services\ImageService;

class ImageController
{
    public function __construct(protected ImageService $imageService)
    {

    }

    public function dropzoneTempStore(Request $request)
    {
        $images = $request->file('file');
        if(is_array($images)){
            foreach($images as $key=>$image){
                $images[$key] = $this->imageService->storeTempFile($image);
            }
            return response()->json($images, 200);
        }else{
            $image = $this->imageService->storeTempFile($images);
            return response()->json($image, 200);
        }
    }
}
