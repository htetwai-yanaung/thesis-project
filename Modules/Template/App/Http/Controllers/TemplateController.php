<?php

namespace Modules\Template\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Core\Constant\Constants;
use Illuminate\Http\RedirectResponse;
use Modules\Core\App\resources\ThesisResource;
use Modules\Core\App\Http\Services\NewsService;
use Modules\Core\App\Http\Services\UserService;
use Modules\Core\App\Http\Services\ThesisService;

class TemplateController extends Controller
{
    public function __construct(protected ThesisService $thesisService,
        protected UserService $userService,
        protected NewsService $newsService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thesisProjects = ThesisResource::collection($this->thesisService->getThesisProjects());

        $teachers = $this->userService->getUsers(['role' => Constants::teacher]);
        $allNews = $this->newsService->getAllNews(null, ['images'], Constants::publishedStatus, false, 9);
        $dataArr = [
            'thesisProjects' => $thesisProjects,
            'teachers' => $teachers,
            'allNews' => $allNews
        ];
        return view('template::index', $dataArr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('template::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return view('template::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
