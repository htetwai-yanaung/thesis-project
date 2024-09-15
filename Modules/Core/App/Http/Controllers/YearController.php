<?php

namespace Modules\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Core\App\Models\Year;
use Illuminate\Support\Facades\Validator;

class YearController
{
    public function index(Request $request)
    {
        $conds['search_term'] = $request->search_term;
        $years = $this->getAllYear($conds);

        $dataArr = [
            'years' => $years
        ];
        return view('core::year.index', $dataArr);
    }

    public function edit($id)
    {
        $year = $this->getYear($id);
        $dataArr = [
            'year' => $year
        ];
        return view('core::year.edit', $dataArr);
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'year' => 'required',
        ])->validate();

        DB::beginTransaction();
        try{
            $year = $this->getYear($id);
            $year->year = $request->year;
            $year->status = $request->status == 'on' ? 1 : 0;
            $year->update();
            DB::commit();

            return redirect()->route('year.index');
        }catch(\Throwable $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateStatus(Request $request)
    {
        $year = $this->getYear($request->id);
        if($year->status == 1){
            $year->status = 0;
            $msg = 'Year unpublished.';
        }else{
            $year->status = 1;
            $msg = 'Year published';
        }
        $year->update();

        return response()->json([
            'success' => $msg
        ]);
    }

    private function getYear($id)
    {
        return Year::find($id);
    }

    private function getAllYear($conds = null, $status = null, $noPage = false)
    {
        $years = Year::when($conds, function($query, $conds){
                if(isset($conds['search_term'])){
                    $search = $conds['search_term'];
                    $query->where(function($query) use($search){
                        $query->where(Year::tableName . '.' . Year::year, 'like', '%' . $search . '%');
                    });
                }
            })
            ->when($status, function($query, $status){
                $query->where(Year::status, $status);
            });

        if($noPage){
            return $years->get();
        }else{
            return $years->paginate(10);
        }
    }
}
