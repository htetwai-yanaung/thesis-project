<?php

namespace Modules\Core\App\Http\Services;

use App\Models\User;
use Modules\Core\Constant\Constants;
use Modules\Core\App\resources\UserResource;
use Modules\Core\App\Http\Services\ProfileService;

class UserService
{
    protected $profileService;
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function teacherList($request){
        $conds['role'] = Constants::teacher;
        $conds['search_term'] = $request->search_term ?? '';
        $teachers = UserResource::collection($this->getUsers($conds, 10));

        $dataArr = [
            'teachers' => $teachers
        ];

        return view('core::teacher.index', $dataArr);
    }

    public function studentList($request){
        $conds['role'] = Constants::student;
        $conds['search_term'] = $request->search_term ?? '';
        $students = $this->getUsers($conds, 10);

        $dataArr = [
            'students' => $students
        ];

        return view('core::student.index', $dataArr);
    }

    public function getUsers($conds = null, $perPage = null){
        $users = User::when($conds, function($q, $conds){
            if(isset($conds['role'])){
                $q->where(User::role, $conds['role']);
            }
            if(isset($conds['search_term'])){
                $search = $conds['search_term'];
                $q->where(function($query) use($search){
                    $query->where(User::tableName . '.' . User::name, 'like', '%' . $search . '%')
                    ->orWhere(User::tableName . '.' . User::email, 'like', '%' . $search . '%');
                });
            }
        });
        if($perPage != null){
            $users = $users->paginate($perPage);
        }else{
            $users = $users->get();
        }
        return $users;
    }

    public function getUser($id){
        $user = User::find($id);
        return $user;
    }

    public function edit($id){
        $user = $this->getUser($id);
        $data = [
            'user' => $user
        ];

        return view('core::teacher.edit', $data);
    }

    public function update($request, $id){
        return $this->profileService->update($request, $id);
    }

    public function destroy($id){
        try{
            $user = $this->getUser($id);
            $name = $user->name;
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => $name . ' has been deleted',
            ], 200);

        }catch(\Throwable $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
