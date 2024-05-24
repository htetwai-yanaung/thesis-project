<?php

namespace Modules\Core\App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Constant\Constants;

class DashboardService
{
    public function dashboard(){
        $students = User::where('role', Constants::student)->get();
        $teachers = User::where('role', Constants::teacher)->get();
        $totalStudents = $students->count();
        $totalTeachers = $teachers->count();

        $dataArr = [
            'students' => $students,
            'teachers' => $teachers,
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
        ];
        return view('core::dashboard.index', $dataArr);
    }
}
