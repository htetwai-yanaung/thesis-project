<?php

namespace Modules\Core\App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Constant\Constants;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Core\App\Models\TemporaryFile;
use Modules\Core\App\Models\ThesisProject;
use Modules\Core\App\Http\Services\ImageService;
use Modules\Core\App\Http\Services\CategoryService;

class ThesisService
{
    protected $imageService, $categoryService;

    public function __construct(ImageService $imageService, CategoryService $categoryService)
    {
        $this->imageService = $imageService;
        $this->categoryService = $categoryService;
    }

    public function index($request){
        $conds['search_term'] = $request->search_term ?? '';
        $thesisProjects = $this->getThesisProjects($conds);

        $catConds['status'] = constants::publishedStatus;
        $categories = $this->categoryService->getCategories($catConds);

        $dataArr = [
            'thesisProjects' => $thesisProjects,
            'categories' => $categories,
        ];

        return view('core::thesis.index', $dataArr);
    }

    public function create(){
        $catConds['status'] = constants::publishedStatus;
        $categories = $this->categoryService->getCategories($catConds, true);

        $dataArr = [
            'categories' => $categories,
        ];

        return $dataArr;
    }

    public function store($request){
        // dd($request->all());
        Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'year' => 'required',
            'project_type' => 'required',
        ])->validate();

        DB::beginTransaction();
        try{
            $thesis = new ThesisProject();
            $thesis->title = $request->title;
            $thesis->description = $request->description;
            $thesis->category_id = $request->category;
            $thesis->year_id = $request->year;
            $thesis->project_type = $request->project_type;
            $thesis->status = Constants::approved;
            $thesis->user_id = Auth::user()->id;
            $thesis->save();

            $this->imageService->storeThesisImages($request, $thesis->id);

            DB::commit();

            $dataArr = [
                'status' => 'success',
                'message' => 'Project Create Success.'
            ];

        }catch(\Throwable $e){
            DB::rollBack();
            dd($e->getMessage());
            $dataArr = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }

        return $dataArr;

    }

    public function getThesisProjects($conds = null){
        $relations = ['images', 'owner'];

        $thesisProjects = ThesisProject::with($relations)
            ->when($conds, function($q, $conds){
                if(isset($conds['search_term'])){
                    $search = $conds['search_term'];
                    $q->where(function($query) use($search){
                        $query->where(ThesisProject::tableName . '.' . ThesisProject::title, 'like', '%' . $search . '%')
                        ->orWhere(ThesisProject::tableName . '.' . ThesisProject::desc, 'like', '%' . $search . '%');
                    });
                }
            })
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
        $relations = ['images', 'owner'];
        $thesisProject = $this->getThesisProject($id, $relations);
        $catConds['status'] = constants::publishedStatus;
        $categories = $this->categoryService->getCategories($catConds, true);

        $dataArr = [
            'thesisProject' => $thesisProject,
            'categories' => $categories,
        ];

        return view('core::thesis.edit', $dataArr);
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try{
            $thesis = $this->getThesisProject($id);
            $thesis->title = $request->title;
            $thesis->description = $request->description;
            $thesis->category_id = $request->category;
            $thesis->year_id = $request->year;
            $thesis->project_type = $request->project_type;
            $thesis->update();

            $this->imageService->storeThesisImages($request, $id);

            DB::commit();
        }catch(\Throwable $e){
            DB::rollBack();
            $dataArr = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            dd($e->getMessage());
            return redirect()->back()->with($dataArr);
        }
        return redirect()->route('thesis.index');
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
