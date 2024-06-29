<?php

namespace Modules\Template\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Modules\Core\App\Http\Services\ThesisService;

class ThesisController extends Controller
{
    protected $thesisService;

    public function __construct(ThesisService $thesisService)
    {
        $this->thesisService = $thesisService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return "hello";
        return view('template::thesis.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datArr = $this->thesisService->create();
        return view('template::thesis.create', $datArr);
    }



    public function detail(){
        return view('template::thesis.detail');
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
