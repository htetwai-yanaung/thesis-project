<?php

namespace Modules\Core\App\Http\Services;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Core\Constant\Constants;

class ProfileService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function edit($id){
        $user = User::find($id);
        $dataArr = [
            'user' => $user
        ];
        return view('core::profile.edit', $dataArr);
    }

    public function update($request, $id){
        Validator::make($request->all(), [
            'image' => 'mimes:jpg,png,jpeg',
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'year' => 'required',
            'password' => isset($request->password) || isset($request->password_confirmation) ? 'same:password_confirmation' : ''
        ])->validate();

        DB::beginTransaction();
        try{
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->year = $request->year;
            $user->role = $request->role;
            if(isset($request->password) && !empty($request->password)){
                $user->password = Hash::make($request->password);
            }
            $user->update();

            if($request->hasFile('image')){
                $request['id'] = $id;
                $this->imageService->storeProfileImage($request);
            }

            DB::commit();
            $dataArr = [
                'status' => 'success',
                'message' => 'Profile successfully updated.'
            ];
            return redirect()->back()->with($dataArr);
        }catch(\Throwable $e){
            DB::rollBack();
            $dataArr = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            return redirect()->back()->with($dataArr);
        }

    }
}
