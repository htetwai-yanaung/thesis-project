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
            // 'year' => 'required',
            'role' => 'required',
            'password' => isset($request->password) || isset($request->password_confirmation) ? 'same:password_confirmation' : ''
        ])->validate();

        if($request->hasFile('image')){
            $request['id'] = $id;
            $this->imageService->storeProfileImage($request);
        }

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
            DB::commit();

            return redirect()->back()->with(['success'=>'Profile successfully updated.']);
        }catch(\Throwable $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }

    }
}
