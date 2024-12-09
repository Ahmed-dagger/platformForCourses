<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\VideoRepositoryInterface;
use App\DataTables\Dashboard\Admin\VideoDataTable;
use App\Jobs\StreamVideo;
use App\Models\Course;
use App\Models\Video;
use App\Models\Playlist;
use Illuminate\Foundation\Bus\DispatchesJobs;  // Add this
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller implements VideoRepositoryInterface
{
    use DispatchesJobs;  // Add this

    public function __construct(protected VideoDataTable $videoDataTable, protected VideoRepositoryInterface $videoRepositoryInterface) {
        $this->videoRepositoryInterface = $videoRepositoryInterface;
        $this->videoDataTable = $videoDataTable;
    }

    public function index(VideoDataTable $videoDataTable) {
        return $this->videoRepositoryInterface->index($this->videoDataTable);
    }

    public function create()
    {
        
        
        $video = Video::create([]);
        return view('dashboard.Admin.videos.create', ['pageTitle' => trans('dashboard/admin.playlists')],  compact( 'video'));

    }

    public function store(Request $request)
    {

        set_time_limit(120);
        
        $video = Video::FindOrFail($request->video_id);
        $video->update([
            'name'  => $request->name,
            'path'  => $request->file('video')->store('videos'),
        ]);


        $this->dispatch(new StreamVideo($video));
        return $video;
    }

    public function show(Video $video)
    {
        return $video;

    }// end of show

    public function edit(Video $video) {
        
        return view('dashboard.Admin.videos.edit', ['pageTitle' => trans('dashboard/admin.Update Video')]);
    }

    public function update(Request $request, Video $video) {

        $validatedData = $request->validate([
            'name' => 'required|unique:videos,name,' . $video->id,
            'description' => 'required',
        ]);

        $video->update($validatedData);
        session()->flash('success', 'Data updated successfully');
        return redirect()->route('admin.videos.index');

    }

    public function destroy(Video $video)
    {
        Storage::disk('local')->delete($video->path);
        Storage::disk('local')->deleteDirectory('public/videos/' . $video->id);
        $video->delete();
        session()->flash('success', 'Data deleted successfully');
        return redirect()->route('admin.videos.index');

    }//end of destroy

    
}
