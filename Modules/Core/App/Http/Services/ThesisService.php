<?php

namespace Modules\Core\App\Http\Services;

use Modules\Core\App\Models\Year;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Core\App\Models\Setting;
use Modules\Core\Constant\Constants;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Core\App\Models\TemporaryFile;
use Modules\Core\App\Models\ThesisProject;
use Modules\Core\App\Http\Services\ImageService;
use Modules\Core\App\Http\Services\CategoryService;

class ThesisService
{
    protected $imageService, $categoryService, $settingService;

    public function __construct(ImageService $imageService, CategoryService $categoryService, SettingService $settingService)
    {
        $this->imageService = $imageService;
        $this->categoryService = $categoryService;
        $this->settingService = $settingService;
    }

    public function create(){
        $catConds['status'] = constants::publishedStatus;
        $categories = $this->categoryService->getCategories($catConds, true);
        $years = Year::where(Year::status, Constants::publishedStatus)->get();

        $dataArr = [
            'categories' => $categories,
            'years' => $years
        ];

        return $dataArr;
    }

    public function store($request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'year' => 'required',
            'project_type' => 'required',
        ]);

        if($validator->fails()){
            if($request->thesis_image != null){
                $tempFiles = $this->imageService->getTempFiles($request->thesis_image);
                if($tempFiles){
                    foreach($tempFiles as $tempFile){
                        Storage::deleteDirectory(Constants::tmpImagePath . $tempFile->folder);
                        $tempFile->delete();
                    }
                }
            }

            $validator->validate();
        }

        DB::beginTransaction();
        try{
            $setting = Setting::first();
            $thesis = new ThesisProject();
            $thesis->title = $request->title;
            $thesis->description = $request->description;
            $thesis->category_id = $request->category;
            $thesis->year_id = $request->year;
            $thesis->project_type = $request->project_type;
            $thesis->status = $setting->enable_approve == 1 ? Constants::pending : Constants::approved;
            $thesis->user_id = Auth::user()->id;
            $thesis->save();

            $this->imageService->storeThesisImages($request, $thesis->id);

            DB::commit();

            return [
                'success' => 'Project Create Success.'
            ];

        }catch(\Throwable $e){
            DB::rollBack();
            return [
                'error' => $e->getMessage()
            ];
        }

    }

    public function getThesisProjects($conds = null, $categoryId = null, $status = null){
        $relations = ['images', 'owner', 'category'];

        $thesisProjects = ThesisProject::with($relations)
            ->when($conds, function($q, $conds){
                if(isset($conds['search_term'])){
                    $search = $conds['search_term'];
                    $q->where(function($query) use($search){
                        $query->where(ThesisProject::tableName . '.' . ThesisProject::title, 'like', '%' . $search . '%')
                        ->orWhere(ThesisProject::tableName . '.' . ThesisProject::desc, 'like', '%' . $search . '%');
                    });
                }
                if(isset($conds['user_id'])){
                    $q->where(ThesisProject::userId, $conds['user_id']);
                }
            })
            ->when($categoryId, function($query, $categoryId){
                $query->where(ThesisProject::categoryId, $categoryId);
            })
            ->when($status, function($query, $status){
                $query->where(ThesisProject::status, $status);
            })
            ->orderBy(ThesisProject::popularCount, 'desc')
            ->orderBy(ThesisProject::createdAt, 'desc')
            ->paginate(10);

        return $thesisProjects;
    }

    public function getThesisProject($id, $relations = null){
        $thesisProject = ThesisProject::when($relations, function($q, $relations){
            $q->with($relations);
        })
        ->find($id);

        return $thesisProject;
    }

    public function edit($id){
        $relations = ['images', 'pdfs', 'owner'];
        $thesisProject = $this->getThesisProject($id, $relations);
        $catConds['status'] = constants::publishedStatus;
        $categories = $this->categoryService->getCategories($catConds, true);
        $years = Year::where(Year::status, Constants::publishedStatus)->get();

        $dataArr = [
            'thesisProject' => $thesisProject,
            'categories' => $categories,
            'years' => $years
        ];

        return view('core::thesis.edit', $dataArr);
    }

    public function update($id, $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'year' => 'required',
            'project_type' => 'required',
        ]);

        if($validator->fails()){
            if($request->thesis_image != null){
                $tempFiles = $this->imageService->getTempFiles($request->thesis_image);
                if($tempFiles){
                    foreach($tempFiles as $tempFile){
                        Storage::deleteDirectory(Constants::tmpImagePath . $tempFile->folder);
                        $tempFile->delete();
                    }
                }
            }

            $validator->validate();
        }

        DB::beginTransaction();
        try{
            $setting = Setting::first();
            $thesis = $this->getThesisProject($id);
            $thesis->title = $request->title;
            $thesis->description = $request->description;
            $thesis->category_id = $request->category;
            $thesis->year_id = $request->year;
            $thesis->project_type = $request->project_type;
            $thesis->status = $setting->enable_approve == 1 ? Constants::pending : Constants::approved;
            $thesis->update();

            $this->imageService->storeThesisImages($request, $id);

            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Project update success',
                'success' => 'Project update success'
            ];
        }catch(\Throwable $e){
            DB::rollBack();
            return [
                'status' => 'success',
                'message' => $e->getMessage(),
                'error' => $e->getMessage()
            ];
        }
    }

    public function deleteThesis($id)
    {
        $thesis = $this->getThesisProject($id);
        $userId = $thesis->user_id;
        $thesis->delete();

        $images = $this->imageService->getImages($id, Constants::projectImageType);
        foreach($images as $image){
            $image->delete();
        }

        return [
            'status' => 'success',
            'message' => 'Category successfully deleted.',
            'user_id' => $userId
        ];
    }

    public function updateStatus($request, $id)
    {
        DB::beginTransaction();
        try{
            $thesis = $this->getThesisProject($id);
            $thesis->status = $request->status;
            $thesis->update();
            DB::commit();

            return [
                'success' => 'Status update success'
            ];
        }catch(\Throwable $e){
            DB::rollBack();
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function addPopular($id)
    {
        DB::beginTransaction();
        try{
            $thesis = $this->getThesisProject($id);
            $popular = (int)$thesis->popular_count + 1;
            $thesis->popular_count = $popular;
            $thesis->update();
            DB::commit();

            return [
                'success' => 'Status update success'
            ];
        }catch(\Throwable $e){
            DB::rollBack();
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function storeTempFile($request)
    {
        foreach($request->thesis_image as $file){
            $imageName = uniqid().'_.'.$file->extension();
            $folder = uniqid('thesis_');
            $file->storeAs('public/uploads/tmp/' . $folder, $imageName);

            TemporaryFile::create([
                'folder' => $folder,
                'file' => $imageName,
            ]);

        }
        return $folder;
    }

    public function deleteTempFile()
    {
        $tempFile = TemporaryFile::where(TemporaryFile::folder, request()->getContent())->first();
        if($tempFile){
            Storage::deleteDirectory('public/uploads/tmp/' . $tempFile->folder);
            $tempFile->delete();
            return response('');
        }

    }
}
