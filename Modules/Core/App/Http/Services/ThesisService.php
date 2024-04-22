<?php

namespace Modules\Core\App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Core\App\Models\ThesisProject;
use Modules\Core\App\Http\Services\ImageService;

class ThesisService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function create(){
        return view('core::thesis.create');
    }

    public function store($request){
        Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'year' => 'required',
            'project_type' => 'required',
            // 'photo' => 'required|mimes:png,jpg',
        ])->validate();

        DB::beginTransaction();
        try{
            $thesis = new ThesisProject();
            $thesis->title = $request->title;
            $thesis->description = $request->description;
            $thesis->year = $request->year;
            $thesis->project_type = $request->project_type;
            $thesis->user_id = Auth::user()->id;
            // $thesis->photo = $request->photo;
            $thesis->save();

            DB::commit();

            return redirect()->back()->with(['success' => 'Project Create Success.']);
        }catch(\Throwable $e){
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
