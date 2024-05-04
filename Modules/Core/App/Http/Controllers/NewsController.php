<?php

namespace Modules\Core\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\App\Http\Services\NewsService;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->newsService->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core::news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->newsService->store($request);
    }

    public function storeTempFile(Request $request)
    {
        return $this->newsService->storeTempFile($request);
    }

    public function deleteTempFile()
    {
        return $this->newsService->deleteTempFile();
    }

    public function loadFiles()
    {
        return $this->newsService->loadFiles();
    }

    /**
     * Show the specified resource.
     */
    // public function show($id)
    // {
    //     return view('core::show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->newsService->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $this->newsService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
