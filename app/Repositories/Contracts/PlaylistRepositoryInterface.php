<?php
namespace  App\Repositories\Contracts;
use App\DataTables\Dashboard\Admin\PlaylistDataTable;
interface PlaylistRepositoryInterface {
    public function index(PlaylistDataTable $playlistDataTable);
    /*public function store($request);
    public function update($request);
    public function destroy($request);*/
}
