<?php

namespace Modules\Template\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ThesisController extends Controller
{
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
        return view('template::create');
    }


   
    public function detail(){
        return view('template::thesis.detail');
    }
    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request): RedirectResponse
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
    public function update(Request $request, $id): RedirectResponse
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
