<?php

namespace Modules\Core\App\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Core\App\Models\Setting;
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

        $dataArr = [
            'settings' => $settings
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
}
