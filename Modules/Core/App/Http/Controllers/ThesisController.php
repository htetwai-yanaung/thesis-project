<?php

namespace Modules\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\App\Http\Services\ThesisService;

class ThesisController
{
    protected $thesisService;

    public function __construct(ThesisService $thesisService)
    {
        $this->thesisService = $thesisService;
    }

    public function index(Request $request){
        return $this->thesisService->index($request);
    }

    public function create(){
        return $this->thesisService->create();
    }

    public function store(Request $request){
        return $this->thesisService->store($request);
    }

    public function edit($id){
        return $this->thesisService->edit($id);
    }
}
