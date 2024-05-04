<?php

namespace Modules\Core\App\Http\Services;

use Modules\Core\App\Models\News;
use Modules\Core\App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Constant\Constants;
use Illuminate\Support\Facades\Storage;
use Modules\Core\App\Models\TemporaryFile;

class NewsService
{
    public function index()
    {
        $news = News::with(['images'])->paginate(10);
        $dataArr = [
            'news' => $news,
        ];
        return view('core::news.index', $dataArr);
    }

    public function edit($id)
    {
        $news = $this->getNews($id);
        $dataArr = [
            'news' => $news,
            'images' => $news->images,
        ];
        return view('core::news.edit', $dataArr);
    }

    public function getNews($id)
    {
        $relations = ['images'];
        $news = News::with($relations)->find($id);

        return $news;
    }

    public function store($request)
    {
        $tempFile = $this->getTempFile($request->news_image);

        if($tempFile){
            $news = News::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
            ]);

            foreach($tempFile as $tmp){
                Storage::copy('public/uploads/tmp/' . $tmp->folder . '/' . $tmp->file, 'public/uploads/news/' . $tmp->file);

                Image::create([
                    'parent_id' => $news->id,
                    'image_type' => Constants::newsImageType,
                    'file_type' => Constants::imageFileType,
                    'path' => $tmp->file,
                ]);

                Storage::deleteDirectory('public/uploads/tmp/' . $tmp->folder);
                $tmp->delete();
            }
        }

        return redirect()->route('announcement.index');
    }

    public function update($request, $id)
    {
        $tempFile = $this->getTempFile($request->news_image);

        if($tempFile){
            $news = News::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
            ]);

            $oldImages = Image::where([
                'parent_id' => $id,
                'image_type' => Constants::newsImageType
            ])->get();

            foreach($oldImages as $oldImage){
                Storage::delete('public/uploads/news/' . $oldImage->path);
                $oldImage->delete();
            }

            foreach($tempFile as $tmp){
                Storage::copy('public/uploads/tmp/' . $tmp->folder . '/' . $tmp->file, 'public/uploads/news/' . $tmp->file);

                Image::create([
                    'parent_id' => $id,
                    'image_type' => Constants::newsImageType,
                    'file_type' => Constants::imageFileType,
                    'path' => $tmp->file,
                ]);

                Storage::deleteDirectory('public/uploads/tmp/' . $tmp->folder);
                $tmp->delete();
            }
        }

        return redirect()->route('announcement.index');
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
