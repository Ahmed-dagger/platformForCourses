<?php

namespace  App\Repositories\Eloquents;

use App\Models\Admin;
use App\Repositories\Contracts\PlaylistRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\PlaylistDataTable;

class PlaylistRepository implements PlaylistRepositoryInterface
{
    public function index(PlaylistDataTable $playlistDataTable)
    {
        return $playlistDataTable->render('dashboard.Admin.playlists.index', ['pageTitle' => trans('dashboard/admin.playlists')]);
    }

    public function store($request) {
        
    }

    public function update($request) {}

    public function destroy($request) {}
}
