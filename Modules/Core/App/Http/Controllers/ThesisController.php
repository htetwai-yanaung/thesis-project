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
        $dataArr = $this->thesisService->create();
        return view('core::thesis.create', $dataArr);
    }

    public function store(Request $request){
        $dataArr = $this->thesisService->store($request);
        return redirect()->route('thesis.index')->with($dataArr);
    }

    public function edit($id){
        return $this->thesisService->edit($id);
    }

    public function update($id, Request $request){
        return $this->thesisService->update($id, $request);
    }

    public function storeTempFile(Request $request)
    {
        return $this->thesisService->storeTempFile($request);
    }

    public function deleteTempFile()
    {
        return $this->thesisService->deleteTempFile();
    }
}
