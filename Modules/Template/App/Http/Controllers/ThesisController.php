<?php

namespace Modules\Template\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\App\Models\Year;
use App\Http\Controllers\Controller;
use Modules\Core\Constant\Constants;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Modules\Core\App\resources\ThesisResource;
use Modules\Core\App\Http\Services\ThesisService;
use Modules\Core\App\Http\Services\CategoryService;

class ThesisController extends Controller
{
    protected $thesisService, $categoryService;

    public function __construct(ThesisService $thesisService, CategoryService $categoryService)
    {
        $this->thesisService = $thesisService;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $conds['search_term'] = $request->search_term ?? '';
        $categoryId = $request->category_id;
        $thesisProjects = $this->thesisService->getThesisProjects($conds, $categoryId, Constants::publishedStatus);

        $catConds['status'] = Constants::publishedStatus;
        $categories = $this->categoryService->getCategories($catConds, true);

        $datArr = [
            'thesisProjects' => $thesisProjects,
            'categories' => $categories
        ];
        return view('template::thesis.index', $datArr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datArr = $this->thesisService->create();
        return view('template::thesis.create', $datArr);
    }



    public function detail($id)
    {
        $relation = ['owner', 'images', 'pdfs', 'category'];
        $thesisProject = $this->thesisService->getThesisProject($id, $relation);
        $this->thesisService->addPopular($id);
        $datArr = [
            'thesisProject' => $thesisProject
        ];

        return view('template::thesis.detail', $datArr);
    }
    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        $datArr = $this->thesisService->store($request);
        return redirect()->back()->with($datArr);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('template::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $relation = ['owner', 'images', 'pdfs'];
        $thesisProject = $this->thesisService->getThesisProject($id, $relation);

        $catConds['status'] = Constants::publishedStatus;
        $categories = $this->categoryService->getCategories($catConds, true);

        $years = Year::where(Year::status, Constants::publishedStatus)->get();

        $datArr = [
            'thesisProject' => $thesisProject,
            'categories' => $categories,
            'years' => $years
        ];

        return view('template::thesis.edit', $datArr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataArr = $this->thesisService->update($id, $request);

        return redirect()->back()->with($dataArr);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataArr = $this->thesisService->deleteThesis($id);

        return redirect()->route('user.profile', $dataArr['user_id']);
    }
}
