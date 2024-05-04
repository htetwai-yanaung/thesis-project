<?php

namespace Modules\Core\App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Core\App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Core\App\Models\Setting;
use Modules\Core\Constant\Constants;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function storeProfileImage($request){
        $user = User::find($request->id);
        $oldImage = $user->profile_photo_path;

        if($oldImage != null){
            Storage::delete(Constants::profileImagePath.'/'.$oldImage);
        }

        $imageName = uniqid().'_.'.$request->image->extension();
        // Storage::putFileAs('public/uploads', $request->image, $imageName);
        $request->image->storeAs(Constants::profileImagePath, $imageName);
        $user->profile_photo_path = $imageName;
        $user->update();

        return $imageName;
    }

    public function storeProjectImages($request, $id){
        if($request->file){
            $images = $request->file;
            try{
                foreach($images as $image){
                    $imageName = uniqid().'_.'.$image->extension();
                    $imageType = Constants::imageFileType;

                    if($image->extension() == 'pdf'){
                        $image->storeAs(Constants::projectPdfPath, $imageName);
                        $imageType = Constants::pdfFileType;
                    }else{
                        $image->storeAs(Constants::projectImagePath, $imageName);
                    }

                    $thesisImage = new Image();
                    $thesisImage->parent_id = $id;
                    $thesisImage->image_type = Constants::projectImageType;
                    $thesisImage->file_type = $imageType;
                    $thesisImage->path = $imageName;
                    $thesisImage->save();
                }

                return [
                    'status' => 'success',
                    'message' => 'File upload success'
                ];
            }catch(\Throwable $e){
                return [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
            }
        }

    }

    public function updateSiteImage($request)
    {
        $settings = Setting::first();
        $oldSiteImage = $settings->site_image;
        if(File::exists(Constants::uploadsPath.'/'.$oldSiteImage)){
            Storage::delete(Constants::uploadsPath.'/'.$oldSiteImage);
        }

        $imageName = uniqid().'_.'.$request->site_image->extension();
        $request->site_image->storeAs(Constants::uploadsPath, $imageName);

        $settings->site_image = $imageName;
        $settings->update();
    }
}
