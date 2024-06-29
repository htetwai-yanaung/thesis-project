<?php

namespace Modules\Core\App\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Core\App\Models\Category;

class CategoryService
{
    public function getCategories($conds = null, $noPage = false)
    {
        $categories = Category::when($conds, function($query, $conds){
            if(isset($conds['search_term'])){
                $search = $conds['search_term'];
                $query->where(function($query) use($search){
                    $query->where(Category::tableName . '.' . Category::name, 'like', '%' . $search . '%')
                    ->orWhere(Category::tableName . '.' . Category::description, 'like', '%' . $search . '%');
                });
            }
            if(isset($conds['status'])){
                $query->where(Category::status, $conds['status']);
            }
        })
        ->orderBy(Category::createdAt, 'desc');

        if($noPage){
            return $categories->get();
        }else{
            return $categories->paginate(10);
        }
    }

    public function getCategory($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function store($request)
    {
        DB::beginTransaction();
        try{
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->status = $request->status == 'on' ? 1 : 0;
            $category->save();

            DB::commit();
            return ['success' => 'Category successfully created.'];
        }catch(\Throwable $e){
            DB::rollback();
            return ['error' => $e->getMessage()];
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try{
            $category = $this->getCategory($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->status = $request->status == 'on' ? 1 : 0;
            $category->update();

            DB::commit();
            return ['success' => 'Category successfully updated.'];
        }catch(\Throwable $e){
            DB::rollback();
            return ['error' => $e->getMessage()];
        }
    }

    public function updateStatus($id)
    {
        $category = $this->getCategory($id);
        if($category->status == 1){
            $category->status = 0;
            $msg = 'Category unpublished.';
        }else{
            $category->status = 1;
            $msg = 'Category published';
        }
        $category->update();

        return [
            'success' => $msg
        ];
    }

    public function deleteCategory($id)
    {
        $category = $this->getCategory($id);
        $category->delete();

        return [
            'status' => 'success',
            'message' => 'Category successfully deleted.'
        ];
    }
}
