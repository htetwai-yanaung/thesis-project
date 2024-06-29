<?php

namespace Modules\Core\App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Constant\Constants;
use Modules\Core\App\resources\UserResource;
use Modules\Core\App\Http\Services\ProfileService;

class UserService
{
    protected $profileService, $imageService;
    public function __construct(ProfileService $profileService, ImageService $imageService)
    {
        $this->profileService = $profileService;
        $this->imageService = $imageService;
    }

    public function teacherList($request)
    {
        $conds['role'] = Constants::teacher;
        $conds['search_term'] = $request->search_term ?? '';
        $teachers = UserResource::collection($this->getUsers($conds, 10));

        $dataArr = [
            'teachers' => $teachers
        ];

        return view('core::teacher.index', $dataArr);
    }

    public function studentList($request)
    {
        $conds['role'] = Constants::student;
        $conds['search_term'] = $request->search_term ?? '';
        $students = $this->getUsers($conds, 10);

        $dataArr = [
            'students' => $students
        ];

        return view('core::student.index', $dataArr);
    }

    public function getUsers($conds = null, $perPage = null)
    {
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

    public function getUser($id, $relations = null)
    {
        $user = User::when($relations, function($query, $relations){
            $query->with($relations);
        })->find($id);
        return $user;
    }

    public function edit($id)
    {
        $user = $this->getUser($id);
        $data = [
            'user' => $user
        ];

        return view('core::teacher.edit', $data);
    }

    public function update($request, $id)
    {
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
            return [
                'success' => 'Profile successfully updated.'
            ];
        }catch(\Throwable $e){
            DB::rollBack();
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
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
