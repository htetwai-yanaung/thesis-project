<?php

namespace Modules\Core\App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Core\App\Models\News;
use Modules\Core\App\Models\ThesisProject;
use Modules\Core\Constant\Constants;

class DashboardService
{
    public function dashboard(){
        $students = User::where('role', Constants::student)->get();
        $teachers = User::where('role', Constants::teacher)->get();
        $thesisProjects = ThesisProject::where(ThesisProject::status, Constants::publishedStatus)
            ->with(['owner'])
            ->limit(3)
            ->get();
        $totalProjects = ThesisProject::get()->count();
        $totalNews = News::get()->count();
        $totalStudents = $students->count();
        $totalTeachers = $teachers->count();

        $dataArr = [
            'students' => $students,
            'teachers' => $teachers,
            'thesisProjects' => $thesisProjects,
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'totalProjects' => $totalProjects,
            'totalNews' => $totalNews
        ];
        return view('core::dashboard.index', $dataArr);
    }
}
