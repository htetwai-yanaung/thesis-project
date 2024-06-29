<?php

namespace Modules\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Modules\Core\App\Http\Services\UserService;
use Modules\Core\App\Http\Services\ProfileService;
use Modules\Core\Constant\Constants;

class ProfileController extends Controller
{
    protected $profileService, $userService;

    public function __construct(ProfileService $profileService, UserService $userService)
    {
        $this->profileService = $profileService;
        $this->userService = $userService;
    }

    public function index()
    {
        return view('core::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core::create');
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
        return view('core::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = $this->userService->getUser($id);
        $dataArr = [
            'user' => $user
        ];

        return view('core::profile.edit', $dataArr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = $this->userService->getUser($id);

        Validator::make($request->all(), [
            'image' => 'mimes:jpg,png,jpeg',
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'year' => $user->role == Constants::student ? 'required' : '',
            'password' => isset($request->password) || isset($request->password_confirmation) ? 'same:password_confirmation' : ''
        ])->validate();

        $user = $this->userService->update($request, $id);

        return redirect()->back()->with($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
