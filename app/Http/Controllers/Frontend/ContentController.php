<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Code;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __invoke() {

        $videos = Video::all();

        return view('frontend.content', ['pageTitle' => trans('site/site.content_page_title')],compact('videos'));
    }

    public function showContent($filename)
    {
        // Define the path to your videos
        $path = storage_path('app/videos/' . $filename);

        // Check if the file exists
        if (!file_exists($path)) {
            abort(404); // Return 404 if the file does not exist
        }

        // Return the video file
        return response()->file($path);
    }

    
}
