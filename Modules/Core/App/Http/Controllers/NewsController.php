<?php

namespace Modules\Core\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
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
    public function index(Request $request)
    {
        $conds['search_term'] = $request->search_term;
        $relations = ['images'];
        $news = $this->newsService->getAllNews($conds, $relations);

        $dataArr = [
            'news' => $news
        ];
        return view('core::news.index', $dataArr);
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
        Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'news_image' => 'required'
        ])->validate();

        $news = $this->newsService->store($request);

        if(isset($news['error'])){
            return redirect()->back()->with($news);
        }
        return redirect()->route('announcement.index')->with($news);
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
        $news = $this->newsService->getNews($id);
        $dataArr = [
            'news' => $news,
            'images' => $news->images,
        ];
        return view('core::news.edit', $dataArr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'news_image' => 'required'
        ])->validate();

        $news = $this->newsService->update($request, $id);

        if(isset($news['error'])){
            return redirect()->back()->with($news);
        }
        return redirect()->route('announcement.index')->with($news);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
