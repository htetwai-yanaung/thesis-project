<?php

namespace Modules\Core\App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function dashboard(){
        $user = User::find(Auth::user()->id);
        $dataArr = [
            'user' => $user
        ];
        return view('core::dashboard.index', $dataArr);
    }
}
