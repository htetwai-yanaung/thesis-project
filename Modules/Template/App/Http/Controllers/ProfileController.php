<?php

namespace Modules\Template\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\App\Http\Services\ProfileService;
use Modules\Core\App\Http\Services\UserService;

class ProfileController extends Controller
{
    protected $profileService, $userService;
    public function __construct(ProfileService $profileService, UserService $userService)
    {
        $this->profileService = $profileService;
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('template::profile.index');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function setting($id){
        $user = $this->userService->getUser($id);
        $dataArr = [
            'user' => $user,
        ];
        return view('template::profile.setting', $dataArr);
    }

    public function create()
    {
        return view('template::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('template::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('template::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function settingUpdate(Request $request, $id)
    {
        return $this->profileService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
