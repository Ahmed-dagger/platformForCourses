<?php
namespace  App\Repositories\Eloquents;
use App\Models\Category;
use App\Repositories\Contracts\VideoRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\VideoDataTable;

class VideoRepository implements VideoRepositoryInterface {
    public function index(VideoDataTable $videoDataTable) {

        return $videoDataTable->render('dashboard.Admin.videos.index', ['pageTitle' => trans('dashboard/admin.videos')]);

    }

    public function store($request) {

    }

    public function update($request) {

    }

    public function destroy($request) {

    }
}
