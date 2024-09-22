<?php

namespace Modules\Template\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Core\App\Http\Services\NewsService;
use Modules\Core\Constant\Constants;

class NewsController extends Controller
{
    public function __construct(
        protected NewsService $newsService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allNews = $this->newsService->getAllNews(null, ['owner','images'], Constants::publishedStatus);

        $dataArr = [
            'allNews' => $allNews
        ];
        return view('template::news.index', $dataArr);
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
        $relations = ['images'];
        $news = $this->newsService->getNews($id, $relations);
        $dataArr = [
            'news' => $news,
        ];
        return view('template::news.show', $dataArr);
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
