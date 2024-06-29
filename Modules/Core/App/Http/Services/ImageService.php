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
use Modules\Core\App\Models\TemporaryFile;

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

    // dropzone
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

    public function getTempFiles($folder)
    {
        $tempFile = TemporaryFile::whereIn(TemporaryFile::folder, $folder)->get();

        return $tempFile;
    }

    // filepond store/update thesis images
    public function storeThesisImages($request, $thesisId)
    {
        $oldImages = $this->getImages($thesisId, 'project');
        if($oldImages){
            foreach($oldImages as $image){
                $image->delete();
                Storage::deleteDirectory(Constants::projectImagePath . $image->path);
            }
        }

        $tempFile = $this->getTempFiles($request->thesis_image);

        if($tempFile){
            foreach($tempFile as $tmp){
                Storage::copy(Constants::tmpImagePath . $tmp->folder . '/' . $tmp->file, Constants::projectImagePath . $tmp->file);

                Image::create([
                    'parent_id' => $thesisId,
                    'image_type' => Constants::projectImageType,
                    'file_type' => Constants::imageFileType,
                    'path' => $tmp->file,
                ]);

                Storage::deleteDirectory(Constants::tmpImagePath . $tmp->folder);
                $tmp->delete();
            }
        }
    }

    // get image by parent_id
    public function getImages($parentId, $imageType)
    {
        $images = Image::where([
            Image::parentId => $parentId,
            Image::imageType => $imageType,
        ])->get();

        return $images;
    }

    // store and udpate images for both thesis and news
    public function storeImages($images, $parentId, $filePath, $imageType)
    {
        $oldImages = $this->getImages($parentId, $imageType);
        if($oldImages){
            foreach($oldImages as $image){
                $image->delete();
                Storage::deleteDirectory($filePath . $image->path);
            }
        }

        $tempFile = $this->getTempFiles($images);

        if($tempFile){
            foreach($tempFile as $tmp){
                Storage::copy('public/uploads/tmp/' . $tmp->folder . '/' . $tmp->file, $filePath . $tmp->file);

                Image::create([
                    'parent_id' => $parentId,
                    'image_type' => $imageType,
                    'file_type' => Constants::imageFileType,
                    'path' => $tmp->file,
                ]);

                Storage::deleteDirectory('public/uploads/tmp/' . $tmp->folder);
                $tmp->delete();
            }
        }
    }
}
