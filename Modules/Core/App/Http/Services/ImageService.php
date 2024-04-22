<?php

namespace Modules\Core\App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

    public function storeProjectImage($request){
        dd($request);
    }
}
