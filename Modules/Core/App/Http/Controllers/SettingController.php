<?php

namespace Modules\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\App\Http\Services\SettingService;

class SettingController
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        return $this->settingService->index();
    }

    public function update(Request $request)
    {
        return $this->settingService->update($request);
    }

    public function storeBannerImage(Request $request)
    {
        return $this->settingService->storeBannerImage($request);
    }

    public function destroyBannerImage(Request $request)
    {
        return $this->settingService->destroyBannerImage($request);
    }
}
