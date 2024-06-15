<?php

namespace Modules\Core\App\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Core\App\Models\Image;
use Modules\Core\App\Models\Setting;
use Modules\Core\Constant\Constants;
use Illuminate\Support\Facades\Storage;
use Modules\Core\App\Http\Services\ImageService;

class SettingService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $settings = Setting::first();
        $bannerImages = Image::where([Image::imageType => Constants::bannerImageType])->get();

        $dataArr = [
            'settings' => $settings,
            'bannerImages' => $bannerImages,
        ];

        return view('core::settings.index', $dataArr);
    }

    public function update($request)
    {
        DB::beginTransaction();
        try{
            $settings = Setting::first();
            if(isset($request->site_name)){
                $settings->site_name = $request->site_name;
            }
            if(isset($request->enable_approve)){
                $settings->enable_approve = 1;
            }else{
                $settings->enable_approve = 0;
            }
            if($request->hasFile('site_image')){
                $this->imageService->updateSiteImage($request);
            }
            $settings->update();
            DB::commit();

            $dataArr = [
                'status' => 'success',
                'message' => 'Setting update success'
            ];
            return redirect()->back()->with($dataArr);
        }catch(\Throwable $e){
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function storeBannerImage($request)
    {
        if($request->file){
            $images = $request->file;
            DB::beginTransaction();
            try{
                foreach($images as $image){
                    $imageName = uniqid().'_.'.$image->extension();
                    $imageType = Constants::imageFileType;

                    $image->storeAs(Constants::projectImagePath, $imageName);

                    $thesisImage = new Image();
                    $thesisImage->parent_id = 1;
                    $thesisImage->image_type = Constants::bannerImageType;
                    $thesisImage->file_type = $imageType;
                    $thesisImage->path = $imageName;
                    $thesisImage->save();

                    DB::commit();
                }

                return [
                    'status' => 'success',
                    'message' => 'File upload success'
                ];
            }catch(\Throwable $e){
                DB::rollBack();
                return [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
            }
        }
    }

    public function destroyBannerImage($request)
    {
        $image = Image::where('path', $request->image)->first();

        if($image){
            Storage::delete(Constants::projectImagePath.'/'.$image->path);
        }

        $image->delete();

        return response()->json(['message' => 'delete success']);
    }
}
