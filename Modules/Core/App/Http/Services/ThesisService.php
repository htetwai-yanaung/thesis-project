<?php

namespace Modules\Core\App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Core\App\Models\ThesisProject;
use Modules\Core\App\Http\Services\ImageService;
use Modules\Core\Constant\Constants;

class ThesisService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index($request){
        $conds['search_term'] = $request->search_term ?? '';
        $thesisProjects = $this->getThesisProjects($conds);

        $dataArr = [
            'thesisProjects' => $thesisProjects
        ];

        return view('core::thesis.index', $dataArr);
    }

    public function create(){
        return view('core::thesis.create');
    }

    public function store($request){
        dd($request->all());
        Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'year' => 'required',
            'project_type' => 'required',
        ])->validate();

        DB::beginTransaction();
        try{
            $thesis = new ThesisProject();
            $thesis->title = $request->title;
            $thesis->description = $request->description;
            $thesis->year = $request->year;
            $thesis->project_type = $request->project_type;
            $thesis->status = Constants::approved;
            $thesis->user_id = Auth::user()->id;
            $thesis->save();

            $this->imageService->storeProjectImages($request, $thesis->id);

            DB::commit();

            return redirect()->route('thesis.index')->with(['success' => 'Project Create Success.']);
        }catch(\Throwable $e){
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

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

        $dataArr = [
            'thesisProject' => $thesisProject,
        ];

        return view('core::thesis.edit', $dataArr);
    }
}
