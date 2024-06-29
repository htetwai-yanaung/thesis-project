<?php

namespace Modules\Core\App\Http\Services;

use Modules\Core\App\Models\News;
use Illuminate\Support\Facades\DB;
use Modules\Core\App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Constant\Constants;
use Illuminate\Support\Facades\Storage;
use Modules\Core\App\Models\TemporaryFile;
use PHPUnit\TextUI\Configuration\Constant;

class NewsService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getNews($id, $relations = null)
    {
        $news = News::when($relations, function($query, $relations){
            $query->with($relations);
        })->find($id);

        return $news;
    }

    public function getAllNews($conds = null, $relations = null, $noPage = false)
    {
        $news = News::when($conds, function($query, $conds){
            if(isset($conds['search_term'])){
                $search = $conds['search_term'];
                $query->where(function($query) use($search){
                    $query->where(News::tableName . '.' . News::title, 'like', '%' . $search . '%')
                    ->orWhere(News::tableName . '.' . News::description, 'like', '%' . $search . '%');
                });
            }
        })
        ->when($relations, function($query, $relations){
            $query->with($relations);
        })
        ->orderBy(News::createdAt, 'desc');
        if($noPage){
            return $news->get();
        }else{
            return $news->paginate(10);
        }
    }

    public function store($request)
    {
        DB::beginTransaction();
        try{
            $news = new News();
            $news->title = $request->title;
            $news->description = $request->description;
            $news->user_id = Auth::user()->id;
            $news->save();

            $this->imageService->storeImages($request->news_image, $news->id, Constants::newsImagePath, Constants::newsImageType);

            DB::commit();
            return [
                'success' => 'News successfully created'
            ];
        }catch(\Throwable $e){
            DB::rollback();
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try{
            $news = $this->getNews($id);
            $news->title = $request->title;
            $news->description = $request->description;
            $news->user_id = Auth::user()->id;
            $news->update();

            $this->imageService->storeImages($request->news_image, $id, Constants::newsImagePath, Constants::newsImageType);

            DB::commit();
            return [
                'success' => 'News successfully updated.'
            ];
        }catch(\Throwable $e){
            DB::rollback();
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function storeTempFile($request)
    {
        foreach($request->news_image as $file){
            $imageName = uniqid().'_.'.$file->extension();
            $folder = uniqid('news_');
            $file->storeAs('public/uploads/tmp/' . $folder, $imageName);

            TemporaryFile::create([
                'folder' => $folder,
                'file' => $imageName,
            ]);

        }
        return $folder;
    }

    public function getTempFile($folder)
    {
        $tempFile = TemporaryFile::whereIn(TemporaryFile::folder, $folder)->get();

        return $tempFile;
    }

    public function deleteTempFile()
    {
        $tempFile = TemporaryFile::where(TemporaryFile::folder, request()->getContent())->first();
        if($tempFile){
            Storage::deleteDirectory('public/uploads/tmp/' . $tempFile->folder);
            $tempFile->delete();
            return response('');
        }

    }

    public function loadFiles()
    {
        $images = Image::where(Image::parentId, 1)->get();
        return $images;
        // Transform files data into the format expected by FilePond
        // $filesData = $images->map(function ($file) {
        //     return [
        //         'id' => $file->id,
        //         'name' => $file->path, // Adjust as per your file attributes
        //         'size' => "1233",
        //         // Add any other relevant data
        //     ];
        // });

        // Return files data as JSON response
        // return response()->json($images, 200);
    }
}
