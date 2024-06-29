<?php

namespace Modules\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Core\App\Http\Services\CategoryService;

class CategoryController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $conds['search_term'] = $request->search_term;
        $categories = $this->categoryService->getCategories($conds);

        $dataArr = [
            'categories' => $categories,
        ];

        return view('core::category.index', $dataArr);
    }

    public function create()
    {
        return view('core::category.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
            'description' => 'nullable',
            'status' => 'nullable'
        ])->validate();

        $category = $this->categoryService->store($request);

        if(isset($category['error'])){
            return redirect()->back()->with($category);
        }

        return redirect()->route('category.index')->with($category);
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategory($id);

        $dataArr = [
            'category' => $category
        ];

        return view('core::category.edit', $dataArr);
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,'.$id,
            'description' => 'nullable',
            'status' => 'nullable'
        ])->validate();

        $category = $this->categoryService->update($request, $id);

        if(isset($category['error'])){
            return redirect()->back()->with($category);
        }

        return redirect()->route('category.index')->with($category);
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $category = $this->categoryService->updateStatus($id);

        return response()->json($category);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $category = $this->categoryService->deleteCategory($id);

        return response()->json($category);
    }
}
