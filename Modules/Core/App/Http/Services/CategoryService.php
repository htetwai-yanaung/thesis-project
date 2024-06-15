<?php

namespace Modules\Core\App\Http\Services;

use Modules\Core\App\Models\Category;

class CategoryService
{
    public function getCategories($conds = null, $noPage = false)
    {
        $categories = Category::when($conds, function($query, $conds){
            $query->where($conds);
        })
        ->orderBy(Category::createdAt, 'desc');

        if($noPage){
            return $categories->get();
        }else{
            return $categories->paginate(10);
        }
    }
}
