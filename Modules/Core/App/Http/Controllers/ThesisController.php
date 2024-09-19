<?php

namespace Modules\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\App\Http\Services\CategoryService;
use Modules\Core\App\Http\Services\ImageService;
use Modules\Core\App\Http\Services\ThesisService;
use Modules\Core\Constant\Constants;
class ThesisController
{
    protected $thesisService, $categoryService, $imageService;

    public function __construct(ThesisService $thesisService, CategoryService $categoryService, ImageService $imageService)
    {
        $this->thesisService = $thesisService;
        $this->categoryService = $categoryService;
        $this->imageService = $imageService;
    }

    public function index(Request $request){
        $conds['search_term'] = $request->search_term ?? '';
        $categoryId = $request->category_id;
        $status = $request->status == 'all' ? null : $request->status;
        $thesisProjects = $this->thesisService->getThesisProjects($conds, $categoryId, $status);

        $catConds['status'] = constants::publishedStatus;
        $categories = $this->categoryService->getCategories($catConds, true);

        $dataArr = [
            'thesisProjects' => $thesisProjects,
            'categories' => $categories,
        ];

        return view('core::thesis.index', $dataArr);
    }

    public function create(){
        $dataArr = $this->thesisService->create();
        return view('core::thesis.create', $dataArr);
    }

    public function store(Request $request){
        $dataArr = $this->thesisService->store($request);
        if(isset($dataArr['error'])){
            return redirect()->back()->with($dataArr);
        }
        return redirect()->route('thesis.index');
    }

    public function edit($id){
        return $this->thesisService->edit($id);
    }

    public function update($id, Request $request){
        $dataArr = $this->thesisService->update($id, $request);
        if(isset($dataArr['error'])){
            return redirect()->back()->with($dataArr);
        }
        return redirect()->route('thesis.index');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $category = $this->thesisService->deleteThesis($id);

        return response()->json($category);
    }

    public function editStatus($id)
    {
        $thesisProject = $this->thesisService->getThesisProject($id);
        $dataArr = [
            'thesisProject' => $thesisProject
        ];
        return view('core::thesis.status', $dataArr);
    }

    public function updateStatus(Request $request, $id)
    {
        $dataArr = $this->thesisService->updateStatus($request, $id);
        if(isset($dataArr['error'])){
            return redirect()->back()->with($dataArr);
        }
        return redirect()->route('thesis.index');
    }

    public function storeTempFile(Request $request)
    {
        return $this->thesisService->storeTempFile($request);
    }

    public function deleteTempFile()
    {
        return $this->thesisService->deleteTempFile();
    }

    /**
     * @deprecated
     */
    public function dropzoneTempStore(Request $request)
    {
        $thesisImages = $request->file('file');
        if(is_array($thesisImages)){
            foreach($thesisImages as $key=>$image){
                $images[$key] = $this->imageService->storeTempFile($image);
            }
            return response()->json($images, 200);
        }else{
            $image = $this->imageService->storeTempFile($thesisImages);
            return response()->json($image, 200);
        }
    }
}
